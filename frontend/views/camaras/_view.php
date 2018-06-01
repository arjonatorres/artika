<?php
use yii\helpers\Html;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Camaras */
$urlArray = parse_url($model->url);
$url = (isset($urlArray['scheme']) ? $urlArray['scheme'] : '') . '://'
    . (isset($urlArray['host']) ? $urlArray['host'] : '') . ':' . $model->puerto
    . (isset($urlArray['path']) ? $urlArray['path'] : '');

$js = <<<JS
    function botonesAcciones() {
        var botonMod = $('#boton-mod-cam');
        var botonBorrar = $('#boton-borrar-cam');
        var nombre = '$model->nombre';
        var id = $model->id;
        botonMod.removeAttr('disabled');
        botonBorrar.removeAttr('disabled');
        botonMod.text('Modificar ' + nombre);
        botonBorrar.text('Borrar ' + nombre);
        botonMod.data('id', id);
        botonBorrar.data('id', id);
    }
    botonesAcciones();
JS;

$this->registerJs($js);
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('facetime-video', ['class' => 'icon-sm']) ?>
            <?= ' ' . $model->nombre ?>
         </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <div class="row">
            <div class="text-center">
                <iframe src="<?= Html::encode($url) ?>"></iframe>
            </div>
        </div>
    </div>
</div>
