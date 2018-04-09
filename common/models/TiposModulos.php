<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_modulos".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Modulos[] $modulos
 */
class TiposModulos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_modulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 20],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulos::className(), ['tipo_modulo_id' => 'id'])->inverseOf('tipo');
    }
}
