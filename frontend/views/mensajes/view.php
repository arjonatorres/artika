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
$js = <<<EOT
    $('#menu-principal-user').children('li.mensajes-dropdown').addClass('active');
EOT;

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
    <p>
        <?= Html::a(
            UtilHelper::glyphicon('plus') . ' Mensaje nuevo',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <hr>
    <div class="panel panel-default panel-principal">
        <div class="panel-heading">
            <h4><?= Html::encode($model->asunto) ?></h4>
        </div>
        <div class="panel-body">
            <?= Markdown::convert(Html::encode($model->contenido)) ?>
            <hr>
            <p class="pie">De <strong><?= Html::encode($model->remitente->nombre) ?></strong> para <strong><?= Html::encode($model->destinatario->nombre) ?></p>
            <p class="pie">Fecha envío: <strong><?= Yii::$app->formatter->asDatetime($model->created_at) ?></strong></p>
        </div>
    </div>
    <hr>
    <p>
        <?= Html::a(
            UtilHelper::glyphicon('arrow-left') . ' Mensajes recibidos',
            ['recibidos'],
            ['class' => 'btn btn-primary']
        ) ?>
    </p>
</div>