<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$title = 'Mi casa';
$this->params['breadcrumbs'][] = $title;

$this->registerCssFile('/css/casa.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div id="menu-casa-usuario" class="col-md-3">
            <?= $this->render("_menu-casa", [
                'model' => $model,
                'secciones' => $secciones,
                ]) ?>
        </div>
        <div class="col-md-9">
            <?= $this->render("_$accion", [
                'model' => $model,
                ]) ?>
        </div>
    </div>
</div>
