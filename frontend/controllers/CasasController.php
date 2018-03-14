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
     * Crea una sección nueva de la casa
     * @return mixed
     */
    public function actionCrearSeccion()
    {
        $model = new Secciones([
            'usuario_id' => Yii::$app->user->id,
        ]);
        $secciones = Yii::$app->user->identity->getSecciones()->orderBy('id')->all();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                return $this->renderAjax('_crear-seccion', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('index', [
                'secciones' => $secciones,
                'model' => $model,
            ]);
        }
    }

    /**
     * Crea una sección de la casa vía Ajax
     * @return mixed
     */
    public function actionCrearSeccionAjax()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        $model = new Secciones([
            'usuario_id' => Yii::$app->user->id,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $secciones = Secciones::find(['usuario_id' => Yii::$app->user->id])
            ->orderBy('id')->all();
            return $this->renderAjax('_menu-casa', [
                'secciones' => $secciones,
            ]);
        }
    }

    /**
     * Modifica una sección en la casa
     * @param  int $id El id de la sección a modificar
     * @return mixed
     */
    public function actionModificarSeccion($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Secciones::findOne(['id' => $id]);

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->renderAjax('_editar-seccion', [
            'model' => $model,
        ]);
    }

    /**
     * Modifica una sección en la casa
     * @param  int $id El id de la sección a modificar vía Ajax
     * @return mixed
     */
    public function actionModificarSeccionAjax($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Secciones::findOne(['id' => $id]);

        if ($model->load(Yii::$app->request->post()) && ($model->save())) {
            $secciones = Secciones::find(['usuario_id' => Yii::$app->user->id])
            ->orderBy('id')->all();
            return $this->renderAjax('_menu-casa', [
                'secciones' => $secciones,
            ]);
        }
        return $this->renderAjax('_editar-seccion', [
            'model' => $model,
        ]);
    }
}
