<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->registerCssFile('/css/posts.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$this->title = 'Crear post';
$this->params['breadcrumbs'][] = [
    'label' => 'Blog',
    'url' => ['index'],
];;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-create">
    <div class="col-md-8">
        <div class="panel panel-primary borde-redondo">
            <div class="panel-body panel-body-gris borde-redondo">
                <div class="text-center">
                    <h3 class="post"><span class="label label-success">Nuevo Post</span></h3>
                </div>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <?= $this->render('_lateral', [
            'searchModel' => $searchModel,
            'dataProviderLimit' => $dataProviderLimit,
        ]) ?>
    </div>
</div>
