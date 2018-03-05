<?php

namespace frontend\controllers;

use Yii;

use yii\filters\AccessControl;

use common\models\Usuarios;

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
                // 'only' => ['update'],
                'rules' => [
                    [
                        'actions' => ['cuenta'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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
}
