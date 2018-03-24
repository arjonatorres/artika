<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use common\models\Secciones;
use common\models\Habitaciones;
use common\helpers\UtilHelper;

class CasasController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'borrar-seccion' => ['POST'],
                ],
            ],
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
     * Muestra la casa con sus secciones y habitaciones
     * @return mixed
     */
    public function actionMiCasa()
    {
        $usuario = Yii::$app->user->identity;
        $query = $usuario->getSecciones()->with('habitaciones')->orderBy('id');
        $secciones = $query->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->joinWith('modulos', true, 'RIGHT JOIN'),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
        $modelHab = new Habitaciones();
        $usuario = Yii::$app->user->identity;
        $secciones = $usuario->getSecciones()->with('habitaciones')->orderBy('id')->all();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } elseif ($modelHab->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($modelHab);
            } else {
                return $this->renderAjax('_crear-seccion', [
                    'secciones' => $secciones,
                    'modelHab' => $modelHab,
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('index', [
                'secciones' => $secciones,
                'modelHab' => $modelHab,
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
            return UtilHelper::itemMenuCasa($model);
        }
        return;
    }

    /**
     * Crea una habitación de la casa vía Ajax
     * @return mixed
     */
    public function actionCrearHabitacionAjax()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        $model = new Habitaciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return UtilHelper::itemSecundarioCasa($model);
        }
        return;
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

        $model = Secciones::findOne([
            'id' => $id,
            'usuario_id' => Yii::$app->user->id,
        ]);

        if ($model === null) {
            return;
        }

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->renderAjax('_editar-seccion', [
            'model' => $model,
        ]);
    }

    /**
     * Modifica una habitación en la casa
     * @param  int $id        El id de la habitación a modificar
     * @return mixed
     */
    public function actionModificarHabitacion($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Habitaciones::findOne([
            'id' => $id,
        ]);
        $secciones = Yii::$app->user->identity->getSecciones()->orderBy('id')->all();

        if ($model === null || !$model->esPropia) {
            return;
        }

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->renderAjax('_mod-habitacion', [
            'modelHab' => $model,
            'secciones' => $secciones,
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

        $model = Secciones::findOne([
            'id' => $id,
            'usuario_id' => Yii::$app->user->id,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $model->nombre;
        }
        return;
    }

    /**
     * Modifica una habitación en la casa
     * @param  int $id El id de la habitación a modificar vía Ajax
     * @return mixed
     */
    public function actionModificarHabitacionAjax($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Habitaciones::findOne([
            'id' => $id,
        ]);

        if ($model === null || !$model->esPropia) {
            return;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model;
        }
        return;
    }

    /**
     * Borra una sección existente
     * @param  int $id El id de la sección a borrar
     * @return bool    Si ha podido borrarse o no
     */
    public function actionBorrarSeccion($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Secciones::findOne([
            'id' => $id,
            'usuario_id' => Yii::$app->user->id,
        ]);

        return $model->delete();
    }

    /**
     * Borra una habitación existente
     * @param  int $id El id de la habitación a borrar
     * @return bool    Si ha podido borrarse o no
     */
    public function actionBorrarHabitacion($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Habitaciones::findOne([
            'id' => $id,
        ]);

        if ($model === null || !$model->esPropia) {
            return false;
        }

        return $model->delete();
    }
}
