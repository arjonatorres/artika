<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\CamarasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videocámaras';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/css/casa.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);
?>

<div class="camaras">
    <div class="row">
        <div id="menu-camara" class="col-md-3 col-sm-12 col-xs-12" >
            <?= $this->render("_menu-camara", [
                'camaras' => $camaras,
                ]) ?>
        </div>
        <div id="vista-camara" class="col-md-9 col-sm-12 col-xs-12">
            <?php if (!empty($camaras)): ?>
                <?= $this->render("_view", [
                    'model' => $camaras[0],
                ]) ?>
            <?php else: ?>
                <?= $this->render("_crear-camara", [
                    'model' => $model,
                ]) ?>
            <?php endif ?>
        </div>
    </div>
</div>
