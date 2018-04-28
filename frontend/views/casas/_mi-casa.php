<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UtilHelper;
use kartik\growl\GrowlAsset;

GrowlAsset::register($this);
$urlOrden = Url::to(['modulos/orden']);
$urlSincronizar = Url::to(['casas/sincronizar']);

$js = <<<JS
    $('body').prepend('<div class="loading" style="display: block;"></div>');
    function mandarOrden() {
        var id = $(this).parent().data('id');
        var orden;
        var boton = $(this);
        if (boton.hasClass('boton-on') || boton.hasClass('boton-subir')) {
            orden = 1;
        } else if (boton.hasClass('boton-bajar')) {
            orden = 2;
        } else {
            orden = 0;
        }
        $('.btn-orden').off();
        $("body").css("cursor", "wait");
        //$('.loading').css({display: 'block'});
        $.ajax({
            url: '$urlOrden',
            type: 'POST',
            data: {
                id: id,
                orden: orden
            },
            success: function (data) {
                if (data == 'ok') {
                    if (boton.hasClass('boton-off') || boton.hasClass('boton-parar')) {
                        boton.removeClass('btn-default');
                        boton.addClass('btn-danger');
                        boton.siblings().removeClass('btn-success');
                        boton.siblings().addClass('btn-default');
                    } else {
                        boton.removeClass('btn-default');
                        boton.addClass('btn-success');
                        boton.siblings().removeClass('btn-danger');
                        boton.siblings().removeClass('btn-success');
                        boton.siblings().addClass('btn-default');
                    }
                    activar();
                } else if (data == 'error') {
                    mostrarError('Error', 'La orden no ha podido llevarse a cabo');
                    setTimeout(activar, 2500);
                } else {
                    mostrarError('Error', 'El servidor no responde');
                    setTimeout(activar, 2500);
                }
            },
            error: function() {
                mostrarError('Error', 'Ha ocurrido un error al realizar la petición');
                setTimeout(activar, 2500);
            }
        });
    }
    function activar() {
        $("body").css("cursor", "default");
        $('.loading').css({display: 'none'});
        $('.btn-orden').on('click', mandarOrden);
    }
    function mostrarError(titulo, mensaje) {
        $.notify(
            {
                title: titulo + '<br> <hr class="kv-alert-separator">',
                message: mensaje,
                icon: 'glyphicon glyphicon-remove-sign',
            },
            {
                type: 'danger',
                delay: 1000,
                placement: {
                    from: 'bottom',
                    align: 'right'
                }
            }
        );
    }

    function sincronizar() {
        $('.loading').css({display: 'block'});
        $.ajax({
            url: '$urlSincronizar',
            type: 'POST',
            data: {},
            success: function (data) {
                if (data) {
                    $('#casa-usuario').html(data);
                } else {
                    mostrarError('Error', 'No se ha podido realizar la sincronización');
                }
            },
            error: function() {
                mostrarError('Error', 'No se ha podido realizar la sincronización');
            },
            complete: function() {
                $('.loading').css({display: 'none'});
                activar();
            }
        });
    }
    setTimeout(sincronizar, 50);

JS;

$this->registerJs($js);

$nombre = $model->nombre;
$id = $model->id;

?>
<div class="panel panel-primary margen-bottom-md">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span id="seccion-nombre<?= $id ?>"><?= Html::encode($nombre) ?></span>
        </h4>
    </div>
    <div class="panel-body panel-body-principal">
        <?php foreach (
            $model->getHabitaciones()
                ->joinWith('modulos', true, 'RIGHT JOIN')->orderBy('id')->all()
                as $habitacion): ?>
        <div class="panel panel-default panel-seccion margen-bottom-sm">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a id="habitacion-nombre<?= $habitacion->id ?>"></a>
                        <?= Html::img("/imagenes/iconos/{$habitacion->icono_id}.png", [
                            // 'id' => "it-$den-icono$item->id",
                            'class' => 'img-xs img-circle',
                        ]) ?>
                        <?= Html::encode($habitacion->nombre) ?>
                </h4>
            </div>
            <div class="panel-body">
                <?php foreach ($habitacion->getModulos()->orderBy('id')->all() as $modulo): ?>
                    <div class="col-md-4">
                        <div class="panel panel-default panel-modulo">
                            <div class="panel-heading panel-heading-modulo">
                                <h4 class="panel-title">
                                    <span id="modulo-nombre<?= $modulo->id ?>"><?= Html::encode($modulo->nombre) ?></span>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-modulo">
                                <?= UtilHelper::mostrarModulo($modulo) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</div>
