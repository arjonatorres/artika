<?php
namespace frontend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\Usuarios;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    /**
     * La contraseña del usuario
     * @var string
     */
    public $password;
    public $password_repeat;

    /**
     * @var \common\models\Usuarios
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('El token no puede estar vacío.');
        }
        $this->_user = Usuarios::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Token incorrecto.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'password' => 'Contraseña',
            'password_repeat' => 'Confirmación de contraseña',
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
