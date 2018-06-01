<?php

use yii\web\View;

use yii\helpers\Url;
use yii\helpers\Html;

use kartik\dialog\Dialog;

use common\helpers\UtilHelper;
?>
<?= Dialog::widget([
    'dialogDefaults' => [
        'alert' => [
            'title' => 'Información',
        ],
        'confirm' => [
            'type' => Dialog::TYPE_DANGER,
            'title' => 'Confirmación',
            'btnOKClass' => 'btn-danger',
            'btnOKLabel' => '<span class="glyphicon glyphicon-remove"></span> ' . 'Borrar',
            'btnCancelLabel' => '<span class="' . Dialog::ICON_CANCEL . '"></span> ' . 'Cancelar'
        ],
    ],
]); ?>

<?php
$urlAnadirCamaras = Url::to(['camaras/index']);
$urlModCamara = Url::to(['camaras/update']);
$urlBorrarCamara = Url::to(['camaras/delete']);

$js = <<<JS
    function volverCrearCamara() {
        $.ajax({
            url: '$urlAnadirCamaras',
            type: 'GET',
            data: {},
            success: function (data) {
                $('#vista-camara').html(data);
            }
        });
    }

    $('#boton-anadir-cam').on('click', function() {
        volverCrearCamara();
    });
    $('#boton-mod-cam').on('click', function() {
        if ($(this).attr('disabled') != 'disabled') {
            var camaraId = $(this).data('id');
            $.ajax({
                url: '$urlModCamara' + '?id=' + camaraId,
                type: 'GET',
                data: {},
                    success: function(data) {
                        if (data) {
                            $('#vista-camara').html(data);
                        }
                    }
            });
        }
    });
    $('#boton-borrar-cam').on('click', function() {
        if ($(this).attr('disabled') != 'disabled') {
            var nombre = $(this).text().split(' ')[1];
            var camaraId = $(this).data('id');
            var panelPropio = $('.panel-camara[data-id=' + camaraId + ']');
            krajeeDialog.confirm('¿Estás seguro que quieres borrar la camara "'
                + nombre +'"?', function (result) {
                    if (result) {
                        $.ajax({
                            url: '$urlBorrarCamara' + '?id=' + camaraId,
                            type: 'POST',
                            data: {},
                                success: function(data) {
                                    if (data) {
                                        panelPropio.animate({opacity: 0.0}, 400).slideUp(400, function() {
                                            panelPropio.remove();
                                        });
                                        deshabilitarAcciones();
                                        volverCrearCamara();
                                    } else {
                                        krajeeDialog.alert('No se ha podido borrar la sección.');
                                    }
                                }
                        });
                    }
            });
        }
    });

    function deshabilitarAcciones() {
        var botonMod = $('#boton-mod-cam');
        var botonBorrar = $('#boton-borrar-cam');
        botonMod.attr('disabled', true);
        botonBorrar.attr('disabled', true);
        botonMod.text('Modificar');
        botonBorrar.text('Borrar');
    }

    $('#menu-camara').on('click', '.list-group-item-warning a', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            data: {},
            success: function (data) {
                $('#vista-camara').html(data);
            }
        });
    });
JS;

$this->registerJs($js, View::POS_END);
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title"><?= UtilHelper::glyphicon('facetime-video', ['class' => 'icon-sm']) ?> Videocámaras</h3>
    </div>
    <div class="panel-body panel-body-principal">
        <?php foreach ($camaras as $key => $camara): ?>
            <?= UtilHelper::itemMenuCamara($camara) ?>
        <?php endforeach ?>
    </div>
</div>

    <?= Html::a('<b>Añadir videocámara</b>', null, [
        'id' => 'boton-anadir-cam',
        'class' => 'btn btn-success',
        'style' => 'width: 100%; font-size: 16px; margin-bottom: 5px;',
    ]) ?>
    <?= Html::a('<b>Modificar</b>', null, [
        'id' => 'boton-mod-cam',
        'disabled' => true,
        'class' => 'btn btn-primary',
        'style' => 'width: 100%; font-size: 16px; margin-bottom: 5px;',
    ]) ?>
    <?= Html::a('<b>Borrar</b>', null, [
        'id' => 'boton-borrar-cam',
        'disabled' => true,
        'class' => 'btn btn-danger',
        'style' => 'width: 100%; font-size: 16px; margin-bottom: 5px;',
    ]) ?>
