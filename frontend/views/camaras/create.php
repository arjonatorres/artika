<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Camaras */

$this->title = 'Añadir Videocámara';
$this->params['breadcrumbs'][] = ['label' => 'Camaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="camaras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
