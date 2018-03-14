<?php

namespace frontend\controllers;

use Yii;

use yii\web\Response;

use yii\widgets\ActiveForm;

use common\models\Secciones;

class CasasController extends \yii\web\Controller
{
    /**
     * Muestra la casa con sus secciones y habitaciones
     * @return mixed
     */
    public function actionMiCasa()
    {
        $secciones = Yii::$app->user->identity->secciones;
        return $this->render('index', [
            'secciones' => $secciones,
            'model' => [],
        ]);
    }

    /**
     * Muestra la casa con sus secciones y habitaciones
     * @return mixed
     */
    public function actionSecciones()
    {
        $model = new Secciones([
            'usuario_id' => Yii::$app->user->id,
        ]);
        $secciones = Yii::$app->user->identity->secciones;

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            return $this->render('index', [
                'secciones' => $secciones,
                'model' => $model,
            ]);
        }
    }

    /**
     * Crea una sección en la casa
     * @return mixed
     */
    public function actionCrearSeccion()
    {
        $model = new Secciones([
            'usuario_id' => Yii::$app->user->id,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $secciones = Secciones::findAll(['usuario_id' => Yii::$app->user->id]);
            return $this->renderAjax('_menu-casa', [
                'secciones' => $secciones,
            ]);
        }
    }
}
