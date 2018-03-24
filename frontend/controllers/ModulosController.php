<?php

namespace frontend\controllers;

use Yii;

use yii\web\Response;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\widgets\ActiveForm;

use common\models\Tipos;
use common\models\Modulos;

use common\helpers\UtilHelper;

class ModulosController extends \yii\web\Controller
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
     * Muestra la página para crear módulos
     * @return string
     */
    public function actionCreate()
    {
        $habitaciones = Yii::$app->user->identity->getHabitaciones()
            ->with('modulos')
            ->orderBy('nombre')
            ->all();
        $tipos = Tipos::find()->all();
        $model = new Modulos();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                return $this->renderAjax('_create', [
                    'model' => $model,
                    'habitaciones' => $habitaciones,
                    'tipos' => $tipos,
                ]);
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

    /**
     * Muestra la página para modificar módulos
     * @param  int $id El id de la habitación a modificar
     * @return mixed
     */
    public function actionModificarModulo($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Modulos::findOne([
            'id' => $id,
        ]);
        $habitaciones = Yii::$app->user->identity->getHabitaciones()
            ->with('modulos')
            ->orderBy('nombre')
            ->all();
        $tipos = Tipos::find()->all();

        if ($model === null || !$model->esPropia) {
            return;
        }

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return $this->renderAjax('_modificar-modulo', [
            'model' => $model,
            'habitaciones' => $habitaciones,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Modifica un módulo
     * @param  int $id El id del módulo a modificar vía Ajax
     * @return mixed
     */
    public function actionModificarModuloAjax($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Modulos::findOne([
            'id' => $id,
        ]);

        if ($model === null || !$model->esPropia) {
            return;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return true;
        }
        return;
    }

    /**
     * Borra un módulo
     * @param  int $id El id del módulo a borrar
     * @return bool    Si ha podido borrarse o no
     */
    public function actionBorrarModulo($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }

        $model = Modulos::findOne([
            'id' => $id,
        ]);

        if ($model === null || !$model->esPropia) {
            return false;
        }

        return $model->delete();
    }

    /**
     * Manda una orden al servidor de la casa para que la ejecute
     * @return mixed El string enviado por el servidor o false si no se recibe
     *               respuesta del servidor
     */
    public function actionOrden()
    {
        if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        $id = Yii::$app->request->post('id');
        $orden = Yii::$app->request->post('orden');
        $nombre = Yii::$app->user->identity->username;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'nombre' => $nombre,
            'password' => $nombre . getenv('PASSWORD_USUARIO'),
            'id' => $id,
            'orden' => $orden,
        ]);
        curl_setopt($ch, CURLOPT_URL, 'http://joseartika.ddns.net:8082/orden.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        $output = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($code == 200) {
            if ($output == 'ok') {
                $modulo = Modulos::findOne(['id' => $id]);
                if ($modulo === null || !$modulo->esPropia) {
                    $output = 'error';
                } else {
                    $modulo->estado = $orden;
                    $modulo->save();
                }
            }
            return $output;
        }
        return false;
    }
}
