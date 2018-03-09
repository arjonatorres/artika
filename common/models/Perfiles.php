<?php

namespace common\models;

use Yii;

use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

use yii\helpers\Url;

use yii\imagine\Image;

/**
 * This is the model class for table "perfiles".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre_apellidos
 * @property int $genero_id
 * @property string $direccion
 * @property string $ciudad
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
            [['usuario_id', 'genero_id'], 'default', 'value' => null],
            [['usuario_id', 'genero_id'], 'integer'],
            [['fecha_nac'], 'filter', 'filter' => function ($value) {
                return Yii::$app->formatter->asDate($value);
            }],
            [['fecha_nac'], 'date'],
            [['updated_at'], 'safe'],
            [['nombre_apellidos', 'direccion', 'ciudad', 'provincia', 'pais'], 'string', 'max' => 255],
            [['cpostal'], 'match', 'pattern' => '/^\d{5}$/', 'message' => 'Código postal no válido'],
            [['usuario_id'], 'unique'],
            [['foto'], 'file', 'extensions' => 'jpg'],
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
            'direccion' => 'Dirección',
            'ciudad' => 'Ciudad',
            'provincia' => 'Provincia',
            'pais' => 'País',
            'cpostal' => 'Código postal',
            'fecha_nac' => 'Fecha de nacimiento',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload()
    {
        if ($this->foto === null) {
            return true;
        }

        $nombre = Yii::getAlias('@uploads/')
                . \Yii::$app->user->id . '.' . $this->foto->extension;
            $this->foto->saveAs($nombre);
            Image::thumbnail($nombre, 200, null)
                ->save($nombre, ['quality' => 80]);
                
            $s3 = Yii::$app->get('s3');
            $nombreS3 = 'avatar/' . Yii::$app->user->id . '.' . $this->foto->extension;
            $s3->upload($nombreS3, $nombre);

            return true;
        // $nombre = Yii::getAlias('@uploads/') . $this->id . '.jpg';
        // $res = $this->foto->saveAs($nombre);
        // if ($res) {
        //     Image::thumbnail($nombre, 80, null)->save($nombre);
        // }
        // return $res;
    }

    public function getRutaImagen()
    {
        $nombre = Yii::getAlias('@uploads/') . $this->id . '.jpg';
        if (file_exists($nombre)) {
            return Url::to('/uploads/') . $this->id . '.jpg';
        }
        return Url::to('/uploads/') . 'default.jpg';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Generos::className(), ['id' => 'genero_id'])->inverseOf('perfiles');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('perfiles');
    }
}
