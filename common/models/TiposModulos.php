<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipos_modulos".
 *
 * @property int $id
 * @property string $nombre
 * @property int $tipo_pin_id
 *
 * @property Modulos[] $modulos
 * @property TiposPines $tipoPin
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
            [['nombre', 'tipo_pin_id'], 'required'],
            [['tipo_pin_id'], 'default', 'value' => null],
            [['tipo_pin_id'], 'integer'],
            [['nombre'], 'string', 'max' => 20],
            [['nombre'], 'unique'],
            [['tipo_pin_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposPines::className(), 'targetAttribute' => ['tipo_pin_id' => 'id']],
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
            'tipo_pin_id' => 'Tipo pin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulos::className(), ['tipo_modulo_id' => 'id'])->inverseOf('tipo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPin()
    {
        return $this->hasOne(TiposPines::className(), ['id' => 'tipo_pin_id'])->inverseOf('tiposModulos');
    }
}
