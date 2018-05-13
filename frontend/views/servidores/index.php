<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Servidores */

$js = <<<JS
    $('[data-toggle="tooltip"]').tooltip({
            placement : 'top'
        });

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
    <div class="panel-body panel-body-gris padding-bottom-sm">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="/imagenes/raspberry-logo.png" alt=""
                    class="img-servidor">
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
            <img src="/imagenes/arduino_slogan.png" alt="" class="img-servidor">
        </div>
        <div class="row lista-pines">
            <div class="col-md-4 text-center">
                <h3><span class="label label-primary">Pines Analógicos<span></h3>
                <?php foreach ($pines->where(['tipo_pin_id' => 2])->all() as $pin): ?>
                    <div class="col-md-5 col-xs-5 text-right">
                        <h4><span class="label label-default"><?= $pin['nombre'] ?></span></h4>
                    </div>
                    <div class="col-md-7 col-xs-7 text-left">
                        <?php $modulo = array_filter($modulos, function($k) use($pin) {
                            return $k['pin1_id'] == $pin['id'];
                        });
                        $modulo = array_pop($modulo)?>
                        <?php if (!empty($modulo)): ?>
                            <h4><span class="label label-success"><?= $modulo['nombre'] ?></span></h4><a href="#" data-toggle="tooltip" title="Habitación: <?= $habitaciones[$modulo['habitacion_id']] ?>">
                                <?= UtilHelper::glyphicon('info-sign') ?>
                            </a>

                        <?php else: ?>
                            <h4><span class="label label-danger">No asignado</span></h4>
                        <?php endif ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-4 text-center">
                <img src="/imagenes/arduino.png" alt="" style="padding: 40px 0px 20px 0px">
            </div>
            <div class="col-md-4 text-center">
                <h3><span class="label label-primary">Pines Digitales<span></h3>
                <?php foreach ($pines->where(['tipo_pin_id' => 1])->orderBy('id DESC')->all() as $pin): ?>
                    <?php $modulo = array_filter($modulos, function($k) use($pin) {
                        return $k['pin1_id'] == $pin['id'] || $k['pin2_id'] == $pin['id'];
                    });
                    $modulo = array_pop($modulo);

                    $persiana = $modulo['tipo_modulo_id'] == 2;
                    $flecha = '';
                    if ($persiana) {
                        if ($modulo['pin1_id'] == $pin['id']) {
                            $flecha = 'arrow-up';
                        } else {
                            $flecha = 'arrow-down';
                        }
                    }?>
                    <div class="col-md-5 col-xs-5 text-right">
                        <h4><span class="label label-default"><?= $pin['nombre'] ?></span></h4>
                    </div>
                    <div class="col-md-7 col-xs-7 text-left">

                    <?php if (!empty($modulo)): ?>
                        <h4><span class="label label-success"><?= $modulo['nombre']
                            . ($persiana ? ' ' . UtilHelper::glyphicon($flecha) : '') ?></span></h4>
                        <a href="#" data-toggle="tooltip" title="Habitación: <?= $habitaciones[$modulo['habitacion_id']] ?>">
                            <?= UtilHelper::glyphicon('info-sign') ?>
                        </a>
                    <?php else: ?>
                        <h4><span class="label label-danger">No asignado</span></h4>
                    <?php endif ?>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
