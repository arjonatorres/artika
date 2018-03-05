<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;

$this->title = 'Configuración';
$this->params['breadcrumbs'][] = $this->title;

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($model->username) ?></h3>
                </div>
                <div class="panel-body">
                    <?= Nav::widget([
                    'items' => [
                        [
                            'label' => 'Cuenta',
                            'url' => ['usuarios/cuenta'],
                            'active' => $accion == 'cuenta',
                        ],
                        [
                            'label' => 'Perfil',
                            'url' => ['usuarios/perfil'],
                            'active' => $accion == 'perfil',
                        ],
                    ],
                    'options' => ['class' =>'nav nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
                ]);
                ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-primary">
                <?= $this->render('_cuenta', [
                    'model' => $model,
                    ]) ?>
            </div>
        </div>
    </div>
</div>
