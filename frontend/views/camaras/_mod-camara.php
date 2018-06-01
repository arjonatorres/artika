<?php
use yii\helpers\Html;

use common\helpers\UtilHelper;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('facetime-video', ['class' => 'icon-sm']) ?>
             Modificar videocámara "<?= Html::encode($model->nombre) ?>"
         </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <?= $this->render('_input-camara', [
                'model' => $model,
            ]);
        ?>
    </div>
</div>
