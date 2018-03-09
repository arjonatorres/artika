<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;

$this->title = 'Configuración';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<EOT
    var desplegable = $('#menu-principal').children('li').last();
    desplegable.addClass('active');
    desplegable. find('li:contains("Configuración")').addClass('active');
EOT;

$this->registerJs($js);

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode(Yii::$app->user->identity->username) ?></h3>
                </div>
                <div class="panel-body">
                    <?= Nav::widget([
                    'items' => [
                        [
                            'label' => 'Cuenta',
                            'url' => ['usuarios/mod-cuenta'],
                            'active' => $accion == 'mod-cuenta',
                        ],
                        [
                            'label' => 'Perfil',
                            'url' => ['usuarios/mod-perfil'],
                            'active' => $accion == 'mod-perfil',
                        ],
                        [
                            'label' => 'Avatar',
                            'url' => ['usuarios/mod-avatar'],
                            'active' => $accion == 'mod-avatar',
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
