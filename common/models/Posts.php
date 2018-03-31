<?php

namespace common\models;

use Yii;
use Exception;

use yii\imagine\Image;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $titulo
 * @property string $contenido
 * @property int $usuario_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UsuariosId $usuario
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * Contiene la foto del post subida en el formulario.
     * @var UploadedFile
     */
    public $foto;

    /**
     * Lista de extensiones soportadas por la foto del post
     * @var array
     */
    public $extensions = ['jpg', 'png'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
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
            [['titulo', 'contenido', 'usuario_id'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['titulo'], 'string', 'max' => 255],
            [['contenido'], 'string', 'max' => 10000],
            [['titulo'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsuariosId::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['foto'], 'file', 'extensions' => implode(',', $this->extensions)],
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
            'titulo' => 'Titulo *',
            'contenido' => 'Contenido *',
            'usuario_id' => 'Usuario ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'foto' => 'Foto de portada',
        ];
    }


    /**
     * Sube la foto del post a Amazon S3
     * @return bool Si se ha efectuado la subida correctamente.
     */
    public function upload()
    {
        if ($this->foto === null) {
            return true;
        }

        $id = 'post' . $this->id;
        $ruta = Yii::getAlias('@post/') . $id . '.' . $this->foto->extension;
        $rutaS3 = Yii::getAlias('@post_s3/') . $id . '.' . $this->foto->extension;
        $res = $this->foto->saveAs($ruta);
        if ($res) {
            Image::thumbnail($ruta, 750, null)->save($ruta, ['quality' => 80]);
            $s3 = Yii::$app->get('s3');
            foreach ($this->extensions as $ext) {
                $rutaTemp = Yii::getAlias('@post_s3/') . $id . '.' . $ext;
                $s3->delete($rutaTemp);
            }
            try {
                $s3->upload($rutaS3, $ruta);
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
        $id = 'post' . $this->id;

        $s3 = Yii::$app->get('s3');

        foreach ($this->extensions as $ext) {
            $ruta = 'imagenes/post/' . $id . '.' . $ext;
            $rutaS3 = Yii::getAlias('@post_s3/') . $id . '.' . $ext;

            if (file_exists($ruta)) {
                return '/' . $ruta;
            }
            if ($s3->exist($rutaS3)) {
                $foto = file_get_contents($s3->getUrl($rutaS3) . '?t=' . date('d-m-Y-H:i:s'));
                $archivo = fopen($ruta, 'a');
                fwrite($archivo, $foto);
                return '/' . $ruta;
            }
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioId()
    {
        return $this->hasOne(UsuariosId::className(), ['id' => 'usuario_id'])->inverseOf('posts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('posts');
    }
}
