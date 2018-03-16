<?php

namespace frontend\controllers;

use Yii;

use yii\web\Response;

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
        $secciones = $usuario->secciones;
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
        $modelHab = new Habitaciones();
        $usuario = Yii::$app->user->identity;
        $secciones = $usuario->getSecciones()->orderBy('id')->all();

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
            $secciones = Secciones::find()->where(['usuario_id' => Yii::$app->user->id])
            ->orderBy('id')->all();
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
            return UtilHelper::itemHabCasa($model->nombre);
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

        $model = Secciones::findOne([
            'id' => $id,
            'usuario_id' => Yii::$app->user->id,
        ]);

        if ($model->load(Yii::$app->request->post()) && ($model->save())) {
            $secciones = Secciones::find()->where(['usuario_id' => Yii::$app->user->id])
            ->orderBy('id')->all();
            return $model->nombre;
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
}
