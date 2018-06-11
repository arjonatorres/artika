<?php
namespace frontend\models;

use Yii;

use yii\base\Model;
use common\models\Usuarios;

/**
 * Change password form
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_password', 'password', 'password_repeat'], 'required'],
            [['old_password', 'password'], 'string', 'length' => [6, 255]],
            [
                ['password_repeat'],
                'compare',
                'compareAttribute' => 'password',
                'skipOnEmpty' => false,
            ],
            [['old_password'], function ($attribute, $params, $validator) {
                $user = Usuarios::findOne(Yii::$app->user->id);
                if (!Yii::$app->security->validatePassword($this->old_password, $user->password_hash)) {
                    $this->addError($attribute, 'La contraseña no coincide con tu contraseña actual');
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
            'old_password' => 'Contraseña actual',
            'password' => 'Nueva contraseña',
            'password_repeat' => 'Confirmación de nueva contraseña',
        ];
    }
}
