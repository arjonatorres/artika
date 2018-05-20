<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'rememberMe' => 'Recuérdame',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if ($this->getUser()->token_val === null) {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
            Yii::$app->session->setFlash(
                'error',
                'Su cuenta no ha sido activada aún. Para activar '
                . 'su cuenta pulsa en el enlace del email que se le envió.'
            );
        }

        return false;
    }

    /**
     * Logs in a user using the provided username and password at backend aplication.
     *
     * @return bool whether the user is logged in successfully
     */
    public function loginBackend()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user->token_val === null && $user->id === 1) {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
            Yii::$app->session->setFlash(
                'error',
                'No tiene permiso para iniciar sesión.'
            );
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Usuarios|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Usuarios::findByUsername($this->username);
        }

        return $this->_user;
    }
}
