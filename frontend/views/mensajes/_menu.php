<?php
use yii\helpers\Html;
use common\helpers\UtilHelper;
?>

<p>
    <?= Html::a(
        UtilHelper::glyphicon('plus') . ' Mensaje nuevo',
        ['create'],
        ['class' => 'btn btn-success']
    ) ?>
    <?= Html::a(
        UtilHelper::glyphicon('inbox') . ' Recibidos',
        ['recibidos'],
        ['class' => 'btn btn-primary']
    ) ?>
    <?= Html::a(
        UtilHelper::glyphicon('send') . ' Enviados',
        ['enviados'],
        ['class' => 'btn btn-primary']
    ) ?>
</p>
<hr>
