<?php

namespace frontend\controllers;

use Yii;

use yii\db\Query;

use yii\web\Response;
use yii\web\UploadedFile;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

use common\models\Generos;
use common\models\Perfiles;
use common\models\Usuarios;

use frontend\models\SignupForm;

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
                        'actions' => ['mod-cuenta', 'mod-perfil', 'mod-avatar', 'delete', 'lista-usuarios'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['registro'],
                        'allow' => true,
                        'roles' => ['?'],
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
     * Actualiza los datos del avatar del usuario
     * @return mixed
     */
    public function actionModAvatar()
    {
        $model = Perfiles::findOne(['usuario_id' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post())) {
            $model->foto = UploadedFile::getInstance($model, 'foto');
            if ($model->save() && $model->upload()) {
                Yii::$app->session->setFlash('success', 'Tu avatar ha sido actualizado correctamente.');
                return $this->redirect(['mod-avatar']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Actualiza los datos de la cuenta del usuario
     * @return mixed
     */
    public function actionModCuenta()
    {
        $model = Usuarios::findOne(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tu cuenta ha sido actualizada correctamente.');
            return $this->redirect(['mod-cuenta']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Actualiza los datos de la cuenta del usuario
     * @return mixed
     */
    public function actionModPerfil()
    {
        $model = Perfiles::findOne(['usuario_id' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tu perfil ha sido actualizado correctamente.');
            return $this->redirect(['mod-perfil']);
        }

        $g = Generos::find()->indexBy('id')->asArray()->all();
        $listaGeneros = ArrayHelper::getColumn($g, 'denominacion');

        return $this->render('update', [
            'model' => $model,
            'listaGeneros' => $listaGeneros,
        ]);
    }

    /**
     * Deletes an existing Socios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $model = Usuarios::findOne(Yii::$app->user->id);
        $model->delete();
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'La cuenta ha sido borrada correctamente.');

        return $this->redirect(['site/index']);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionRegistro()
    {
        $model = new SignupForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                (new Perfiles(['usuario_id' => $user->id]))->save();
                $mail = Yii::$app->mailer->compose(['html' => 'signup'], ['user' => $user])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($model->email)
                    ->setSubject('Activar cuenta desde ' . Yii::$app->name)
                    ->send();
                if ($mail) {
                    Yii::$app->session->setFlash('success', 'Gracias por registrarte. Comprueba tu correo para activar tu cuenta.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ha ocurrido un error al enviar el correo.');
                }
                return $this->goHome();
            }
        }

        return $this->render('registro', [
            'model' => $model,
        ]);
    }

    /**
     * Devuelve una lista con todos los ids y nombres de usuarios
     * @param  [type] $q  [description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionListaUsuarios($q = null, $id = null)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '', 'url' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, username AS text')
                ->from('usuarios')
                ->where(['like', 'username', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
            foreach ($out['results'] as $key => $res) {
                $usuario = Usuarios::findOne($res['id']);
                $out['results'][$key]['url'] = $usuario->perfil->rutaImagen;
            }
        } elseif ($id > 0) {
            $usuario = Usuarios::find($id);
            $out['results'] = [
                'id' => $id,
                'text' => $usuario->name,
                'ulr' => $usuario->perfil->rutaImagen,
            ];
        }
        return $out;
    }
}
