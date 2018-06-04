<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Pines;
use common\models\Usuarios;
use common\models\Servidores;
use yii\web\Controller;

use common\helpers\UtilHelper;

/**
 * ServidoresController implements the CRUD actions for Servidores model.
 */
class ServidoresController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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
     * Crea o modifica un modelo Servidores.
     * @return mixed
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $model = Servidores::findOne(['usuario_id' => $user_id]);
        if ($model === null) {
            $model = new Servidores([
                'usuario_id' => $user_id,
                'puerto' => '8080',
            ]);
        }
        $usuario = Usuarios::findOne(['id' => $user_id]);
        $modulos = $usuario->getModulos()->asArray()->all();
        $pines = Pines::find()->asArray();
        $habitaciones = UtilHelper::getDropDownList($usuario->getHabitaciones()->all());

        if ($model->load(Yii::$app->request->post())) {
            if ($model->token_val == null) {
                $model->token_val = Yii::$app->security->generateRandomString();
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Los datos del servidor se han
                guardado correctamente. El token de seguridad deberá introducirlo
                en una variable de entorno en la Raspberry tal y como está explicado
                en el manual.');
                Yii::$app->session->setFlash('danger', "Token de seguridad: $model->token_val");
            } else {
                Yii::$app->session->setFlash('danger', 'No se han podido guardar los datos del servidor.');
            }
        }

        return $this->render('index', [
            'model' => $model,
            'modulos' => $modulos,
            'pines' => $pines,
            'habitaciones' => $habitaciones,
        ]);
    }
}
