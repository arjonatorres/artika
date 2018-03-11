<?php

namespace common\models;

use Yii;
use Exception;

use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

use yii\imagine\Image;

/**
 * This is the model class for table "perfiles".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre_apellidos
 * @property int $genero_id
 * @property string $zona_horaria
 * @property string $direccion
 * @property string $ciudad
 * @property string $localización
 * @property string $provincia
 * @property string $pais
 * @property string $cpostal
 * @property string $fecha_nac
 * @property string $updated_at
 *
 * @property Generos $genero
 * @property Usuarios $usuario
 */
class Perfiles extends \yii\db\ActiveRecord
{

    /**
     * Contiene la foto del usuario subida en el formulario.
     * @var UploadedFile
     */
    public $foto;

    /**
     * Lista de extensiones soportadas por el avatar
     * @var array
     */
    public $extensions = ['jpg', 'png'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perfiles';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('localtimestamp'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'required'],
            [
                [
                    'usuario_id',
                    'genero_id',
                    'nombre_apellidos',
                    'zona_horaria',
                    'direccion',
                    'ciudad',
                    'localizacion',
                    'provincia',
                    'pais',
                    'cpostal',
                ],
                'default'
            ],
            [['usuario_id', 'genero_id'], 'integer'],
            [['fecha_nac'], 'filter', 'filter' => function ($value) {
                if ($value == '') {
                    return;
                }
                return Yii::$app->formatter->asDate($value, 'dd-MM-yyyy');
            }],
            [['fecha_nac'], 'date'],
            [['updated_at', 'zona_horaria', 'localizacion'], 'safe'],
            [
                ['nombre_apellidos', 'direccion', 'ciudad', 'provincia', 'pais'],
                'string', 'max' => 255
            ],
            [
                ['cpostal'],
                'match',
                'pattern' => '/^\d{5}$/',
                'message' => 'Código postal no válido'
            ],
            [['usuario_id'], 'unique'],
            [['foto'], 'file', 'extensions' => implode(',', $this->extensions)],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generos::className(), 'targetAttribute' => ['genero_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'foto',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'nombre_apellidos' => 'Nombre y apellidos',
            'genero_id' => 'Género',
            'zona_horaria' => 'Zona horaria',
            'direccion' => 'Dirección',
            'ciudad' => 'Ciudad',
            'localizacion' => 'Localización',
            'provincia' => 'Provincia',
            'pais' => 'País',
            'cpostal' => 'Código postal',
            'fecha_nac' => 'Fecha de nacimiento',
            'updated_at' => 'Updated At',
            'foto' => 'Avatar',
        ];
    }

    /**
     * Sube una foto de avatar a Amazon S3
     * @return bool Si se ha efectuado la subida correctamente.
     */
    public function upload()
    {
        if ($this->foto === null) {
            return true;
        }

        $id = Yii::$app->user->id;
        $ruta = Yii::getAlias('@avatar/') . $id . '.' . $this->foto->extension;
        $res = $this->foto->saveAs($ruta);
        if ($res) {
            Image::thumbnail($ruta, 300, 300)->save($ruta, ['quality' => 80]);
            $s3 = Yii::$app->get('s3');
            foreach ($this->extensions as $ext) {
                $rutaS3 = 'avatar/' . $id . '.' . $ext;
                $s3->delete($rutaS3);
            }
            try {
                $s3->upload($ruta, $ruta);
            } catch (Exception $e) {
                return false;
            }
        }
        return $res;
    }

    /**
     * Devuelve la ruta hacia la imagen del avatar alojada en Amazon S3. Si no
     * existe devuelve la imagen por defecto. En desarrollo devuelve la imagen
     * local para no hacer peticiones contínuamente a Amazon S3.
     * @return string La ruta del avatar
     */
    public function getRutaImagen()
    {
        $id = $this->usuario_id;

        $s3 = Yii::$app->get('s3');

        foreach ($this->extensions as $ext) {
            $rutaExacta = 'avatar/' . $id . '.' . $ext;
            if (file_exists($rutaExacta)) {
                return $rutaExacta;
            }
            if ($s3->exist($rutaExacta)) {
                $foto = file_get_contents($s3->getUrl($rutaExacta) . '?t=' . date('d-m-Y-H:i:s'));
                $archivo = fopen($rutaExacta, 'a');
                fwrite($archivo, $foto);
                return $rutaExacta;
            }
        }
        return Yii::getAlias('@avatar/0.png');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Generos::className(), ['id' => 'genero_id'])->inverseOf('perfil');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('perfil');
    }
}
