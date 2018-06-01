<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$accion = Yii::$app->controller->action->id;
$esMod = $accion === 'update';

$urlCrearCamaraAjax = Url::to(['camaras/crear-camara-ajax']);
$urlModificarCamaraAjax = Url::to(['camaras/modificar-camara-ajax']);

$js = <<<JS
var max = $('#camaras-nombre').attr('maxlength');
$('#camaras-nombre').after($('<span id="quedan" class="label"></span>'));
mostrarNumero();
$('#camaras-nombre').on('input', function() {
    mostrarNumero();
});
$('#camaras-puerto').after($('<span class="">(1-65535)</span>'));

function mostrarNumero() {
    var lon = max - $('#camaras-nombre').val().length;
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
    volverCrearCamara();
});
JS;

if ($esMod) {
    $js .= <<<JS
    $('#camara-form').on('beforeSubmit', function () {
        $.ajax({
            url: '$urlModificarCamaraAjax' + '?id=$model->id',
            type: 'POST',
            data: {
                'Camaras[nombre]': $('#camara-form').yiiActiveForm('find', 'camaras-nombre').value,
                'Camaras[url]': $('#camara-form').yiiActiveForm('find', 'camaras-url').value,
                'Camaras[puerto]': $('#camara-form').yiiActiveForm('find', 'camaras-puerto').value
            },
            success: function (data) {
                if (data) {
                    var camaraId = data.id;
                    var it = $('.panel-camara[data-id=' + camaraId + '] a');
                    it.fadeOut(400, function() {
                        it.text(data.nombre);
                        it.hide();
                    }).fadeIn(400);
                }
                volverCrearCamara();
            }
        });
        return false;
    });
JS;
} else {
    $js .= <<<JS
    $('#camara-form').on('beforeSubmit', function () {
        $.ajax({
            url: '$urlCrearCamaraAjax',
            type: 'POST',
            data: {
                'Camaras[nombre]': $('#camara-form').yiiActiveForm('find', 'camaras-nombre').value,
                'Camaras[url]': $('#camara-form').yiiActiveForm('find', 'camaras-url').value,
                'Camaras[puerto]': $('#camara-form').yiiActiveForm('find', 'camaras-puerto').value
            },
            success: function (data) {
                if (data) {
                    $('#menu-camara').find('.panel-body-principal').append(data);
                    var it = $('#menu-camara').find('.panel-camara').last();
                    it.hide();
                    it.css({opacity: 0.0})
                    it.slideDown(400).animate({opacity: 1.0}, 400);
                    volverCrearCamara();
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
        <img src="/imagenes/camera.png" alt="">
    </div>
    <div class="col-md-9">
        <div class="col-md-10" style="padding-left: 0px;">
        <?php $form = ActiveForm::begin([
            'id' => 'camara-form',
            'enableAjaxValidation' => true,
        ]);
        ?>
            <?= $form->field($model, 'nombre')
            ->textInput([
                'maxlength' => 20,
                'style'=>'width: 80%; display: inline; margin-right: 10px;',
            ])->label('Nombre', [
                'style' => 'display: block',
            ]) ?>
            <?= $form->field($model, 'url')
            ->textInput([
                'style'=>'width: 100%; display: inline; margin-right: 10px;',
            ])->label('Url', [
                'style' => 'display: block',
            ]) ?>
            <?= $form->field($model, 'puerto')
            ->textInput([
                'style'=>'width: 30%; display: inline; margin-right: 10px;',
            ])->label('Puerto', [
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
