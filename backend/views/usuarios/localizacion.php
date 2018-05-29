<?php
use yii\helpers\Html;

use common\helpers\UtilHelper;

use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;

use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;

/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = 'Localización';
?>

<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('user', ['class' => 'icon-sm']) ?>
            Localización de los usuarios
        </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <?php $map = new Map([
            'center' => new LatLng(['lat' => 40.4167754, 'lng' => -3.7037902]),
            'zoom' => 6,
            'width' => '100%',
            'height' => 550,
            'containerOptions' => [
                'class' => 'mapa',
            ],
        ]); ?>
        <?php foreach ($perfiles as $perfil): ?>
            <?php
                $usuario = $perfil->usuario;
                $ruta = (YII_ENV_PROD ? '/backend': '') . $usuario->perfil->rutaImagen;
                $a = explode(',', $perfil->localizacion);
                $coord = new LatLng(['lat' => $a[0], 'lng' => $a[1]]);
                $marker = new Marker([
                    'position' => $coord,
                    'title' => $usuario->username,
                ]);

                // Provide a shared InfoWindow to the marker
                $marker->attachInfoWindow(
                    new InfoWindow([
                        'content' => '<div class="text-center">'
                        . '<p>' . $usuario->username .'</p>'
                        . Html::img($ruta,
                            ['class' => 'img-m img-circle'])
                        . '</div>'
                    ])
                );

                if (isset($marker)) {
                    $map->addOverlay($marker);
                }
            ?>
        <?php endforeach ?>
        <!-- Display the map -finally :) -->
        <?= $map->display() ?>
    </div>
</div>
