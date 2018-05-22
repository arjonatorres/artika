<?php
use yii\grid\GridView;

use yii\helpers\Html;

use common\models\Usuarios;

use common\helpers\UtilHelper;

use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
$js = <<<JS
    $('.grid-view img').each(function() {
        if ($(this).attr('src').match(/\/0.png$/)) {
            $(this).elevateZoom({zoomWindowPosition: 2, zoomWindowWidth: 168, zoomWindowHeight: 168});
        } else {
            $(this).elevateZoom({zoomWindowPosition: 2, zoomWindowWidth: 308, zoomWindowHeight: 308});

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
                            $img = Html::img((YII_ENV_PROD ? '/backend': '') . $usuario->perfil->rutaImagen, [
                                'class' => 'img-circle img-user',
                            ]);
                            return $img;
                        },
                    ],
                    [
                        'attribute' => 'username',
                        'content' => function ($model, $key, $index, $column) {
                            return Html::a($model->username, ['/usuarios/update?id=' . $key]);
                        },
                    ],
                    'email',
                    [
                        'attribute' => 'created_at',
                        'value' => 'created_at',
                        'filter' => DateControl::widget([
                            'model'=>$searchModel,
                            'attribute' => 'created_at',
                            'type'=>DateControl::FORMAT_DATE,
                            'ajaxConversion'=>false,
                            'widgetOptions' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]),
                        'format' => 'datetime',
                    ],
                ],
            ]); ?>
            </div>
        </div>
    </div>
</div>
