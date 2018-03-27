<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile('/css/posts.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">
    <div class="col-md-8">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_post',
            'summary' => '',
            'viewParams' => [
                'searchModel' => $searchModel,
                'view' => false,
            ],
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_lateral', [
            'searchModel' => $searchModel,
            'dataProviderLimit' => $dataProviderLimit,
        ]) ?>
    </div>
</div>
