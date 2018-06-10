<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Usuarios;
use common\models\UsuariosId;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Usuarios', 'message' => 'Este nombre de usuario ya ha sido usado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [
                ['username'],
                'match',
                'pattern' => '/^[a-zA-Z0-9]+([_\-\.]?[a-zA-Z0-9])*$/',
                'message' => 'El nombre de usuario sólo puede contener los siguientes carácteres (A-z 0-9) separados por (-_.)',
            ],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Usuarios', 'message' => 'Esta dirección de email ya ha sido usada.'],

            [['password', 'password_repeat'], 'required'],
            ['password', 'string', 'length' => [6, 255]],
            [
                ['password_repeat'],
                'compare',
                'compareAttribute' => 'password',
                'skipOnEmpty' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
            'password_repeat' => 'Confirmación de contraseña',
            'email' => 'Email',
        ];
    }

    /**
     * Signs user up.
     *
     * @return Usuarios|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user_id = new UsuariosId();
        $user_id->save();

        $user = new Usuarios(['id' => $user_id->id]);
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateTokenVal();

        return $user->save() ? $user : null;
    }
}
