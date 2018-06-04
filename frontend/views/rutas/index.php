<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

use yii\bootstrap\Alert;

use common\helpers\UtilHelper;
use kartik\file\FileInput;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\Polyline;
use dosamigos\google\maps\Map;

/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = 'Rutas';

$css = <<<CSS
    .mapa {
        border: 1px solid #CCC;
    }
CSS;

$this->registerCss($css);
?>

<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('road', ['class' => 'icon-sm']) ?>
             Rutas
         </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="/imagenes/ruta.png" alt="">
            </div>
            <div class="col-md-9">
                <h4><b>Visualizar ruta de seguimiento</b></h4>
                <p>Sepa siempre dónde están los niños o mayores a su cargo. Podrá
                    visualizar la ruta que han seguido, la hora de inicio y la de fin.</p>
                <p>Añada un archivo con extensión .GPX y a continuación pulse en
                    "Visualizar ruta" y se le mostrará un mapa con la ruta y a la derecha
                    todos los datos de dicha ruta.</p>
            </div>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-9 col-md-offset-3">
                <hr>
            </div>
            <div class="col-md-6 col-md-offset-3">

                <?= $form->field($model, 'ruta')->widget(FileInput::classname(), [
                    'options' => ['accept' => '.gpx'],
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ]
                ]); ?>
                <div class="form-group">
                    <?= Html::submitButton('Visualizar ruta', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <?php if (isset($model->ruta)): ?>
            <?php
            $rutaArchivo = Yii::getAlias('@uploads/') . $model->ruta->name;
            $ficheroValido = false;
            if (file_exists($rutaArchivo)) {
                $coords = [];
                $distancia = 0.0;
                $i = 0;
                try {
                    $xml = simplexml_load_file($rutaArchivo);
                    $ficheroValido = true;
                } catch (\Exception $e) {
                }
            }
            ?>
            <?php if ($ficheroValido && isset($xml->trk->trkseg->trkpt)): ?>
                <div class="col-md-8" style="margin-top: 20px">
                    <?php
                    foreach ($xml->trk->trkseg->trkpt as $point) {
                        $coords[] = new LatLng(['lat' => $point['lat'], 'lng' => $point['lon']]);
                        if ($i != 0) {
                            $distancia += UtilHelper::distancia($coords[$i-1]->lat, $coords[$i-1]->lng, $coords[$i]->lat, $coords[$i]->lng);
                        } else {
                            $marcaInicio = new Marker([
                                'position' => $coords[0],
                                'title' => 'Inicio',
                                'icon' => 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
                            ]);
                        }
                        $i++;
                    }
                    if (!empty($coords)) {
                        $marcaFinal = new Marker([
                            'position' => end($coords),
                            'title' => 'Final',
                            'icon' => 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                        ]);
                    }

                    $coord = new LatLng([
                        'lat' => $xml->trk->trkseg->trkpt[0]['lat'],
                        'lng' => $xml->trk->trkseg->trkpt[0]['lon']
                    ]);
                    $map = new Map([
                        'center' => $coord,
                        'zoom' => 13,
                        'width' => '100%',
                        'height' => 550,
                        'containerOptions' => [
                            'class' => 'mapa',
                        ],
                    ]);
                    $polyline = new Polyline([
                        'path' => $coords,
                        'strokeColor' => '#FF0000',
                    ]);
                    if (isset($marcaInicio)) {
                        $map->addOverlay($marcaInicio);
                    }
                    if (isset($marcaFinal)) {
                        $map->addOverlay($marcaFinal);
                    }

                    // Add it now to the map
                    $map->addOverlay($polyline);
                    ?>

                    <?= $map->display() ?>
                </div>
                <div class="col-md-4" style="margin-top: 20px; border:1px solid #BBB; padding-top:10px;">
                    <?php
                    $fechaInicio = new DateTime($xml->trk->trkseg->trkpt[0]->time);
                    $fechaFin = new DateTime($xml->trk->trkseg->trkpt[count($coords) - 1]->time);
                    ?>
                    <p><b>Nombre de archivo:</b> <?= $model->ruta->name ?></p>
                    <p><b>Hora de inicio:</b> <?= Yii::$app->formatter->asDatetime($fechaInicio) ?></p>
                    <p><b>Hora de fin:</b> <?= Yii::$app->formatter->asDatetime($fechaFin) ?></p>
                    <p><b>Distancia total:</b> <?= $distancia ?> km</p>
                    <p><b>Duración:</b> <?= Yii::$app->formatter->asDuration($fechaInicio->diff($fechaFin)) ?></p>
                </div>
            <?php else: ?>
                <hr>
                <div class="col-md-10 col-md-offset-1">
                    <?=Alert::widget([
                        'options' => [
                            'class' => 'alert-danger',
                        ],
                        'body' => "Archivo $model->ruta no válido.",
                    ]);?>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>
