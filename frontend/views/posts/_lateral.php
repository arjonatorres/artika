<?php
use yii\helpers\Html;

use yii\widgets\ListView;
use yii\widgets\ActiveForm;

use common\helpers\UtilHelper;
?>

<div class="panel panel-default borde-redondo">
    <div class="panel-body panel-body-gris borde-redondo">
        <div class="row">
            <div class="text-center">
                <?= Html::a(
                    UtilHelper::glyphicon('pushpin') . ' Nuevo Post',
                    ['create'],
                    [
                        'class' => 'btn btn-success',
                        'title' => 'Crear nuevo post',
                    ])
                ?>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?= Html::a(
                        UtilHelper::glyphicon('search') . ' Mis Posts',
                        ['index', 'PostsSearch[usuario_id]' => Yii::$app->user->id],
                        [
                            'class' => 'btn btn-info',
                            'title' => 'Buscar mis posts',
                        ])
                    ?>
                <?php endif ?>
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
