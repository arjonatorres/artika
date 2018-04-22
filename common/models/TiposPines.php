<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_pines".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Pines[] $pines
 * @property TiposModulos[] $tiposModulos
 */
class TiposPines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_pines';
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
    public function getPines()
    {
        return $this->hasMany(Pines::className(), ['tipo_pin_id' => 'id'])->inverseOf('tipoPin');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposModulos()
    {
        return $this->hasMany(TiposModulos::className(), ['tipo_pin_id' => 'id'])->inverseOf('tipoPin');
    }
}
