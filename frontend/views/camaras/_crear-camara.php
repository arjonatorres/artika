<?php
use common\helpers\UtilHelper;
$js = <<<JS
deshabilitarAcciones();
JS;

$this->registerJs($js);

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('facetime-video', ['class' => 'icon-sm']) ?>
             Añadir videocámara
         </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="/imagenes/cam.png" alt="">
            </div>
            <div class="col-md-7">
                <h4><b>Añada cámaras de videovigilancia</b></h4>
                <p>Para añadir una cámara de videovigilancia escriba su nombre,
                indique también la URL de la misma y el puerto.</p>
                <p>A continuación haga click en Añadir, y la nueva videocámara
                se añadirá a la lista de la izquierda.</p>
            </div>
        </div>
        <hr>
        <?= $this->render('_input-camara', [
                'model' => $model,
            ]);
        ?>
    </div>
</div>
