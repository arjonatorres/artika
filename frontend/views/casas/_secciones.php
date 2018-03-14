<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$title = 'Secciones';
$this->params['breadcrumbs'][] = $title;

$urlCrearSeccion = Url::to(['casas/crear-seccion']);
$js = <<<EOL
    var max = $('#secciones-nombre').attr('maxlength');
    $('#secciones-nombre').after($('<span id="quedan" class="label label-danger">20</span>'));
    $('#secciones-nombre').on('input', function() {
        var lon = max - $(this).val().length;
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
    });

    $('#seccion-form').on('beforeSubmit', function () {
        $.ajax({
            url: '$urlCrearSeccion',
            type: 'POST',
            data: {
                'Secciones[nombre]': $('#seccion-form').yiiActiveForm('find', 'secciones-nombre').value
            },
            success: function (data) {
                $('#menu-casa-usuario').html(data);
            }
        });
        return false;
    });
EOL;

$this->registerJs($js);
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Añadir sección a la casa</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="/imagenes/plano_casa.png" alt="">
            </div>
            <div class="col-md-9">
                <h4><b>Para añadir secciones y habitaciones</b></h4>
                <p>Para añadir una sección escriba su nombre y haga click en Añadir.
                La nueva sección se añadirá a la lista de la izquierda.</p>
                <p>Una vez exista alguna sección podrá añadir una habitación asociada
                a ella. Escriba un nombre para la habitación, elija la sección a
                la que pertenece y haga click en Añadir.</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="/imagenes/seccion.png" alt="">
            </div>
            <div class="col-md-9">
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
                    <?= Html::submitButton('Añadir', [
                        'class' => 'btn btn-success',
                        'id' => 'guardar-button'
                    ]) ?>
                </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
