<?php

use yii\bootstrap\Collapse;

use common\helpers\UtilHelper;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Casa</h3>
    </div>
    <div class="panel-body panel-body-principal">
        <?php
        foreach ($secciones as $seccion) {
            echo Collapse::widget([
                'items' => [
                    [
                        'label' => UtilHelper::glyphicon('chevron-right', 'icon-sm')
                            . ' '
                            . $seccion->nombre . '',
                        'content' => [],
                        'encode' => false,
                    ],
                ],
                'options' => [
                    'class' => 'panel-seccion',
                ],
            ]);
        }
        ?>
    </div>
</div>
