<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use common\models\Pines;
use common\models\Modulos;

use common\helpers\UtilHelper;
use kartik\depdrop\DepDrop;

use kartik\select2\Select2;

$habitaciones = UtilHelper::getDropDownList($habitaciones);
$model->icono_id = $model->icono_id ?: 1;

$tipos_modulos = UtilHelper::getDropDownList($tipos_modulos);

$accion = Yii::$app->controller->action->id;
$esMod = $accion === 'modificar-modulo';

$urlCrearModuloAjax = Url::to(['modulos/create-ajax']);
$urlModificarModuloAjax = Url::to(['modulos/modificar-modulo-ajax']);
$urlModulos = Url::to(['modulos/create']);
$data = [];
$data2 = [];

$js = <<<JS
$('[data-toggle="tooltip"]').tooltip({
        placement : 'right'
    });

$('.lista-iconos').on('click', function () {
    var id = $(this).data('id');
    $('#icono').attr('src', $(this).attr('src'));
    $('#modulos-icono_id').val(id);
    $('#modal').modal('hide');
});

var max = $('#modulos-nombre').attr('maxlength');
$('#modulos-nombre').after($('<span id="quedanHab" class="label"></span>'));
mostrarNumero();
$('#modulos-nombre').on('input', function() {
    mostrarNumero();
});

function mostrarNumero() {
    var lon = max - $('#modulos-nombre').val().length;
    var numero = $('#quedanHab');
    numero.text(lon);
    if (lon > 16) {
        numero.removeClass('label-success');
        numero.addClass('label-danger');
    } else if (lon <=5) {
        numero.removeClass('label-success');
        numero.addClass('label-warning');
    } else {
        numero.removeClass('label-danger');
        numero.removeClass('label-warning');
        numero.addClass('label-success');
    }
}

function volverCrearModulo() {
    $.ajax({
        url: '$urlModulos',
        type: 'GET',
        data: {},
        success: function (data) {
            $('#modulo').html(data);
        }
    });
}

$('#cancelar-button').on('click', function () {
    volverCrearModulo();
});

JS;

