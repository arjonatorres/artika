<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "usuarios_id".
 *
 * @property int $id
 *
 * @property Usuarios $usuarios
 */
class UsuariosId extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id'])->inverseOf('id0');
    }
}
