<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use common\helpers\UtilHelper;

$habitaciones = UtilHelper::getDropDownList($habitaciones);
$model->icono_id = $model->icono_id ?: 1;

$tipos_modulos = UtilHelper::getDropDownList($tipos_modulos);
$model->tipo_modulo_id = $model->tipo_modulo_id ?: 1;

$accion = Yii::$app->controller->action->id;
$esMod = $accion === 'modificar-modulo';

$urlCrearModuloAjax = Url::to(['modulos/create-ajax']);
$urlModificarModuloAjax = Url::to(['modulos/modificar-modulo-ajax']);
$urlModulos = Url::to(['modulos/create']);

$js = <<<EOL

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

EOL;

if ($esMod) {
    $js .= <<<EOL
    $('#modulo-form').on('beforeSubmit', function () {
        var nombreModulo = $('#modulo-form').yiiActiveForm('find', 'modulos-nombre').value;
        var idHabitacion = $('#modulo-form').yiiActiveForm('find', 'modulos-habitacion_id').value;
        var idTipo = $('#modulo-form').yiiActiveForm('find', 'modulos-tipo_modulo_id').value;
        var idIcono = $('#modulo-form').yiiActiveForm('find', 'modulos-icono_id').value;
        $.ajax({
            url: '$urlModificarModuloAjax' + '?id=$model->id',
            type: 'POST',
            data: {
                'Modulos[nombre]': nombreModulo,
                'Modulos[habitacion_id]': idHabitacion,
                'Modulos[tipo_modulo_id]': idTipo,
                'Modulos[icono_id]': idIcono,
            },
            success: function (data) {
                if (data) {
                    console.log(data);
                    var nombre = $('#it-modulo-nombre$model->id');
                    var icono = $('#it-modulo-icono$model->id');
                    var habitacionNueva = $('#p' + idHabitacion);
                    var elem = nombre.closest('.icono-nombre');
                    elem.fadeOut(400, function() {
                        nombre.text(' ' + nombreModulo);
                        icono.attr('src', '/imagenes/iconos/modulos/' + idIcono + '.png');
                        // $('#menu-casa-usuario').append(elem);
                        habitacionNueva.append(elem);
                    }).fadeIn(400);
                }
                volverCrearSeccion();
            }
        });
        return false;
    });
EOL;
} else {
    $js .= <<<EOL
    $('#modulo-form').on('beforeSubmit', function () {
        var idHabitacion = $('#modulo-form').yiiActiveForm('find', 'modulos-habitacion_id').value;
        var idTipo = $('#modulo-form').yiiActiveForm('find', 'modulos-tipo_modulo_id').value;
        $.ajax({
            url: '$urlCrearModuloAjax',
            type: 'POST',
            data: {
                'Modulos[nombre]': $('#modulo-form').yiiActiveForm('find', 'modulos-nombre').value,
                'Modulos[habitacion_id]': idHabitacion,
                'Modulos[tipo_modulo_id]': idTipo,
                'Modulos[icono_id]': $('#modulo-form').yiiActiveForm('find', 'modulos-icono_id').value,
            },
            success: function (data) {
                if (data) {
                    console.log(data);
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
                    var padre = $('#modulos-nombre');
                    padre.val('');
                    padre.parent().removeClass('has-success');
                    mostrarNumero();
                    funcionalidadBotones();
                }
            }
        });
        return false;
    });
EOL;
}
$this->registerJs($js);

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

            <?= $form->field($model, 'habitacion_id')->dropDownList($habitaciones, [
                'style'=>'width: 80%; margin-right: 10px;',
            ]) ?>
            <?= $form->field($model, 'tipo_modulo_id')->dropDownList($tipos_modulos, [
                'style'=>'width: 80%; margin-right: 10px;',
            ]) ?>
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
                <?php endif ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
