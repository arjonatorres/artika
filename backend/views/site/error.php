<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <div class="panel panel-danger">
        <div class="panel-body panel-body-gris">
            <p>
                Este error se ha producido mientras el servidor Web estaba procesando tu petición.
            </p>
            <p>
                Por favor contacta con nosotros si crees que es un error del servidor. Muchas gracias
            </p>
        </div>
    </div>
</div>
