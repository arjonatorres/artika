<?php

/* @var $this yii\web\View */
$js = <<<JS
    $('.nombrex').hover(function() {
        $('.medio').animate({'font-size': '1em'}, 500);
    },
    function() {
        $('.medio').animate({'font-size': '0em'}, 500);
    });
JS;

$this->registerJs($js);
$css = <<<CSS
    html, body {
        background: url("imagenes/fondo.jpg") no-repeat center center fixed;
        background-size: cover;
    }
    .wrap {
        background: none;
        background-color: rgba(0,0,0,0.7);
    }
CSS;
if (Yii::$app->user->isGuest) {
    $this->registerCss($css);
}
?>
<div class="site-index">
    <div class="jumbotron inicio" style="padding: 0px">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="titulo" style="padding: 0px; width:200px; margin: 0px auto">
                <h1>
                    <span class="label label-primary">ArTiKa</span>
                </h1>
            </div>
        <?php else: ?>
            <h1 class="nombrex">
                <span class="big">Ar</span><div class="medio">jona domó</div><span class="big">TiKa</span>
            </h1>
            <h3>Domótica al alcance de todos usando Raspberry y Arduino</h3>
        <?php endif ?>
    </div>
    <div class="text-center">
        <?php if (!Yii::$app->user->isGuest): ?>
            <img src="/imagenes/iot.png" alt="" style="margin: 10px auto" class="img-thumbnail">
        <?php else: ?>
            <div class="panel panel-primary" style="width: 524px;margin: 0px auto;">
                <div class="panel-heading panel-heading-principal inicio">
                    <h4 style="margin: 0px; text-align: left; font-size: 16px;">¿Qué es la domótica?</h4>
                </div>
                <div class="panel-body" style="padding: 0px; background-color: #555">
                    <video src="videos/domo.mp4" autoplay controls muted loop width="520"></video>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
