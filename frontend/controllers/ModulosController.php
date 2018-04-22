<?php

namespace frontend\controllers;

use Yii;

use yii\web\Response;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\Json;

use yii\widgets\ActiveForm;

use common\models\Logs;
use common\models\Pines;
use common\models\TiposModulos;
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
        $tipos_modulos = TiposModulos::find()->all();
        $model = new Modulos();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->tipo_modulo_id == 2) {
                    $model->scenario = Modulos::SCENARIO_PERSIANA;
                }
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                return $this->renderAjax('_create', [
                    'model' => $model,
                    'habitaciones' => $habitaciones,
                    'tipos_modulos' => $tipos_modulos,
                ]);
            }
        }
        return $this->render('index', [
            'model' => $model,
            'habitaciones' => $habitaciones,
            'tipos_modulos' => $tipos_modulos,
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
        $tipos_modulos = TiposModulos::find()->all();

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
            'tipos_modulos' => $tipos_modulos,
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
        // $id = 1;
        // $orden = 1;
        $modulo = Modulos::findOne($id);

        if ($modulo === null || !$modulo->esPropia) {
            return 'error';
        }
        $pin1 = $modulo->pin1->nombre;
        $tipo = substr($pin1, 0, 1);
        $pin1 = substr($pin1, 1);

        if ($modulo->pin2 !== null) {
            $pin2 = $modulo->pin2->nombre;
            $pin2 = substr($pin2, 1);
        } else {
            $pin2 = null;
        }

        $datos = urlencode(json_encode([
            'tipo' => $tipo,
            'orden' => $orden,
            'pin1' => $pin1,
            'pin2' => $pin2
        ]));

        $res = UtilHelper::envioCurl($datos);
        $output = $res['output'];
        $code = $res['code'];
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($code == 200) {
            if ($output == $orden) {
                $modulo->estado = $orden;
                if ($modulo->save()) {
                    $res = 'ok';
                    $log = new Logs(['usuario_id' => Yii::$app->user->id]);
                    $log->descripcion = $modulo->nombre . '/'
                        . $modulo->habitacion->nombre . '/'
                        . $modulo->seccion->nombre . ' | '
                        . 'Estado: ' . $modulo->estado;
                    $log->save();
                } else {
                    $res = 'error';
                }
            } else {
                $res = 'error';
            }
            return $res;
        }
        return false;
    }

    /**
     * Devuelve un array con los pines disponibles para el pin principal de Arduino
     * @return array El array a devolver
     */
    public function actionPinPrincipal()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $tipo_modulo_id = $parents[0];
                $tipo_pin_id = TiposModulos::find()->select('tipo_pin_id')
                    ->where(['id' => $tipo_modulo_id])->scalar();
                $pines_id = Modulos::pinesLibres($tipo_pin_id);
                $selected = '';
                if (isset($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    if ($params != null) {
                        $pin1_id = $params[0];
                        $tipo_pin_id_pines = Pines::find()->select('tipo_pin_id')
                            ->where(['id' => $pin1_id])->scalar();
                        if ($tipo_pin_id == $tipo_pin_id_pines) {
                            array_unshift($pines_id, $pin1_id);
                            $selected = $pin1_id;
                        }
                    }
                }
                $out = Pines::find()->select(['id', 'nombre AS name'])
                    ->where(['in', 'id', $pines_id])->asArray()->all();
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Devuelve un array con los pines disponibles para el pin secundario de Arduino
     * @return array El array a devolver
     */
    public function actionPinSecundario()
    {
        $out = [];
        if (isset($_POST['depdrop_params'])) {
            $params = $_POST['depdrop_params'];
            if ($params[0] != 2) {
                return;
            }
        }
        if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                if ($parents[0] != '') {
                    $pin1_id = $parents[0];
                    $pines_id = Modulos::pinesLibres(1);
                    $pines_id = array_diff($pines_id, [$pin1_id]);
                    $selected = '';
                    if (isset($_POST['depdrop_params'])) {
                        $params = $_POST['depdrop_params'];
                        if ($params != null) {
                            if (isset($params[1])) {
                                $pin2_id = $params[1];
                                array_unshift($pines_id, $pin2_id);
                                $selected = $pin2_id;
                            }
                        }
                    }
                    $out = Pines::find()->select(['id', 'nombre AS name'])
                    ->where(['in', 'id', $pines_id])->asArray()->all();
                    echo Json::encode(['output' => $out, 'selected' => $selected]);
                    return;
                }
            }
        }
        return;
    }
}
