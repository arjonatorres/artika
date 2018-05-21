<?php
use yii\web\View;

use yii\grid\GridView;

use yii\helpers\Html;

use common\models\Usuarios;

use common\helpers\UtilHelper;

use kartik\date\DatePicker;

/* @var $this yii\web\View */
$js = <<<JS
    $('.grid-view img').each(function() {
        if ($(this).closest('tr').data('key') != 1) {
            $(this).elevateZoom({zoomWindowPosition: 2, zoomWindowWidth: 308, zoomWindowHeight: 308});
        } else {
            $(this).elevateZoom({zoomWindowPosition: 2, zoomWindowWidth: 168, zoomWindowHeight: 168});

        }
    });
JS;
$this->registerJs($js);
$this->registerJsFile('@web/js/elevatezoom-master/jquery.elevatezoom.js',[
    'depends' => [\yii\web\JqueryAsset::className()]
]);
$this->params['breadcrumbs'][] = 'Usuarios';
?>

<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('user', ['class' => 'icon-sm']) ?>
            Usuarios
        </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'label' => 'Foto',
                        'content' => function ($model, $key, $index, $column) {
                            // return $index;
                            $usuario = Usuarios::findOne($key);
                            $img = Html::img($usuario->perfil->rutaImagen, [
                                'class' => 'img-circle img-user',
                            ]);
                            return $img;
                        },
                    ],
                    'username',
                    'email',
                    [
                        'attribute' => 'created_at',
                        'value' => 'created_at',
                        'filter' => DatePicker::widget([
                            'model'=>$searchModel,
                            'attribute' => 'created_at',
                            'layout' => '{remove}{input}',
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'autoclose' => true,
                            ],
                        ]),
                        'format' => 'datetime',
                    ],
                ],
            ]); ?>
            </div>
        </div>
    </div>
</div>