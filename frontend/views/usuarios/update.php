<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;

$title = 'Configuración';
$this->params['breadcrumbs'][] = $title;

$js = <<<JS
    $('#menu-principal-user').children('li.user-dropdown').addClass('active');
JS;

$this->registerJs($js);

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary panel-principal">
                <div class="panel-heading panel-heading-principal">
                    <h3 class="panel-title"><?= Html::encode(Yii::$app->user->identity->username) ?></h3>
                </div>
                <div class="panel-body panel-body-gris">
                    <?= Nav::widget([
                    'items' => [
                        [
                            'label' => 'Perfil',
                            'url' => ['usuarios/mod-perfil'],
                            'active' => $accion == 'mod-perfil',
                        ],
                        [
                            'label' => 'Cuenta',
                            'url' => ['usuarios/mod-cuenta'],
                            'active' => $accion == 'mod-cuenta',
                        ],
                        [
                            'label' => 'Avatar',
                            'url' => ['usuarios/mod-avatar'],
                            'active' => $accion == 'mod-avatar',
                        ],
                        [
                            'label' => 'Cambiar contraseña',
                            'url' => ['usuarios/mod-password'],
                            'active' => $accion == 'mod-password',
                        ],
                    ],
                    'options' => ['class' =>'nav nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
                ]);
                ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?= $this->render("_$accion", [
                'model' => $model,
                'listaGeneros' => isset($listaGeneros) ? $listaGeneros : '',
                ]) ?>
        </div>
    </div>
</div>
