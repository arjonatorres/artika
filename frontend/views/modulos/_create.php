<?php
use common\helpers\UtilHelper;


$title = 'Módulos';
$this->params['breadcrumbs'][] = $title;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('off', ['class' => 'icon-sm']) ?>
             Añadir módulos a la casa
         </h3>
    </div>
    <div class="panel-body">
        <?= $this->render('_input-modulo', [
                'model' => $model,
                'habitaciones' => $habitaciones,
                'tipos' => $tipos,
            ]);
        ?>
    </div>
</div>
