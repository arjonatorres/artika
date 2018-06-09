<?php

use yii\helpers\Html;

use common\helpers\UtilHelper;

use kartik\daterange\DateRangePicker;
use yii\bootstrap\ActiveForm;

$js = <<<JS
    $(document).ready(function() {
        if ($('#created_at').val() == '') {
            $('#created_at').val($('.text-muted').html());
        }
    });

    $('#logs-form').submit(function() {
        window.location = $(this).attr('action') + '/' + $('#created_at').val().replace(/ /g, '+');
        return false;
    });
JS;

$this->registerJs($js);
?>

<div class="logs-search col-md-10">

    <?php $form = ActiveForm::begin([
        'id' => 'logs-form',
        'action' => ['/logs'],
        'method' => 'get',
    ]); ?>

<?= $form->field($model, 'created_at')
    ->widget(DateRangePicker::classname(), [
        'presetDropdown' => true,
        'convertFormat' => true,
        'pluginOptions' => [
            'showDropdowns' => true,
            'alwaysShowCalendars' => true,
            'locale' => [
                'format' => 'd-m-Y',
                'separator' => ' a ',
            ],
        ],
    ])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(
            UtilHelper::glyphicon('search') . ' Buscar',
            ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
