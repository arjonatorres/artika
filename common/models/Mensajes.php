<?php

namespace common\models;

use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mensajes".
 *
 * @property int $id
 * @property string $asunto
 * @property string $contenido
 * @property int $remitente_id
 * @property int $destinatario_id
 * @property int $estado_rem
 * @property int $estado_dest
 * @property string $created_at
 *
 * @property UsuariosId $remitente
 * @property UsuariosId $destinatario
 */
class Mensajes extends ActiveRecord
{
    /**
     * Indica que el mensaje está borrado
     * @var int
     */
    const ESTADO_BORRADO = -1;

    /**
     * Indica que el mensaje no está leido
     * @var int
     */
    const ESTADO_NO_LEIDO = 0;

    /**
     * Indica que el mensaje está leido
     * @var int
     */
    const ESTADO_LEIDO = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensajes';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
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
            [['asunto', 'contenido', 'remitente_id', 'destinatario_id', 'estado_rem', 'estado_dest'], 'required'],
            [['remitente_id', 'destinatario_id', 'estado_rem', 'estado_dest'], 'default', 'value' => null],
            [['remitente_id', 'destinatario_id', 'estado_rem', 'estado_dest'], 'integer'],
            [['created_at'], 'safe'],
            [['asunto'], 'string', 'max' => 255],
            [['contenido'], 'string', 'max' => 10000],
            [['remitente_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsuariosId::className(), 'targetAttribute' => ['remitente_id' => 'id']],
            [['destinatario_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsuariosId::className(), 'targetAttribute' => ['destinatario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asunto' => 'Asunto',
            'contenido' => 'Contenido',
            'remitente_id' => 'Remitente',
            'destinatario_id' => 'Destinatario(s)',
            'estado_rem' => 'Estado',
            'estado_dest' => 'Estado',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemitente()
    {
        return $this->hasOne(UsuariosId::className(), ['id' => 'remitente_id'])->inverseOf('mensajesRemitente');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestinatario()
    {
        return $this->hasOne(UsuariosId::className(), ['id' => 'destinatario_id'])->inverseOf('mensajesDestinatario');
    }
}
