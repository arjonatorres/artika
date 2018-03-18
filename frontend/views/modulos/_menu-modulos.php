<?php

use common\helpers\UtilHelper;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title"><?= UtilHelper::glyphicon('off', ['class' => 'icon-sm']) ?> Módulos</h3>
    </div>
    <div class="panel-body panel-body-principal">
        <?php foreach ($habitaciones as $key => $habitacion): ?>
            <?= UtilHelper::itemMenuModulos($habitacion) ?>
        <?php endforeach ?>
    </div>
</div>
