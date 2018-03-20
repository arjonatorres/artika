<?php

use yii\web\View;

use yii\helpers\Url;

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
$urlSecciones = Url::to(['casas/crear-seccion']);

$js = <<<EOL
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

    function funcionalidadBotones() {
        function chevIcon(elem) {
            var derecha = 'glyphicon-chevron-right';
            var abajo = 'glyphicon-chevron-down';
            if (elem.hasClass(derecha)) {
                elem.removeClass(derecha);
                elem.addClass(abajo);
            } else {
                elem.removeClass(abajo);
                elem.addClass(derecha);
            }
        }
        $('.panel-seccion').find('a[data-toggle="collapse"]').off('click');
        $('.panel-seccion').find('a[data-toggle="collapse"]').on('click', function () {
            chevIcon($(this).find('.chev'));
        });

        $('.boton-borrar').off();
        $('.boton-borrar').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var enlace = $(this);
            var panelPropio = enlace.closest('.panel-seccion');
            var seccionId = panelPropio.data('id');
            var nombre = (enlace.closest('h4').text()).trim();
            krajeeDialog.confirm('¿Estás seguro que quieres borrar la sección "'
            + nombre +
            '" y todo el contenido que tiene dentro?', function (result) {
                if (result) {
                    $.ajax({
                        url: enlace.attr('href') + '?id=' + seccionId,
                        type: 'POST',
                        data: {},
                            success: function(data) {
                                if (data) {
                                    var idPropio = panelPropio.data('id');
                                    panelPropio.animate({opacity: 0.0}, 400).slideUp(400, function() {
                                        panelPropio.remove();
                                    });
                                    $('#habitaciones-seccion_id').find('option[value="' + idPropio + '"]').remove();
                                    volverCrearSeccion();
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
            var seccionId = $(this).closest('.panel-seccion').data('id');
            $.ajax({
                url: $(this).attr('href') + '?id=' + seccionId,
                type: 'GET',
                data: {},
                    success: function(data) {
                        if (data) {
                            $('#casa-usuario').html(data);
                        }
                    }
            });
        });

        $('.boton-editar-habitacion').off();
        $('.boton-editar-habitacion').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var habId = $(this).closest('.icono-nombre').data('id');
            $.ajax({
                url: $(this).attr('href') + '?id=' + habId,
                type: 'GET',
                data: {},
                    success: function(data) {
                        if (data) {
                            $('#casa-usuario').html(data);
                        }
                    }
            });
        });

        $('.boton-borrar-habitacion').off();
        $('.boton-borrar-habitacion').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var enlace = $(this);
            var panelPropio = enlace.closest('.icono-nombre');
            var habId = panelPropio.data('id');
            var nombre = ($('#it-habitacion-nombre' + habId).text()).trim();
            krajeeDialog.confirm('¿Estás seguro que quieres borrar la habitación "'
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
        <h3 class="panel-title"><?= UtilHelper::glyphicon('home', ['class' => 'icon-sm']) ?> Casa</h3>
    </div>
    <div class="panel-body panel-body-principal">
        <?php foreach ($secciones as $key => $seccion): ?>
            <?= UtilHelper::itemMenuCasa($seccion) ?>
        <?php endforeach ?>
    </div>
</div>
