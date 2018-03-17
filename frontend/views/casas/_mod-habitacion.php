<?php

use common\helpers\UtilHelper;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('th-large', ['class' => 'icon-sm']) ?>
             Modificar habitación de la casa
        </h3>
    </div>
    <div class="panel-body">

        <?= $this->render('_input-habitacion', [
                'modelHab' => $modelHab,
                'secciones' => $secciones,
            ]);
        ?>
    </div>
</div>
