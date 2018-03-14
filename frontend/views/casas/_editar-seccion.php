<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$title = 'Editar sección';
$this->params['breadcrumbs'][] = $title;

$urlModificarSeccionAjax = Url::to(['casas/modificar-seccion-ajax']);
$urlSecciones = Url::to(['casas/crear-seccion']);
$js = <<<EOL
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

    $('#seccion-form').on('beforeSubmit', function () {
        $.ajax({
            url: '$urlModificarSeccionAjax' + '?id=$model->id',
            type: 'POST',
            data: {
                'Secciones[nombre]': $('#seccion-form').yiiActiveForm('find', 'secciones-nombre').value
            },
            success: function (data) {
                $('#menu-casa-usuario').html(data);
                volverCrearSeccion();
            }
        });
        return false;
    });

    function volverCrearSeccion() {
        $.ajax({
            url: '$urlSecciones',
            type: 'POST',
            data: {},
            success: function (data) {
                $('#casa-usuario').html(data);
            }
        });
    }

    $('#cancelar-button').on('click', function () {
        volverCrearSeccion();
    });
EOL;

$this->registerJs($js);
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Modificar sección de la casa</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="/imagenes/seccion.png" alt="">
            </div>
            <div class="col-md-9">
                <h4><span class="label label-info">
                    Sección: <?= Html::encode($model->nombre) ?>
                </span></h4>
                <?php $form = ActiveForm::begin([
                    'id' => 'seccion-form',
                ]);
                ?>
                <?= $form->field($model, 'nombre', [
                    'enableAjaxValidation' => true,
                    'validateOnChange' => false,
                    'validateOnBlur' => false,
                ])
                    ->textInput([
                        'maxlength' => 20,
                        'style'=>'width: 35%; display: inline; margin-right: 10px;',
                    ])
                    ->label('Nombre de la sección', [
                        'style' => 'display: block',
                        ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Modificar', [
                        'class' => 'btn btn-success',
                        'id' => 'guardar-button'
                    ]) ?>
                    <?= Html::button('Cancelar', [
                        'class' => 'btn btn-danger',
                        'id' => 'cancelar-button',
                        ]) ?>
                </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
