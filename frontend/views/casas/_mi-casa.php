<?php
use yii\helpers\Html;

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
                ->joinWith('modulos', true, 'RIGHT JOIN')->all()
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
                <?php foreach ($habitacion->modulos as $modulo): ?>
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
                                    <div class="col-md-5 flex-child">
                                            <?= Html::button('ON', ['class' => 'margen-bottom-sm']) ?>
                                        <?= Html::button('OFF') ?>
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
