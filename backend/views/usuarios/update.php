<?php

use yii\jui\DatePicker;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use common\helpers\Timezone;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;

$css = <<<JS
    .mapa {
        border: 1px solid #CCC;
    }
JS;

$this->registerCss($css);

$js = <<<JS
    function enviar(cadena) {
        $('#perfiles-localizacion').val(cadena);
        $('#perfil-form').submit();
    }
    $('#guardar').on('click', function (e) {
        e.preventDefault();
        var dir = $('#perfiles-direccion').val();
        var ciu = $('#perfiles-ciudad').val();
        if (dir !== '' || ciu !== '') {
            var address = dir + ' ' + ciu;
            geocoder = new google.maps.Geocoder();
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (results.length == 0) {
                    enviar('');
                } else {
                    var a = results[0].geometry.location;
                    enviar(a.lat() + ',' + a.lng());
                }
            });
        } else {
            enviar('');
        }
    });
JS;

$this->registerJs($js);

?>

<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Configuración de la cuenta</h3>
    </div>
    <div class="panel-body panel-body-gris">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'id' => 'cuenta-form',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-md-3',
                    'wrapper' => 'col-md-8',
                ],
            ],
        ]);
        ?>

        <?= $form->field($usuario, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($usuario, 'email')->textInput() ?>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-12">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                <?= Html::a('Cancelar', ['usuarios/index'], [
                    'class' => 'btn btn-danger',
                    'id' => 'cancelar',
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<hr>

<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Configuración del perfil</h3>
    </div>
    <div class="panel-body panel-body-gris">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'id' => 'perfil-form',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-md-3',
                    'wrapper' => 'col-md-8',
                ],
            ],
        ]);
        ?>

        <?= $form->field($perfil, 'nombre_apellidos')->textInput(['autofocus' => true]) ?>
        <?= $form->field($perfil, 'genero_id')->dropDownList(
            $listaGeneros,
            [
                'id' => 'lista',
                'prompt' => 'Seleccione un género',
            ]) ?>
        <?= $form->field($perfil, 'zona_horaria')->textInput()->dropDownList(
            ArrayHelper::map(
                Timezone::getAll(),
                'timezone',
                'name'
            ), ['prompt' => 'Seleccione una zona horaria (Por defecto: Europe/Madrid)']
        ) ?>
        <?= $form->field($perfil, 'direccion')->textInput() ?>
        <?= $form->field($perfil, 'ciudad')->textInput() ?>
        <!-- <div class="row"> -->
            <div class="form-group" style="margin-bottom: 0px;">
                <label class="control-label col-md-3">Localización</label>
                <div class="col-md-8">
                    <?php if ($perfil->localizacion === null):
                        if ($perfil->direccion !== null || $perfil->ciudad !== null) {
                            $respuesta = 'válida';
                        } else {
                            $respuesta = '';
                        }
                    ?>
                    <h4>
                        <span class="label label-warning">
                            Introduzca una dirección y ciudad <?= $respuesta ?> para mostrar su localización
                        </span>
                    </h4>
                    <?php
                        $coord = new LatLng(['lat' => 36.6850064, 'lng' => -6.126074399999993]);
                        $zoom = 8;
                    else:
                        $usuario = Yii::$app->user->identity;
                        $ruta = $usuario->perfil->rutaImagen;
                        $a = explode(',', $perfil->localizacion);
                        $coord = new LatLng(['lat' => $a[0], 'lng' => $a[1]]);
                        $zoom = 16;
                        $marker = new Marker([
                            'position' => $coord,
                            'title' => $usuario->username,
                        ]);

                        // Provide a shared InfoWindow to the marker
                        $marker->attachInfoWindow(
                            new InfoWindow([
                                'content' => '<p>Protegido por ArTiKa</p>'
                                . '<div class="text-center">'
                                . Html::img($ruta,
                                    ['class' => 'img-sm img-circle'])
                                . '</div>'
                            ])
                        );

                    endif;
                    $map = new Map([
                        'center' => $coord,
                        'zoom' => $zoom,
                        'width' => '100%',
                        'height' => 256,
                        'containerOptions' => [
                            'class' => 'mapa',
                        ],
                    ]);
                    if (isset($marker)) {
                        $map->addOverlay($marker);
                    }
                    ?>
                    <!-- Display the map -finally :) -->
                    <?= $map->display() ?>
                </div>
            </div>
        <!-- </div> -->
        <?= $form->field($perfil, 'localizacion')->hiddenInput()->label(false) ?>
        <?= $form->field($perfil, 'provincia')->textInput() ?>
        <?= $form->field($perfil, 'pais')->textInput() ?>
        <?= $form->field($perfil, 'cpostal')->textInput() ?>
        <?= $form->field($perfil, 'fecha_nac')
            ->textInput()
            ->widget(DatePicker::classname(), [
                'dateFormat' => 'dd-MM-yyyy',
                'clientOptions' => [
                    'showOn' => 'both',
                    'changeYear' => true,
                    'changeMonth' => true,
                    'buttonImage' => '/imagenes/calendar.png',
                ]
                ]) ?>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-12">
                <?= Html::submitButton('Guardar', [
                    'class' => 'btn btn-success',
                    'id' => 'guardar',
                ]) ?>
                <?= Html::a('Cancelar', ['usuarios/index'], [
                    'class' => 'btn btn-danger',
                    'id' => 'cancelar',
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<hr>

<h3><span class="label label-danger">Zona de peligro</span></h3>
<div class="panel panel-danger panel-principal">
    <div class="panel-heading panel-heading-danger">
        <h3 class="panel-title">Eliminar cuenta</h3>
    </div>
    <div class="panel-body panel-body-gris">
        <p>Una vez hayas eliminado la cuenta no hay vuelta atrás.</p>
        <?= Html::a(
            'Eliminar cuenta',
            ['delete'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de que quieres borrar la cuenta?',
                'method' => 'post',
            ],
            'data-params' => [
                'id' => $usuario->id,
            ],
        ]) ?>
    </div>
</div>
