<?php

namespace common\models;

use Yii;

use yii\db\Expression;

use yii\behaviors\TimestampBehavior;

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'contenido' => 'Contenido',
            'usuario_id' => 'Usuario ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('posts');
    }
}
