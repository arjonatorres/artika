<?php

namespace common\models;

/**
 * This is the model class for table "camaras".
 *
 * @property int $id
 * @property string $nombre
 * @property string $url
 * @property int $puerto
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 */
class Camaras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'camaras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'url', 'puerto', 'usuario_id'], 'required'],
            [['puerto', 'usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['puerto'], 'integer', 'max' => 65535, 'min' => 1],
            [['nombre'], 'string', 'length' => [4, 20]],
            [['url'], 'string', 'max' => 255],
            [['url'], 'url'],
            [['nombre'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'url' => 'Url',
            'puerto' => 'Puerto',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('camaras');
    }
}
