<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\widgets\ListView;

$accion = Yii::$app->controller->action->id;
$this->params['breadcrumbs'][] = $accion !== 'mi-casa' ? [
    'label' => 'Mi casa',
    'url' => ['mi-casa'],
]: 'Mi casa';

$this->registerCssFile('/css/casa.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

?>
<div class="conf-cuenta">
    <div class="row">
        <div id="menu-casa-usuario" class="col-md-3 col-sm-12 col-xs-12" >
            <?= $this->render("_menu-casa", [
                'secciones' => $secciones,
                ]) ?>
        </div>
        <div id="casa-usuario" class="col-md-9 col-sm-12 col-xs-12">
            <?php if ($accion === 'mi-casa'): ?>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => "_$accion",
                    'summary' => '',
                ]); ?>
            <?php else: ?>
            <?= $this->render("_$accion", [
                'model' => $model,
                'modelHab' => isset($modelHab) ? $modelHab: '',
                'secciones' => $secciones,
            ]) ?>
        <?php endif ?>
        </div>
    </div>
</div>
