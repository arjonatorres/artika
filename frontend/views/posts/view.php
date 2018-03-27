<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->registerCssFile('/css/posts.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$this->title = UtilHelper::mostrarCorto($model->titulo, 100);
$this->params['breadcrumbs'][] = [
    'label' => 'Blog',
    'url' => ['index'],
];;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">
    <div class="col-md-8">
        <?=$this->render('_post', [
            'model' => $model,
            'searchModel' => $searchModel,
            'view' => true,
        ]); ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_lateral', [
            'searchModel' => $searchModel,
            'dataProviderLimit' => $dataProviderLimit,
        ]) ?>
    </div>
</div>
