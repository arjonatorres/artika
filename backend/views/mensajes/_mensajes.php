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
$js = <<<JS
    $('#menu-principal-user').children('li.mensajes-dropdown').addClass('active');
JS;

$this->registerJs($js);
global $rec;
$rec = $recibidos;

$columns = [
    [
        'headerOptions' => ['style' => 'width: 12%'],
        'label' => $rec ? 'Remitente': 'Destinatario',
        'attribute' => $rec ? 'remitente.nombre': 'destinatario.nombre',
        'format' => 'raw',
        'value' => function ($mensaje) {
            $rec = $GLOBALS['rec'];
            if ($rec) {
                $nombre = Html::encode($mensaje->remitente->nombre);
            } else {
                if ($mensaje->destinatario_id == null) {
                    $nombre = 'Todos';
                } else {
                    $nombre = Html::encode($mensaje->destinatario->nombre);
                }
            }
            if ($rec) {
                if ($mensaje->estado_dest == Mensajes::ESTADO_NO_LEIDO) {
                    $nombre = '<strong>' . $nombre . '</strong>';
                }
            }
            if ($nombre == 'anónimo') {
                return $nombre;
            }
            if ($mensaje->destinatario_id == null) {
                return $nombre;
            }
            return Html::a(
                $nombre,
                [
                    'create',
                    'id' => $rec ?
                        $mensaje->remitente->id :
                        ($mensaje->destinatario_id != null ? $mensaje->destinatario->id: 0)
                ]
            );
        },
    ],
    [
        'headerOptions' => ['style' => 'width: 25%'],
        'label' => 'Fecha',
        'attribute' => 'created_at',
        'format' => 'html',
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
            $rec = $GLOBALS['rec'];
            $fecha = Yii::$app->formatter->asDatetime($mensaje->created_at);
            if ($rec) {
                if ($mensaje->estado_dest == Mensajes::ESTADO_NO_LEIDO) {
                    $fecha = '<strong>' . $fecha . '</strong>';
                }
            }
            return $fecha;
        },
    ],
    [
        'attribute' => 'asunto',
        'format' => 'raw',
        'value' => function ($mensaje) {
            $rec = $GLOBALS['rec'];
            $asunto = Html::encode($mensaje->asunto);
            if ($rec) {
                if ($mensaje->estado_dest == Mensajes::ESTADO_NO_LEIDO) {
                    $asunto = '<strong>' . $asunto . '</strong>';
                }
            }
            return Html::a(
                $asunto,
                [
                    'view',
                    'id' => $mensaje->id,
                    // 'enviados' => !$rec,
                ]
            );
        },
    ],
];
if ($rec) {
    $columns [] = [
        'headerOptions' => ['style' => 'width: 12%'],
        'label' => 'Estado',
        'attribute' => 'estado_dest',
        'format' => 'raw',
        'filter' => [
            '0' => 'No leídos',
            '1' => 'Leídos',
        ],
        'value' => function ($data) {
            $div = '<div class="text-center">';
            switch ($data->estado_dest) {
                case Mensajes::ESTADO_NO_LEIDO:
                return $div . UtilHelper::glyphicon('envelope', ['title' => 'No leído']) . '</div>';
                break;
                case Mensajes::ESTADO_LEIDO:
                return $div . UtilHelper::glyphicon('ok', ['title' => 'Leído']) . '</div>';
                break;
            }
        },
    ];
}
$columns[] = [
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
];
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

    <?= $this->render('_menu') ?>

    <div class="panel panel-principal">
        <div class="panel-body  panel-body-gris borde_sup_red">
            <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
            ]) ?>
            </div>
        </div>
    </div>
</div>
