<?php

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->registerCssFile('/css/posts.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$this->title = 'Modificar post';
$this->params['breadcrumbs'][] = [
    'label' => 'Blog',
    'url' => ['index'],
];;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-create">
    <div class="col-md-12">
        <div class="panel panel-primary borde-redondo">
            <div class="panel-body panel-body-gris borde-redondo">
                <div class="text-center">
                    <h3 class="post"><span class="label label-success">Modificar Post</span></h3>
                </div>
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>
