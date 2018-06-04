<?php

namespace frontend\controllers;

use Yii;

use yii\web\UploadedFile;
use yii\filters\AccessControl;
use common\models\RutasForm;

class RutasController extends \yii\web\Controller
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
     * Muestra una Ruta.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new RutasForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->ruta = UploadedFile::getInstance($model, 'ruta');
            $model->upload();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
