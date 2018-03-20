<?php

namespace common\models;

/**
 * This is the model class for table "secciones".
 *
 * @property int $id
 * @property string $nombre
 * @property int $usuario_id
 *
 * @property Usuarios $usuario
 */
class Secciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'secciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'usuario_id'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['nombre'], 'trim'],
            [['nombre'], 'string', 'length' => [4, 20]],
            [
                ['nombre', 'usuario_id'],
                'unique',
                'targetAttribute' => ['nombre', 'usuario_id'],
                'message' => 'La sección \'{value}\' ya existe',
            ],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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
            'usuario_id' => 'Usuario',
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getHabitaciones()
    {
        return $this->hasMany(Habitaciones::className(), ['seccion_id' => 'id'])->inverseOf('seccion');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('secciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulos::className(), ['habitacion_id' => 'id'])
            ->via('habitaciones');
    }
}
