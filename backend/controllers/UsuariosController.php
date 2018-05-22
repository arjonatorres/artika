<?php

namespace backend\controllers;

use Yii;

use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\ArrayHelper;

use common\models\Generos;
use common\models\Perfiles;
use common\models\Usuarios;
use common\models\UsuariosSearch;

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
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Visualiza una lista con todos los Usuarios.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un Usuario.
     *
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (($usuario = Usuarios::findOne($id)) === null || $id == 1) {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
        $perfil = Perfiles::findOne(['usuario_id' => $id]);

        if ($usuario->load(Yii::$app->request->post()) && $usuario->save()) {
            Yii::$app->session->setFlash('success', 'El usuario ha sido actualizado correctamente.');
        }

        if ($perfil->load(Yii::$app->request->post()) && $perfil->save()) {
            Yii::$app->session->setFlash('success', 'El perfil ha sido actualizado correctamente.');
        }

        $g = Generos::find()->indexBy('id')->asArray()->all();
        $listaGeneros = ArrayHelper::getColumn($g, 'denominacion');

        return $this->render('update', [
            'usuario' => $usuario,
            'perfil' => $perfil,
            'listaGeneros' => $listaGeneros,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionDelete()
    {
        $model = Usuarios::findOne(Yii::$app->request->post('id'));
        $model->delete();
        Yii::$app->session->setFlash('success', 'La cuenta ha sido borrada correctamente.');

        return $this->redirect(['usuarios/index']);
    }
}
