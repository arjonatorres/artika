<?php

namespace common\models;

use Yii;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "modulos".
 *
 * @property int $id
 * @property string $nombre
 * @property int $habitacion_id
 * @property int $tipo_modulo_id
 * @property int $icono_id
 * @property int $estado
 * @property int $pin1_id
 * @property int $pin2_id
 *
 * @property Habitaciones $habitacion
 * @property TiposModulos $tipo
 */
class Modulos extends \yii\db\ActiveRecord
{
    const SCENARIO_PERSIANA = 'persiana';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'habitacion_id', 'tipo_modulo_id', 'pin1_id'], 'required'],
            [['habitacion_id', 'tipo_modulo_id', 'icono_id', 'pin1_id', 'pin2_id'], 'default', 'value' => null],
            [['habitacion_id', 'tipo_modulo_id', 'icono_id', 'estado', 'pin1_id', 'pin2_id'], 'integer'],
            [['nombre'], 'string', 'length' => [4, 20]],
            [['pin2_id'], 'required', 'on' => self::SCENARIO_PERSIANA],
            [
                ['nombre'],
                'unique',
                'targetAttribute' => ['nombre', 'habitacion_id'],
                'message' => 'El módulo \'{value}\' ya existe en este habitación',
            ],
            [
                ['habitacion_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Habitaciones::className(),
                'targetAttribute' => ['habitacion_id' => 'id']
            ],
            [
                ['habitacion_id'], function ($attribute, $params, $validator) {
                    $habitacion = Habitaciones::findOne(['id' => $this->$attribute]);
                    if ($habitacion->seccion->usuario_id !== Yii::$app->user->identity->id) {
                        $this->addError($attribute, 'Habitación no válida');
                    }
                }
            ],
            [
                ['pin1_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Pines::className(),
                'targetAttribute' => ['pin1_id' => 'id']
            ],
            [
                ['pin2_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Pines::className(),
                'targetAttribute' => ['pin2_id' => 'id']
            ],
            [
                ['tipo_modulo_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => TiposModulos::className(),
                'targetAttribute' => ['tipo_modulo_id' => 'id']
            ],
            [
                ['pin1_id'], function ($attribute, $params, $validator) {
                    if ($this->$attribute == $this->getOldAttribute($attribute)) {
                        return;
                    }
                    if (in_array($this->$attribute, self::pinesOcupados())) {
                        $this->addError($attribute, 'Pin principal ya está siendo usado');
                    }
                }
            ],
            [
                ['pin2_id'], function ($attribute, $params, $validator) {
                    if ($this->$attribute == $this->getOldAttribute($attribute)) {
                        return;
                    }
                    if (in_array($this->$attribute, self::pinesOcupados())) {
                        $this->addError($attribute, 'Pin secundario ya está siendo usado');
                    }
                }
            ],
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
            'habitacion_id' => 'Habitacion',
            'tipo_modulo_id' => 'Tipo de módulo',
            'icono_id' => 'Icono',
            'pin1_id' => 'Pin principal',
            'pin2_id' => 'Pin secundario',
        ];
    }

    /**
     * Devuelve los pines libres que hay en arduino de un determinado tipo y
     * para el usuario actual
     * @param  int $tipo_pin_id El tipo de pin (entrada ó salida)
     * @return array            Un array con el id de cada pin libre
     */
    public static function pinesLibres($tipo_pin_id)
    {
        $array = self::pinesOcupados();
        $tipos = Pines::find()->select('id')
            ->where(['tipo_pin_id' => $tipo_pin_id])->asArray()->all();
        $tipos = ArrayHelper::getColumn($tipos, 'id');

        return array_diff($tipos, $array);
    }

    public static function pinesOcupados()
    {
        $pines = Usuarios::findOne(Yii::$app->user->id)->getModulos()
            ->select(['pin1_id', 'pin2_id'])
            ->andWhere('pin1_id is not null')
            ->asArray()->all();

        $pines1 = ArrayHelper::getColumn($pines, 'pin1_id');
        // ArrayHelper::removeValue($pines1, null);
        $pines2 = ArrayHelper::getColumn($pines, 'pin2_id');
        ArrayHelper::removeValue($pines2, null);
        $array = array_merge($pines1, $pines2);
        return $array;
    }

    /**
     * Devuelve verdadero si el módulo pertenece al usuario logueado.
     * @return bool Si pertenece al usuario o no.
     */
    public function getEsPropia()
    {
        return $this->usuario->id == Yii::$app->user->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])
            ->via('seccion');
    }


    /**
    * @return \yii\db\ActiveQuery
     */
    public function getSeccion()
    {
        return $this->hasOne(Secciones::className(), ['id' => 'seccion_id'])
            ->via('habitacion');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHabitacion()
    {
        return $this->hasOne(Habitaciones::className(), ['id' => 'habitacion_id'])
            ->inverseOf('modulos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoModulo()
    {
        return $this->hasOne(TiposModulos::className(), ['id' => 'tipo_modulo_id'])->inverseOf('modulos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPin1()
    {
        return $this->hasOne(Pines::className(), ['id' => 'pin1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPin2()
    {
        return $this->hasOne(Pines::className(), ['id' => 'pin2_id']);
    }
}
