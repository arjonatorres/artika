<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use common\helpers\UtilHelper;

$secciones = UtilHelper::getDropDownList($secciones);
$modelHab->icono_id = $modelHab->icono_id ?: 1;

$accion = Yii::$app->controller->action->id;
$esMod = $accion === 'modificar-habitacion';

$urlCrearHabitacionAjax = Url::to(['casas/crear-habitacion-ajax']);
$urlModificarHabitacionAjax = Url::to(['casas/modificar-habitacion-ajax']);
$urlSecciones = Url::to(['casas/crear-seccion']);

$js = <<<JS

$('.lista-iconos').on('click', function () {
    var id = $(this).data('id');
    $('#icono').attr('src', $(this).attr('src'));
    $('#habitaciones-icono_id').val(id);
    $('#modal').modal('hide');
});

var max = $('#habitaciones-nombre').attr('maxlength');
$('#habitaciones-nombre').after($('<span id="quedanHab" class="label"></span>'));
mostrarNumeroHab();
$('#habitaciones-nombre').on('input', function() {
    mostrarNumeroHab();
});

function mostrarNumeroHab() {
    var lon = max - $('#habitaciones-nombre').val().length;
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

function volverCrearSeccion() {
    $.ajax({
        url: '$urlSecciones',
        type: 'GET',
        data: {},
        success: function (data) {
            $('#casa-usuario').html(data);
        }
    });
}

$('#cancelarHab-button').on('click', function () {
    volverCrearSeccion();
});

JS;

if ($esMod) {
    $js .= <<<JS
    $('#habitacion-form').on('beforeSubmit', function () {
        var idSeccion = $('#habitacion-form').yiiActiveForm('find', 'habitaciones-seccion_id').value;
        var nombreHab = $('#habitacion-form').yiiActiveForm('find', 'habitaciones-nombre').value;
        var iconoIdHab = $('#habitacion-form').yiiActiveForm('find', 'habitaciones-icono_id').value;
        $.ajax({
            url: '$urlModificarHabitacionAjax' + '?id=$modelHab->id',
            type: 'POST',
            data: {
                'Habitaciones[nombre]': nombreHab,
                'Habitaciones[seccion_id]': idSeccion,
                'Habitaciones[icono_id]': iconoIdHab
            },
            success: function (data) {
                if (data) {
                    var nombre = $('#it-habitacion-nombre$modelHab->id');
                    var icono = $('#it-habitacion-icono$modelHab->id');
                    var seccionNueva = $('#p' + idSeccion);
                    var elem = nombre.closest('.icono-nombre');
                    elem.fadeOut(400, function() {
                        nombre.text(' ' + nombreHab);
                        icono.attr('src', '/imagenes/iconos/' + iconoIdHab + '.png');
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
    $('#habitacion-form').on('beforeSubmit', function () {
        var idSeccion = $('#habitacion-form').yiiActiveForm('find', 'habitaciones-seccion_id').value;
        $.ajax({
            url: '$urlCrearHabitacionAjax',
            type: 'POST',
            data: {
                'Habitaciones[nombre]': $('#habitacion-form').yiiActiveForm('find', 'habitaciones-nombre').value,
                'Habitaciones[seccion_id]': idSeccion,
                'Habitaciones[icono_id]': $('#habitacion-form').yiiActiveForm('find', 'habitaciones-icono_id').value,
            },
            success: function (data) {
                if (data) {
                    var elem = $('#p' + idSeccion);
                    if (elem.find('.collapsed').length == 1) {
                        elem.find('a[data-toggle="collapse"]').trigger('click');
                    }
                    it = $('#p' + idSeccion + '-collapse' + idSeccion).find('.list-group');
                    it.append(data);
                    it = it.find('.list-group-item').last();
                    it.hide();
                    it.css({opacity: 0.0})
                    it.slideDown(400).animate({opacity: 1.0}, 400);
                    var padre = $('#habitaciones-nombre');
                    padre.val('');
                    padre.parent().removeClass('has-success');
                    mostrarNumeroHab();
                    funcionalidadBotones();
                }
            }
        });
        return false;
    });
JS;
}
$this->registerJs($js);

$a = array_filter(scandir('imagenes/iconos/'), function ($var) {
    return preg_match('/^\d+\.png$/', $var);
});
$b = array_map(function ($var) {
    return explode('.', $var, -1);
}, $a);
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'habitacion-form',
        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]);
    ?>
    <div class="col-md-3">
        <?= $form->field($modelHab, 'icono_id', [
            'template' => "{label}\n",
            'options' => [],
            ]) ?>
        <div class="text-center">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-icono">
                    <?php Modal::begin([
                        'id' => 'modal',
                        'header' => 'Cambiar icono',
                        'toggleButton' => [
                            'label' => Html::img("/imagenes/iconos/$modelHab->icono_id.png", [
                                'id' => 'icono',
                            ]),
                            'class' => 'img-thumbnail btn btn-default',
                            'title' => 'Pulse para cambiar el icono',
                        ],
                        'size' => 'modal-lg',
                    ]);
                    ?>
                    <div class="text-center">
                        <?php foreach($b as $img): ?>
                            <?= Html::img("/imagenes/iconos/{$img[0]}.png", [
                                'class' => 'lista-iconos',
                                'data-id' => $img[0],
                                ]) ?>
                        <?php endforeach ?>
                    </div>
                    <?php Modal::end() ?>
                    <?= $form->field($modelHab, 'icono_id', [
                        'template' => "{input}"
                        ])->hiddenInput() ?>
                </div>
            </div>
            <?= $form->field($modelHab, 'icono_id', [
                'template' => "{hint}\n{error}"
                ]) ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="col-md-10" style="padding-left: 0px;">
            <?php if ($esMod): ?>
            <h4><span class="label label-info">
                Habitación: <?= Html::encode($modelHab->nombre) ?>
            </span></h4>
            <?php endif ?>
            <?= $form->field($modelHab, 'nombre', [
                'inputTemplate' => UtilHelper::inputGlyphicon('tag'),
                ])->textInput([
                    'maxlength' => 20,
                    'style'=>'width: 80%; display: inline; margin-right: 10px;',
                ])->label('Nombre de la habitación', [
                    'style' => 'display: block',
                ]) ?>
            <?= $form->field($modelHab, 'seccion_id')->dropDownList($secciones, [
                'style'=>'width: 80%; margin-right: 10px;',
                ]) ?>

            <div class="form-group">
                <?= Html::submitButton($esMod ? 'Modificar' : 'Añadir', [
                    'class' => 'btn btn-success',
                    'id' => 'guardarHab-button'
                ]) ?>
                <?php if ($esMod): ?>
                    <?= Html::button('Cancelar', [
                        'class' => 'btn btn-danger',
                        'id' => 'cancelarHab-button',
                    ]) ?>
                <?php endif ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
