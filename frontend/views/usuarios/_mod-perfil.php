<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use common\helpers\Timezone;
use common\helpers\UtilHelper;

use kartik\datecontrol\DateControl;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;

$css = <<<CSS
    .mapa {
        border: 1px solid #CCC;
    }
CSS;

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
        var pro = $('#perfiles-provincia').val();
        var pai = $('#perfiles-pais').val();
        if (dir !== '' || ciu !== '' || pro !== '' || pai !== '') {
            var address = dir + ' ' + ciu + ' ' + pro + ' ' + pai;
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

        <?= $form->field($model, 'nombre_apellidos', [
            'inputTemplate' => UtilHelper::inputGlyphicon('tag'),
            ])->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'genero_id', [
            'inputTemplate' => UtilHelper::inputGlyphicon('user'),
            ])->dropDownList(
            $listaGeneros,
            [
                'id' => 'lista',
                'prompt' => 'Seleccione un género',
            ]) ?>
        <?= $form->field($model, 'zona_horaria', [
            'inputTemplate' => UtilHelper::inputGlyphicon('time'),
            ])->textInput()->dropDownList(
            ArrayHelper::map(
                Timezone::getAll(),
                'timezone',
                'name'
            ), ['prompt' => 'Seleccione una zona horaria (Por defecto: Europe/Madrid)']
        ) ?>
        <?= $form->field($model, 'direccion', [
            'inputTemplate' => UtilHelper::inputGlyphicon('screenshot'),
            ])->textInput() ?>
        <?= $form->field($model, 'ciudad', [
            'inputTemplate' => UtilHelper::inputGlyphicon('map-marker'),
            ])->textInput() ?>
        <!-- <div class="row"> -->
            <div class="form-group" style="margin-bottom: 0px;">
                <label class="control-label col-md-3">Localización</label>
                <div class="col-md-8">
                    <?php if ($model->localizacion === null):
                        if ($model->direccion !== null || $model->ciudad !== null) {
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
                        $a = explode(',', $model->localizacion);
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
        <?= $form->field($model, 'localizacion')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'provincia', [
            'inputTemplate' => UtilHelper::inputGlyphicon('map-marker'),
            ])->textInput() ?>
        <?= $form->field($model, 'pais', [
            'inputTemplate' => UtilHelper::inputGlyphicon('globe'),
            ])->textInput() ?>
        <?= $form->field($model, 'cpostal', [
            'inputTemplate' => UtilHelper::inputGlyphicon('envelope'),
            ])->textInput() ?>
        <?= $form->field($model, 'fecha_nac')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,
            'ajaxConversion'=>false,
            'widgetOptions' => [
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]
        ]); ?>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-9">
                <?= Html::submitButton('Guardar', [
                    'class' => 'btn btn-success',
                    'id' => 'guardar',
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
