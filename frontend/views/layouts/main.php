<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\helpers\UtilHelper;

use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => '/favicon.ico']); ?>
    <?= Html::csrfMetaTags() ?>
    <title>ArTiKa</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'id' => 'menu-principal',
        'brandLabel' => Html::img('/imagenes/atk-logo.png', [
            'alt' => 'Artika',
            'width' => '30px;',
            'style' => 'display: inline; margin-top: -3px;',
        ]) . ' ' . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            // 'style' => 'border-right: 4px solid #555;'
        ],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    $menuCasa = [];
    if (Yii::$app->user->isGuest) {
        $menuItems = [
            [
                'label' => 'Login',
                'url' => ['/site/login'],
            ],
            [
                'label' => 'Registrarse',
                'url' => ['usuarios/registro'],
            ],
        ];
    } else {
        $menuCasa = [
            [
                'label' => '',
            ],
            UtilHelper::menuItem('Mi casa', 'home', 'casas/mi-casa'),
            UtilHelper::menuItem('Secciones', 'th-large', 'casas/crear-seccion'),
            UtilHelper::menuItem('Módulos', 'off', 'modulos/create'),
            UtilHelper::menuItem('Logs', 'list-alt', 'logs/index'),
        ];
        $usuario = Yii::$app->user->identity;
        $ruta = $usuario->perfil->rutaImagen;
        $menuItems[] = [
            'label' => Html::img($ruta,
                ['class' => 'img-sm img-circle']
            ),
            'encode' => false,
            'items' => [
                [
                    'label' => '<div style="display:flex">'
                        . '<div>'
                        . Html::img($ruta,
                        ['class' => 'img-md img-circle'])
                        . '</div>'
                        . '<div style="margin-top: 8px;">'
                        . '<strong>' . UtilHelper::mostrarCorto(
                            $usuario->perfil->nombre_apellidos ?: $usuario->username)
                        . '</strong>'
                        . '<br>'
                        . '<p>' . UtilHelper::mostrarCorto($usuario->email) . '</p>'
                        . Html::a(UtilHelper::glyphicon('cog') . ' Mi cuenta',
                            ['usuarios/mod-cuenta'],
                            ['class' => 'btn btn-sm btn-primary'])
                        . '</div>'
                    . '</div>',
                    'encode' => false,
                ],
                '<li class="divider"></li>',
                Html::beginForm(['/site/logout'], 'post')
                . '<div class="col-md-offset-2 col-md-8">'
                . Html::submitButton(
                    UtilHelper::glyphicon('log-out') . ' Cerrar sesión',
                    ['class' => 'btn btn-sm btn-danger btn-block']
                    )
                    . Html::endForm()
                . '</div>',
            ],
            'dropDownOptions' => [
                'id' => 'menu-usuario',
            ],
            'options' => [
                'class' => 'user-dropdown',
            ],
        ];
    }

    echo Nav::widget([
        'id' => 'menu-casa',
        'options' => ['class' => 'navbar-nav navbar-left menu-item'],
        'items' => $menuCasa,
    ]);

    echo Nav::widget([
        'id' => 'menu-principal-user',
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
