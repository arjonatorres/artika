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

    function funcionalidadBotones() {
        $('.boton-borrar').off();
        $('.boton-borrar').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var enlace = $(this);
            var panelPropio = enlace.closest('.panel-seccion');
            var camaraId = panelPropio.data('id');
            var nombre = (enlace.closest('h4').text()).trim();
            krajeeDialog.confirm('¿Estás seguro que quieres borrar la camara "'
            + nombre +'"?', function (result) {
                if (result) {
                    $.ajax({
                        url: enlace.attr('href') + '?id=' + camaraId,
                        type: 'POST',
                        data: {},
                            success: function(data) {
                                if (data) {
                                    var idPropio = panelPropio.data('id');
                                    panelPropio.animate({opacity: 0.0}, 400).slideUp(400, function() {
                                        panelPropio.remove();
                                    });
                                    $('#habitaciones-seccion_id').find('option[value="' + idPropio + '"]').remove();
                                    volverCrearCamara();
                                } else {
                                    krajeeDialog.alert('No se ha podido borrar la sección.');
                                }
                            }
                    });
                }
            });
        });
        $('.boton-editar').off();
        $('.boton-editar').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var camaraId = $(this).closest('.panel-seccion').data('id');
            $.ajax({
                url: $(this).attr('href') + '?id=' + camaraId,
                type: 'GET',
                data: {},
                    success: function(data) {
                        if (data) {
                            $('#vista-camara').html(data);
                        }
                    }
            });
        });
    }
    funcionalidadBotones();
    $('#boton-anadir-cam').on('click', function() {
        volverCrearCamara();
    });

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
        'style' => 'width: 100%; font-size: 16px;',
    ]) ?>

<!-- TODO - Poner botón a pie de página para ir hacia arriba -->
