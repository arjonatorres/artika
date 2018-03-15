<?php
namespace frontend\controllers;

use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Usuarios;
use common\models\LoginForm;
use frontend\models\RequestActiveEmailForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Loguea a un usuario.
     *
     * @param string $username El nombre del usuario del formulario
     * @return mixed
     */
    public function actionLogin($username = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm(['username' => $username]);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['casas/mi-casa']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Compruebe su email y siga las instrucciones para cambiar su contraseña.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Lo siento, no ha sido posible enviar su email.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Activa la cuenta del usuario a través de un token
     * @param  [type] $token El token de validación
     * @return mixed
     */
    public function actionActiveCount($token = null)
    {
        if ($token !== null) {
            $usuario = Usuarios::findOne(['token_val' => $token]);
            if ($usuario !== null) {
                $usuario->token_val = null;
                $usuario->save();
                Yii::$app->session->setFlash(
                    'success',
                    'Su cuenta ha sido activada correctamente.'
                );
                return $this->redirect(['site/login', 'username' => $usuario->username]);
            }
        }
        return $this->goHome();
    }

    /**
     * Para solicitar el reenvío del mail para activar la cuenta.
     * @return mixed
     */
    public function actionRequestActiveEmail()
    {
        $model = new RequestActiveEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = Usuarios::findOne([
                'email' => $model->email,
            ]);

            if ($user !== null) {
                if ($user->token_val === null) {
                    Yii::$app->session->setFlash('success', 'Este usuario ya está activado.');
                    return $this->redirect(['site/login', 'username' => $user->username]);
                }
                $mail = Yii::$app->mailer->compose(['html' => 'signup'], ['user' => $user])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($model->email)
                    ->setSubject('Activar cuenta desde ' . Yii::$app->name)
                    ->send();

                if ($mail) {
                    Yii::$app->session->setFlash('success', 'Compruebe su email para activar su cuenta.');

                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error', 'Lo siento, no ha sido posible enviar su email.');
                }
            }
        }

        return $this->render('requestActiveEmail', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Su contraseña ha sido cambiada con éxito.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
