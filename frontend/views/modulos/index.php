<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->params['breadcrumbs'][] = [
    'label' => 'Mi casa',
    'url' => ['casas/mi-casa'],
];

$this->registerCssFile('/css/casa.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div id="menu-modulo" class="col-md-3">
            <?= $this->render("_menu-modulos", [
                'habitaciones' => $habitaciones,
                ]) ?>
        </div>
        <div id="modulo" class="col-md-9">
            <?= $this->render("_$accion", [
                'model' => $model,
                'habitaciones' => $habitaciones,
                'tipos_modulos' => $tipos_modulos,
                ]) ?>
        </div>
    </div>
</div>
