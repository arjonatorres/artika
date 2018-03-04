<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activeLink = Yii::$app->urlManager->createAbsoluteUrl(['site/active-count', 'token' => $user->token_val]);
?>
<div class="active-count">
    <p>Hola <?= Html::encode($user->username) ?>,</p>

    <p>Haz click en el siguiente enlace para activar tu cuenta:</p>

    <p><?= Html::a(Html::encode($activeLink), $activeLink) ?></p>
</div>