if ($esMod) {
    $js .= <<<JS
    $('#modulo-form').on('beforeSubmit', function () {
        var nombreModulo = $('#modulo-form').yiiActiveForm('find', 'modulos-nombre').value;
        var idHabitacion = $('#modulo-form').yiiActiveForm('find', 'modulos-habitacion_id').value;
        var idTipo = $('#modulo-form').yiiActiveForm('find', 'modulos-tipo_modulo_id').value;
        var idIcono = $('#modulo-form').yiiActiveForm('find', 'modulos-icono_id').value;
        var idPin1 = $('#modulo-form').yiiActiveForm('find', 'modulos-pin1_id').value;
        var datos = {
            'Modulos[nombre]': nombreModulo,
            'Modulos[habitacion_id]': idHabitacion,
            'Modulos[tipo_modulo_id]': idTipo,
            'Modulos[icono_id]': idIcono,
            'Modulos[pin1_id]': idPin1
        };
        if (idTipo == 2) {
            datos['Modulos[pin2_id]'] = $('#modulo-form').yiiActiveForm('find', 'modulos-pin2_id').value;
        }
        $.ajax({
            url: '$urlModificarModuloAjax' + '?id=$model->id',
            type: 'POST',
            data: datos,
            success: function (data) {
                if (data) {
                    var nombre = $('#it-modulo-nombre$model->id');
                    var icono = $('#it-modulo-icono$model->id');
                    var habitacionNueva = $('#p' + idHabitacion);
                    var elem = nombre.closest('.icono-nombre');
                    elem.fadeOut(400, function() {
                        nombre.text(' ' + nombreModulo);
                        icono.attr('src', '/imagenes/iconos/modulos/' + idIcono + '.png');
                    }).fadeIn(400);
                }
                volverCrearSeccion();
            }
        });
        return false;
    });
JS;
} else {
    $js .= <<<JS
    $('#modulo-form').on('beforeSubmit', function () {
        var idHabitacion = $('#modulo-form').yiiActiveForm('find', 'modulos-habitacion_id').value;
        var idTipo = $('#modulo-form').yiiActiveForm('find', 'modulos-tipo_modulo_id').value;
        var datos = {
            'Modulos[nombre]': $('#modulo-form').yiiActiveForm('find', 'modulos-nombre').value,
            'Modulos[habitacion_id]': idHabitacion,
            'Modulos[tipo_modulo_id]': idTipo,
            'Modulos[icono_id]': $('#modulo-form').yiiActiveForm('find', 'modulos-icono_id').value,
            'Modulos[pin1_id]': $('#modulo-form').yiiActiveForm('find', 'modulos-pin1_id').value
        };
        if (idTipo == 2) {
            datos['Modulos[pin2_id]'] = $('#modulo-form').yiiActiveForm('find', 'modulos-pin2_id').value;
        }

        $.ajax({
            url: '$urlCrearModuloAjax',
            type: 'POST',
            data: datos,
            success: function (data) {
                if (data) {
                    var elem = $('#p' + idHabitacion);
                    if (elem.find('.collapsed').length == 1) {
                        elem.find('a[data-toggle="collapse"]').trigger('click');
                    }
                    it = $('#p' + idHabitacion + '-collapse' + idHabitacion).find('.list-group');
                    it.append(data);
                    it = it.find('.list-group-item').last();
                    it.hide();
                    it.css({opacity: 0.0})
                    it.slideDown(400).animate({opacity: 1.0}, 400);
                    funcionalidadBotones();
                    volverCrearSeccion();
                }
            }
        });
        return false;
    });
JS;
}
$this->registerJs($js);
;
$a = array_filter(scandir('imagenes/iconos/modulos/'), function ($var) {
    return preg_match('/^\d+\.png$/', $var);
});
$b = array_map(function ($var) {
    return explode('.', $var, -1);
}, $a);
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'modulo-form',
        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]);
    ?>
    <div class="col-md-5">
        <?= $form->field($model, 'icono_id', [
            'template' => "{label}\n",
            'options' => [],
            ])->hiddenInput() ?>
        <div class="text-center">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-icono">
                    <?php Modal::begin([
                        'id' => 'modal',
                        'header' => 'Cambiar icono',
                        'toggleButton' => [
                            'label' => Html::img("/imagenes/iconos/modulos/$model->icono_id.png", [
                                'id' => 'icono',
                            ]),
                            'class' => 'img-thumbnail btn btn-default',
                            'title' => 'Pulse para cambiar el icono',
                        ],
                    ]);
                    ?>
                    <div class="text-center">
                        <?php foreach($b as $img): ?>
                            <?= Html::img("/imagenes/iconos/modulos/{$img[0]}.png", [
                                'class' => 'lista-iconos',
                                'data-id' => $img[0],
                                ]) ?>
                        <?php endforeach ?>
                    </div>
                    <?php Modal::end() ?>
                    <?= $form->field($model, 'icono_id', [
                        'template' => "{input}"
                        ])->hiddenInput() ?>
                </div>
            </div>
        </div>
        <?= $form->field($model, 'icono_id', [
            'template' => "{hint}\n{error}"
            ])->hiddenInput() ?>
    </div>

    <div class="col-md-7">
        <?php if ($esMod): ?>
        <h4><span class="label label-info">
            Módulo: <?= Html::encode($model->nombre) ?>
        </span></h4>
        <?php endif ?>
        <div class="col-md-10 col-md-offset-1" style="padding-left: 0px;">
            <?= $form->field($model, 'nombre', [
                ])->textInput([
                    'maxlength' => 20,
                    'style'=>'width: 80%; display: inline; margin-right: 10px;',
                    ])->label('Nombre del módulo', [
                        'style' => 'display: block',
                        ]) ?>

            <?= $form->field($model, 'habitacion_id')->widget(Select2::classname(), [
                'data' => $habitaciones,
                'options' => [
                    'placeholder' => 'Selecciona una habitación',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?= $form->field($model, 'tipo_modulo_id')->widget(Select2::classname(), [
                'id' => 'modulos-tipo_modulo_id',
                'data' => $tipos_modulos,
                'options' => [
                    'placeholder' => 'Selecciona un tipo',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>
            <?php
                if ($esMod) {
                    $pines_id = Modulos::pinesLibres($model->tipoModulo->tipoPin->id);
                    $out = Pines::find()->select(['id', 'nombre'])
                        ->where(['in', 'id', $pines_id])->asArray()->all();
                    array_unshift($out, ['id' => $model->pin1_id, 'nombre' => $model->pin1->nombre]);
                    $data = UtilHelper::getDropDownList($out);
                    if ($model->pin2_id !== null) {
                        array_shift($out);
                        array_unshift($out, ['id' => $model->pin2_id, 'nombre' => $model->pin2->nombre]);
                        $data2 = UtilHelper::getDropDownList($out);
                    }
                }
            ?>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h3 style="margin-top: 10px">
                        <a href="https://www.arduino.cc/" target="_blank">
                            <img src="imagenes/arduino_logo.png" title="Arduino logo" width="80px">
                        </a>
                    </h3>
                    <hr>
                    <?= $form->field($model, 'pin1_id')->widget(DepDrop::classname(), [
                        'options'=>['id'=>'pin1-id'],
                        'data'=> $data,
                        'pluginOptions'=>[
                            'loadingText' => '',
                            'depends' => ['modulos-tipo_modulo_id'],
                            'placeholder' => 'Selecciona un pin...',
                            'url' => Url::to(['pin-principal']),
                            'params' => ['mod1'],
                        ]
                        ])->label('Pin principal '
                            . '<a href="#" data-toggle="tooltip" title="Cuando el tipo de módulo es de persiana, éste pin principal corresponde al de subida">'
                            . UtilHelper::glyphicon('info-sign')
                            . '</a>') ?>

                        <?= $form->field($model, 'pin2_id')->widget(DepDrop::classname(), [
                            'options'=>['id'=>'pin2-id'],
                            'data'=> $data2,
                            'pluginOptions'=>[
                                'loadingText' => '',
                                'depends' => ['pin1-id'],
                                'placeholder' => 'Selecciona un pin...',
                                'url' => Url::to(['pin-secundario']),
                                'params' => ['modulos-tipo_modulo_id', 'mod2'],
                            ]
                            ])->label('Pin secundario '
                                . '<a href="#" data-toggle="tooltip" title="Cuando el tipo de módulo es de persiana, éste pin secundario corresponde al de bajada">'
                                . UtilHelper::glyphicon('info-sign')
                                . '</a>') ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($esMod ? 'Modificar' : 'Añadir', [
                    'class' => 'btn btn-success',
                    'id' => 'guardar-button'
                ]) ?>
                <?php if ($esMod): ?>
                    <?= Html::button('Cancelar', [
                        'class' => 'btn btn-danger',
                        'id' => 'cancelar-button',
                    ]) ?>
                    <?= Html::hiddenInput('mod1', $model->pin1_id, ['id'=>'mod1']) ?>
                    <?= Html::hiddenInput('mod2', $model->pin2_id, ['id'=>'mod2']) ?>
                <?php endif ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
