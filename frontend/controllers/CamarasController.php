<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;

use yii\filters\AccessControl;

use yii\widgets\ActiveForm;

use common\models\Camaras;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\helpers\UtilHelper;

/**
 * CamarasController implements the CRUD actions for Camaras model.
 */
class CamarasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
     * Lists all Camaras models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Camaras([
            'usuario_id' => Yii::$app->user->id,
            'puerto' => '80',
        ]);
        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                return $this->renderAjax('_crear-camara', [
                    'model' => $model,
                ]);
            }
        }
        $usuario = Yii::$app->user->identity;
        $camaras = $usuario->getCamaras()->orderBy('id')->all();

        return $this->render('index', [
            'model' => $model,
            'camaras' => $camaras,
        ]);
    }

    /**
     * Displays a single Camaras model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        $model = $this->findModel($id);

        if ($model === null) {
            return;
        }
        return $this->renderAjax('_view', [
            'model' => $model,
        ]);
    }

    /**
     * Crea una cámara vía Ajax
     * @return mixed
     */
    public function actionCrearCamaraAjax()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        $model = new Camaras(['usuario_id' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return UtilHelper::itemMenuCamara($model);
        }
        return;
    }

    /**
     * Modifica una cámara
     * @param  int $id El id de la cámara a modificar vía Ajax
     * @return mixed
     */
    public function actionModificarCamaraAjax($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($model === null) {
            return;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model;
        }
        return;
    }

    /**
     * Updates an existing Camaras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($model === null) {
            return;
        }

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->renderAjax('_mod-camara', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Camaras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($model === null) {
            return;
        }

        return $model->delete();
    }

    /**
     * Finds the Camaras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Camaras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Camaras::findOne([
            'id' => $id,
            'usuario_id' => Yii::$app->user->id,
            ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
