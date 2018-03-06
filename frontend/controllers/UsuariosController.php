<?php

namespace frontend\controllers;

use Yii;

use yii\web\Response;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

use yii\widgets\ActiveForm;

use common\models\Usuarios;

use frontend\models\SignupForm;

class UsuariosController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['cuenta', 'delete'],
                'rules' => [
                    [
                        'actions' => ['cuenta', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Actualiza los datos de la cuenta del usuario
     * @return mixed
     */
    public function actionCuenta()
    {
        $model = Usuarios::findOne(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tu cuenta ha sido actualizada correctamente.');
            return $this->redirect(['cuenta', 'model' => $model]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Socios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $model = Usuarios::findOne(Yii::$app->user->id);
        $model->delete();
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'La cuenta ha sido borrada correctamente.');

        return $this->redirect(['site/index']);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionRegistro()
    {
        $model = new SignupForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $mail = Yii::$app->mailer->compose(['html' => 'signup'], ['user' => $user])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($model->email)
                    ->setSubject('Activar cuenta desde ' . Yii::$app->name)
                    ->send();
                if ($mail) {
                    Yii::$app->session->setFlash('success', 'Gracias por registrarte. Comprueba tu correo para activar tu cuenta.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ha ocurrido un error al enviar el correo.');
                }
                return $this->goHome();
            }
        }

        return $this->render('registro', [
            'model' => $model,
        ]);
    }
}
