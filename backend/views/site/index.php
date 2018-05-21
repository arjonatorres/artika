<?php

/* @var $this yii\web\View */
$path = (YII_ENV_PROD ? '/backend': '');
$css = <<<CSS
    html, body {
        background: url("$path/imagenes/fondo.jpg") no-repeat center center fixed;
        background-size: cover;
    }
    .wrap {
        background: none;
    }
CSS;

$this->registerCss($css);
?>
<div class="site-index">

    <div class="jumbotron" style="padding: 0px">
        <h1><span class="label label-danger titulo">ArTiKa Admin</span></h1>
    </div>

</div>
