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

    public function getNombre()
    {
        $usuario = $this->usuario;
        return $usuario !== null ? $usuario->username: 'anónimo';
    }

    public function getRutaImagen()
    {
        $usuario = $this->usuario;
        return $usuario !== null ? $usuario->perfil->rutaImagen : Yii::getAlias('/imagenes/avatar/0.png');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id'])->inverseOf('id0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['usuario_id' => 'id'])->inverseOf('usuarioId');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajesRemitente()
    {
        return $this->hasMany(Mensajes::className(), ['remitente_id' => 'id'])->inverseOf('remitente');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajesDestinatario()
    {
        return $this->hasMany(Mensajes::className(), ['destinatario_id' => 'id'])->inverseOf('destinatario');
    }
}
