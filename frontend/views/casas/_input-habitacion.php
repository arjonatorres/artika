<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

$s = ArrayHelper::toArray($secciones);
$a = ArrayHelper::getColumn($s, 'id');
$b = ArrayHelper::getColumn($s, 'nombre');
$secciones = array_combine($a, $b);

$esMod = false;
// $accion = Yii::$app->controller->action->id;
// $esMod = $accion === 'modificar-seccion';
//
// $urlCrearSeccionAjax = Url::to(['casas/crear-seccion-ajax']);
// $urlModificarSeccionAjax = Url::to(['casas/modificar-seccion-ajax']);
// $urlSecciones = Url::to(['casas/crear-seccion']);
//
$js = <<<EOL
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

EOL;
// function volverCrearSeccion() {
//     $.ajax({
//         url: '$urlSecciones',
//         type: 'POST',
//         data: {},
//         success: function (data) {
//             $('#casa-usuario').html(data);
//         }
//     });
// }
//
// $('#cancelar-button').on('click', function () {
//     volverCrearSeccion();
// });
//
// if ($esMod) {
//     $js .= <<<EOL
//     $('#seccion-form').on('beforeSubmit', function () {
//         $.ajax({
//             url: '$urlModificarSeccionAjax' + '?id=$model->id',
//             type: 'POST',
//             data: {
//                 'Secciones[nombre]': $('#seccion-form').yiiActiveForm('find', 'secciones-nombre').value
//             },
//             success: function (data) {
//                 if (data) {
//                     var it = $('#it$model->id');
//                     it.fadeOut(400, function() {
//                         it.text(data);
//                         it.hide();
//                     }).fadeIn(400);
//                 }
//                 volverCrearSeccion();
//             }
//         });
//         return false;
//     });
// EOL;
// } else {
//     $js .= <<<EOL
//     $('#seccion-form').on('beforeSubmit', function () {
//         $.ajax({
//             url: '$urlCrearSeccionAjax',
//             type: 'POST',
//             data: {
//                 'Secciones[nombre]': $('#seccion-form').yiiActiveForm('find', 'secciones-nombre').value
//             },
//             success: function (data) {
//                 $('#menu-casa-usuario').find('.panel-body-principal').append(data);
//                 var it = $('#menu-casa-usuario').find('.panel-seccion').last();
//                 var padre = $('#secciones-nombre');
//                 it.hide();
//                 it.css({opacity: 0.0})
//                 it.slideDown(400).animate({opacity: 1.0}, 400);
//                 padre.val('');
//                 padre.parent().removeClass('has-success');
//                 mostrarNumero();
//                 funcionalidadBotones();
//             }
//         });
//         return false;
//     });
// EOL;
// }
$this->registerJs($js);

?>
<div class="row">
    <div class="col-md-3 text-center">
        <img src="/imagenes/habitacion.png" alt="">
    </div>
    <div class="col-md-9">
        <?php if ($esMod): ?>
        <h4><span class="label label-info">
            Habitación: <?= Html::encode($modelHab->nombre) ?>
        </span></h4>
        <?php endif ?>
        <?php $form = ActiveForm::begin([
            'id' => 'habitacion-form',
        ]);
        ?>
        <div class="col-md-6" style="padding-left: 0px;">
            <?= $form->field($modelHab, 'nombre', [
                // 'enableAjaxValidation' => true,
                // 'validateOnChange' => false,
                // 'validateOnBlur' => false,
                ])->textInput([
                    'maxlength' => 20,
                    'style'=>'width: 80%; display: inline; margin-right: 10px;',
                    ])->label('Nombre de la habitación', [
                        'style' => 'display: block',
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
        <div class="col-md-6">
            <?= $form->field($modelHab, 'seccion_id')->dropDownList($secciones, [
                'id' => 'lista',
                'style'=>'width: 80%; display: inline; margin-right: 10px;',
                ])->label('Sección', ['style' => 'display: block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
