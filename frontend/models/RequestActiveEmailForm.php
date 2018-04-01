<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Usuarios;

use common\helpers\UtilHelper;

/**
 * Password reset request form
 */
class RequestActiveEmailForm extends Model
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
        return UtilHelper::enviarMail(
            'signup',
            ['user' => $user],
            $model->email,
            'Activar cuenta desde ' . Yii::$app->name
        );
    }
}
