<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = [
    'label' => 'Mi casa',
    'url' => ['mi-casa'],
];

$this->registerCssFile('/css/casa.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div id="menu-casa-usuario" class="col-md-3" >
            <?= $this->render("_menu-casa", [
                'secciones' => $secciones,
                ]) ?>
        </div>
        <div id="casa-usuario" class="col-md-9">
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
