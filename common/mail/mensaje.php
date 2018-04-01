<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activeLink = Yii::$app->urlManager->createAbsoluteUrl(['mensajes/view', 'id' => $model->id]);
?>
<div class="active-count">
    <p><?= Html::encode($model->remitente->nombre) ?> te ha enviado un mensaje privado.</p>

    <p>Asunto: <strong><?= Html::encode($model->asunto) ?></strong> </p>

    <p>Haz click en el siguiente enlace para verlo:</p>

    <p><?= Html::a(Html::encode($activeLink), $activeLink) ?></p>
</div>
