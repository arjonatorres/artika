<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "habitaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property int $seccion_id
 * @property int $icono_id
 *
 * @property Secciones $seccion
 */
class Habitaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'habitaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'seccion_id', 'icono_id'], 'required'],
            [['seccion_id', 'icono_id'], 'default', 'value' => null],
            [['seccion_id', 'icono_id'], 'integer'],
            [['nombre'], 'trim'],
            [['nombre'], 'string', 'length' => [4, 20]],
            [
                ['nombre', 'seccion_id'],
                'unique',
                'targetAttribute' => ['nombre', 'seccion_id'],
                'message' => 'La habitación \'{value}\' ya existe',
            ],
            [['seccion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Secciones::className(), 'targetAttribute' => ['seccion_id' => 'id']],
            [['seccion_id'], function ($attribute, $params, $validator) {
                $seccion = Secciones::findOne(['id' => $this->$attribute]);
                if ($seccion->usuario_id !== Yii::$app->user->identity->id) {
                    $this->addError($attribute, 'Sección no válida');
                }
            }],
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
            'seccion_id' => 'Sección',
            'icono_id' => 'Icono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeccion()
    {
        return $this->hasOne(Secciones::className(), ['id' => 'seccion_id'])->inverseOf('habitaciones');
    }
}
