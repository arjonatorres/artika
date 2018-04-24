<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Servidores */

$js = <<<JS
    $('#servidores-url').on('click', function() {
        if ($(this).val() == '') {
            $(this).val('http://');
        }
    });
JS;

$this->registerJs($js);

$this->params['breadcrumbs'][] = 'Servidor';
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('hdd', ['class' => 'icon-sm']) ?>
             Servidor
         </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="/imagenes/raspberry-logo.png" alt="" style="padding: 10px 0px 20px 0px">
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-7">
                    <?= $form->field($model, 'url', [
                        'options' => [
                            'style' => 'width: 100%',

                        ],
                    ])->textInput(['maxlength' => true, 'placeholder' => 'http://',]) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'puerto', [
                        'options' => [
                            'style' => 'width: 100%'
                        ],
                    ])->textInput() ?>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group col-md-7">
                    <?= Html::submitButton('Guardar', [
                        'class' => 'btn btn-success',
                        'style' => 'margin-top: 10px;',
                    ]) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <hr>
        <div class="col-md-12 text-center">
            <img src="/imagenes/arduino_slogan.png" alt="" style="padding: 10px 0px 20px 0px">
        </div>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6 text-center">
                <img src="/imagenes/arduino.png" alt="" style="padding: 10px 0px 20px 0px">
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</div>
