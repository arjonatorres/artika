<?php

use yii\helpers\Html;
use common\helpers\UtilHelper;

use kartik\markdown\Markdown;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $model common\models\Mensajes */

$this->title = UtilHelper::mostrarCorto($model->asunto, 100);
$this->params['breadcrumbs'][] = ['label' => 'Mensajes', 'url' => ['recibidos']];
$this->params['breadcrumbs'][] = $this->title;
$js = <<<JS
    $('#menu-principal-user').children('li.mensajes-dropdown').addClass('active');
JS;

$this->registerJs($js);
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
<div class="mensajes-view">
    <?= $this->render('_menu') ?>
    <div class="panel panel-default panel-principal">
        <div class="panel-heading">
            <h4><?= Html::encode($model->asunto) ?></h4>
        </div>
        <div class="panel-body">
            <?= Markdown::convert(Html::encode($model->contenido)) ?>
            <hr>
            <p class="pie">De <strong><?= Html::encode($model->remitente->nombre) ?></strong> para <strong><?= ($model->destinatario_id != null ? Html::encode($model->destinatario->nombre) : 'Todos') ?></strong></p>
            <p class="pie">Fecha envío: <strong><?= Yii::$app->formatter->asDatetime($model->created_at) ?></strong></p>
        </div>
    </div>
</div>
