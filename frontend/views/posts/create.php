<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->registerCssFile('/css/posts.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$this->title = 'Crear';
$this->params['breadcrumbs'][] = [
    'label' => 'Posts',
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
        <div class="panel panel-default borde-redondo">
            <div class="panel-body panel-body-gris borde-redondo">
                    <strong>PARA PODER COMENTAR</strong>
                    <hr class="margin-10">
                <div class="col-md-10 col-md-offset-1">
                    <?= Html::a(
                        Html::img('/imagenes/disqus.png', [
                            'width' => '100%',
                        ]), 'https://disqus.com/', [
                            'title' => 'https://disqus.com/'
                        ]
                        )
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
