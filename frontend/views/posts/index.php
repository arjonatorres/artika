<?php

use yii\helpers\Html;
use yii\widgets\ListView;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile('/css/posts.css', [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
]);

$this->title = 'Posts';
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
            ],
        ]) ?>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default borde-redondo">
            <div class="panel-body panel-body-gris borde-redondo">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <?= Html::a(
                            UtilHelper::glyphicon('pushpin') . ' Nuevo Post',
                            ['create'],
                            [
                                'class' => 'btn btn-success',
                                'title' => 'Crear nuevo post',
                            ])
                        ?>
                    </div>
                </div>
                <hr class="margin-10">
                <div class="">
                    <?=$this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-default borde-redondo">
            <div class="panel-body panel-body-gris borde-redondo">
                <div class="">
                    <strong>ENTRADAS RECIENTES</strong>
                    <?= ListView::widget([
                        'dataProvider' => $dataProviderLimit,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => '_ultimas',
                        'summary' => '',
                    ]) ?>
                </div>
            </div>
        </div>
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
