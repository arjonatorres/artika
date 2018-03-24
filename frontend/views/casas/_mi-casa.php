<?php
use yii\helpers\Url;
use yii\helpers\Html;

use kartik\growl\GrowlAsset;

GrowlAsset::register($this);
$urlOrden = Url::to(['modulos/orden']);
$js = <<<EOT
    function mandarOrden() {
        var id = $(this).parent().data('id');
        var orden;
        var boton = $(this);
        if (boton.hasClass('boton-on')) {
            orden = 1;
        } else {
            orden = 0;
        }
        $('.btn-orden').off();
        $("body").css("cursor", "wait");
        $.ajax({
            url: '$urlOrden',
            type: 'POST',
            data: {
                id: id,
                orden: orden
            },
            success: function (data) {
                if (data == 'ok') {
                    boton.removeClass('btn-default');
                    boton.addClass('btn-primary');
                    boton.siblings().removeClass('btn-primary');
                    boton.siblings().addClass('btn-default');
                    setTimeout(activar, 500);
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
                delay: 800,
                placement: {
                    from: 'bottom',
                    align: 'right'
                }
            }
        );
    }
    activar();
EOT;

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
                                <div class="row flex-parent">
                                    <div class="col-md-6">
                                        <?= Html::img("/imagenes/iconos/modulos/$modulo->icono_id.png") ?>
                                    </div>
                                    <div class="col-md-5 flex-child" data-id="<?= $modulo->id ?>">
                                        <?= Html::button('ON', [
                                            'class' =>
                                            ($modulo->estado === 0 ? 'btn-default' : 'btn-primary')
                                            . ' btn btn-orden margen-bottom-sm boton-on'
                                        ]) ?>
                                        <?= Html::button('OFF', [
                                            'class' =>
                                            ($modulo->estado === 0 ? 'btn-primary' : 'btn-default')
                                            . ' btn btn-orden margen-bottom-sm boton-off'
                                        ]) ?>
                                    </div>
                                </div>
                                <hr class="margen-bottom-sm">
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</div>
