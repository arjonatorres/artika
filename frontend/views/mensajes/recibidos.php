<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Mensajes;

use common\helpers\UtilHelper;

use kartik\dialog\Dialog;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensajes recibidos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Dialog::widget([
    'dialogDefaults' => [
        'confirm' => [
            'type' => Dialog::TYPE_DANGER,
            'title' => 'Confirmación',
            'btnOKClass' => 'btn-danger',
            'btnOKLabel' => '<span class="glyphicon glyphicon-remove"></span> ' . 'Borrar',
            'btnCancelLabel' => '<span class="' . Dialog::ICON_CANCEL . '"></span> ' . 'Cancelar'
        ],
    ],
]); ?>
<div class="mensajes-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            UtilHelper::glyphicon('plus') . ' Mensaje nuevo',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <hr>

    <div class="panel panel-principal">
        <div class="panel-body  panel-body-gris borde_sup_red">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'headerOptions' => ['style' => 'width: 12%'],
                        'label' => 'Remitente',
                        'attribute' => 'remitente.nombre',
                        // 'filter' => $remitentes,
                        'format' => 'raw',
                        'value' => function ($mensaje) {
                            $nombre = $mensaje->remitente->nombre;
                            if ($mensaje->estado == Mensajes::ESTADO_NO_LEIDO) {
                                $nombre = '<strong>' . $nombre . '</strong>';
                            }
                            if ($nombre == 'anónimo') {
                                return $nombre;
                            }
                            return Html::a(
                                $nombre,
                                ['create', 'id' => $mensaje->remitente->id]
                            );
                        },
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 25%'],
                        'label' => 'Fecha',
                        'attribute' => 'created_at',
                        'format' => 'html',
                        // 'format' => 'html',
                        'filter' => DateRangePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_at',
                            'presetDropdown' => true,
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'showDropdowns' => true,
                                'alwaysShowCalendars' => true,
                                'locale' => [
                                    'format' => 'd-m-Y',
                                    'separator' => ' a ',
                                ],
                                'opens'=> 'rigth',
                            ],
                        ]),
                        'value' => function ($mensaje) {
                            $fecha = Yii::$app->formatter->asDatetime($mensaje->created_at);
                            if ($mensaje->estado == Mensajes::ESTADO_NO_LEIDO) {
                                $fecha = '<strong>' . $fecha . '</strong>';
                            }
                            return $fecha;
                            return Html::a(
                                $nombre,
                                ['create', 'id' => $mensaje->remitente->id]
                            );
                        },
                    ],
                    [
                        'attribute' => 'asunto',
                        'format' => 'raw',
                        'value' => function ($mensaje) {
                            $contenido = $mensaje->contenido;
                            if ($mensaje->estado == Mensajes::ESTADO_NO_LEIDO) {
                                $contenido = '<strong>' . $contenido . '</strong>';
                            }
                            return Html::a(
                                $contenido,
                                ['view', 'id' => $mensaje->id]
                            );
                        },
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 12%'],
                        'label' => 'Estado',
                        'attribute' => 'estado',
                        'format' => 'raw',
                        'filter' => [
                            '0' => 'No leídos',
                            '1' => 'Leídos',
                        ],
                        'value' => function ($data) {
                            $div = '<div class="text-center">';
                            switch ($data->estado) {
                                case Mensajes::ESTADO_NO_LEIDO:
                                    return $div . UtilHelper::glyphicon('envelope', ['title' => 'No leído']) . '</div>';
                                    break;
                                case Mensajes::ESTADO_LEIDO:
                                    return $div . UtilHelper::glyphicon('ok', ['title' => 'Leído']) . '</div>';
                                    break;
                            }
                        },
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 5%'],
                        'header' => 'Borrar',
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model, $key) {
                                $div = '<div class="text-center">';
                                return $div . Html::a(UtilHelper::glyphicon('remove'),
                                    [$url], [
                                        'data-method' => 'POST',
                                        'data-confirm' => '¿Estás seguro de que quieres eliminar este mensaje?',
                                        'title' => 'Borrar mensaje',
                                    ]
                                ) . '</div>';
                            }
                        ],
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>

<?php
// [
//     '0' => UtilHelper::glyphicon('envelope'),
//     '1' => UtilHelper::glyphicon('ok'),
// ]
