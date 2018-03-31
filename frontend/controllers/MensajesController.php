<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Mensajes;
use common\models\MensajesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MensajesController implements the CRUD actions for Mensajes model.
 */
class MensajesController extends Controller
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
     * Lists all Mensajes models.
     * @return mixed
     */
    public function actionRecibidos()
    {
        $searchModel = new MensajesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('recibidos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mensajes model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $userId = Yii::$app->user->id;
        if ($model->destinatario_id !== $userId && $model->remitente_id !== $userId) {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
        if ($model->estado === Mensajes::ESTADO_NO_LEIDO) {
            $model->estado = Mensajes::ESTADO_LEIDO;
            $model->save();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mensajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $id El id del usuario destinatario
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new Mensajes([
            'remitente_id' => Yii::$app->user->id,
            'destinatario_id' => $id,
            'estado' => 0,
        ]);

        if ($id !== null && $model->destinatario === null) {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }

        if (($post = Yii::$app->request->post())) {
            if (is_array($post['Mensajes']['destinatario_id']) && isset($post['Mensajes']['destinatario_id'])) {
                foreach ($post['Mensajes']['destinatario_id'] as $dest) {
                    $model = new Mensajes([
                        'remitente_id' => Yii::$app->user->id,
                        'destinatario_id' => $id,
                        'estado' => 0,
                    ]);
                    $post['Mensajes']['destinatario_id'] = $dest;
                    $model->load($post);
                    $model->save();
                }
                Yii::$app->session->setFlash('success', 'Su mensaje ha sido enviado correctamente');
                return $this->redirect(['recibidos']);
            } else {
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'Su mensaje ha sido enviado correctamente');
                    return $this->redirect(['recibidos']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mensajes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mensajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Mensajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensajes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }
}
