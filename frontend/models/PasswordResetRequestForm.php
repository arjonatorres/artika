<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Usuarios;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    /**
     * El email del usuario
     * @var string
     */
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Usuarios',
                'message' => 'No existe ningún usuario con este email.',
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user Usuarios */
        $user = Usuarios::findOne([
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!Usuarios::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(['html' => 'passwordReset'], ['user' => $user])
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Cambiar contraseña desde ' . Yii::$app->name)
            ->send();
    }
}
