<?php

use yii\helpers\Html;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

?>

<hr class="margin-10">
<div class="posts-limit-view">
    <?= Html::a(Html::encode(UtilHelper::mostrarCorto($model->titulo, 80)), ['view', 'id' => $model->id]) ?>
</div>
