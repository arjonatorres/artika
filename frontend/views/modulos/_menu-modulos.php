<?php

use yii\web\View;

use yii\helpers\Url;

use common\helpers\UtilHelper;

use kartik\dialog\Dialog;
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
$urlSecciones = Url::to(['modulos/create']);

$js = <<<EOL
    function volverCrearSeccion() {
        $.ajax({
            url: '$urlSecciones',
            type: 'GET',
            data: {},
            success: function (data) {
                $('#modulo').html(data);
            }
        });
    }

    function funcionalidadBotones() {
        $('.boton-editar-modulo').off();
        $('.boton-editar-modulo').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var habId = $(this).closest('.icono-nombre').data('id');
            $.ajax({
                url: $(this).attr('href') + '?id=' + habId,
                type: 'GET',
                data: {},
                    success: function(data) {
                        if (data) {
                            $('#modulo').html(data);
                        }
                    }
            });
        });

        $('.boton-borrar-modulo').off();
        $('.boton-borrar-modulo').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var enlace = $(this);
            var panelPropio = enlace.closest('.icono-nombre');
            var habId = panelPropio.data('id');
            var nombre = ($('#it-modulo-nombre' + habId).text()).trim();
            krajeeDialog.confirm('¿Estás seguro que quieres borrar el módulo "'
            + nombre +
            '" y todo el contenido que tiene dentro?', function (result) {
                if (result) {
                    $.ajax({
                        url: enlace.attr('href') + '?id=' + habId,
                        type: 'POST',
                        data: {},
                            success: function(data) {
                                if (data) {
                                    panelPropio.animate({opacity: 0.0}, 400).slideUp(400, function() {
                                        panelPropio.remove();
                                    });
                                    volverCrearSeccion();
                                } else {
                                    krajeeDialog.alert('No se ha podido borrar la sección.');
                                }
                            }
                    });
                }
            });
        });
    }
    funcionalidadBotones();
EOL;

$this->registerJs($js, View::POS_END);

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title"><?= UtilHelper::glyphicon('off', ['class' => 'icon-sm']) ?> Módulos</h3>
    </div>
    <div class="panel-body panel-body-principal">
        <?php foreach ($habitaciones as $key => $habitacion): ?>
            <?= UtilHelper::itemMenuModulos($habitacion) ?>
        <?php endforeach ?>
    </div>
</div>
