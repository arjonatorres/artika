<?php

use common\helpers\UtilHelper;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('th-large', ['class' => 'icon-sm']) ?>
             Modificar sección de la casa
        </h3>
    </div>
    <div class="panel-body">

        <?= $this->render('_input-seccion', [
                'model' => $model,
            ]);
        ?>
    </div>
</div>
