<?php

use yii\helpers\Html;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

?>

<div class="posts-limit-view">
    <?= Html::a(Html::encode(UtilHelper::mostrarCorto($model->titulo, 60)), ['view', 'id' => $model->id]) ?>
</div>
