<?php

namespace frontend\controllers;

use Yii;

use yii\web\Response;

use yii\widgets\ActiveForm;

use common\models\Tipos;
use common\models\Modulos;

use common\helpers\UtilHelper;

class ModulosController extends \yii\web\Controller
{
    /**
     * Muestra la página para crear módulos
     * @return string
     */
    public function actionCreate()
    {
        $usuario = Yii::$app->user->identity;
        $habitaciones = $usuario->getHabitaciones()->orderBy('nombre')->all();
        $tipos = Tipos::find()->all();
        $model = new Modulos();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }
        return $this->render('index', [
            'model' => $model,
            'habitaciones' => $habitaciones,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Crea un módulo vía Ajax
     * @return mixed
     */
    public function actionCreateAjax()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        $model = new Modulos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return UtilHelper::itemSecundarioCasa($model, true, 'modulo', 'modulos/');
        }
        return;
    }
}
