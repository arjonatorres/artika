<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use common\helpers\UtilHelper;

$accion = Yii::$app->controller->action->id;
$esMod = $accion === 'modificar-seccion';

$urlCrearSeccionAjax = Url::to(['casas/crear-seccion-ajax']);
$urlModificarSeccionAjax = Url::to(['casas/modificar-seccion-ajax']);

$js = <<<JS
var max = $('#secciones-nombre').attr('maxlength');
$('#secciones-nombre').after($('<span id="quedan" class="label"></span>'));
mostrarNumero();
$('#secciones-nombre').on('input', function() {
    mostrarNumero();
});

function mostrarNumero() {
    var lon = max - $('#secciones-nombre').val().length;
    var numero = $('#quedan');
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

$('#cancelar-button').on('click', function () {
    volverCrearSeccion();
});
JS;

if ($esMod) {
    $js .= <<<JS
    $('#seccion-form').on('beforeSubmit', function () {
        $.ajax({
            url: '$urlModificarSeccionAjax' + '?id=$model->id',
            type: 'POST',
            data: {
                'Secciones[nombre]': $('#seccion-form').yiiActiveForm('find', 'secciones-nombre').value
            },
            success: function (data) {
                if (data) {
                    var it = $('#it$model->id');
                    it.fadeOut(400, function() {
                        it.text(data);
                        it.hide();
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
    $('#seccion-form').on('beforeSubmit', function () {
        $.ajax({
            url: '$urlCrearSeccionAjax',
            type: 'POST',
            data: {
                'Secciones[nombre]': $('#seccion-form').yiiActiveForm('find', 'secciones-nombre').value
            },
            success: function (data) {
                if (data) {
                    $('#menu-casa-usuario').find('.panel-body-principal').append(data);
                    var it = $('#menu-casa-usuario').find('.panel-seccion').last();
                    var padre = $('#secciones-nombre');
                    it.hide();
                    it.css({opacity: 0.0})
                    it.slideDown(400).animate({opacity: 1.0}, 400);
                    padre.val('');
                    padre.parent().removeClass('has-success');
                    var nuevaOpcion = $('<option value="' + it.data('id') + '"></option>');
                    nuevaOpcion.text(it.text());
                    $('#habitaciones-seccion_id').append(nuevaOpcion);
                    mostrarNumero();
                    funcionalidadBotones();
                }
            }
        });
        return false;
    });
JS;
}
$this->registerJs($js);

?>
<div class="row">
    <div class="col-md-3 text-center">
        <img src="/imagenes/seccion.png" alt="">
    </div>
    <div class="col-md-9">
        <div class="col-md-10" style="padding-left: 0px;">
        <?php if ($esMod): ?>
        <h4><span class="label label-info">
            Sección: <?= Html::encode($model->nombre) ?>
        </span></h4>
        <?php endif ?>
        <?php $form = ActiveForm::begin([
            'id' => 'seccion-form',
        ]);
        ?>
            <?= $form->field($model, 'nombre', [
                'inputTemplate' => UtilHelper::inputGlyphicon('tag'),
                'enableAjaxValidation' => true,
                'validateOnChange' => false,
                'validateOnBlur' => false,
            ])
            ->textInput([
                'maxlength' => 20,
                'style'=>'width: 80%; display: inline; margin-right: 10px;',
            ])
            ->label('Nombre de la sección', [
                'style' => 'display: block',
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
