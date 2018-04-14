<?php

use yii\helpers\Html;

use common\helpers\UtilHelper;

use kartik\daterange\DateRangePicker;
use yii\bootstrap\ActiveForm;

$js = <<<JS
    $(document).ready(function() {
        if ($('#logssearch-created_at').val() == '') {
            $('#logssearch-created_at').val($('.text-muted').html());
        }
    });
JS;

$this->registerJs($js);
?>

<div class="logs-search col-md-10">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
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
