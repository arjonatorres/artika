<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Servidores;
use yii\web\Controller;

/**
 * ServidoresController implements the CRUD actions for Servidores model.
 */
class ServidoresController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Crea o modifica un modelo Servidores.
     * @return mixed
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $model = Servidores::findOne(['usuario_id' => $user_id]);
        if ($model === null) {
            $model = new Servidores([
                'usuario_id' => $user_id,
                'puerto' => '8080',
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Los datos del servidor se han guardado correctamente.');
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
