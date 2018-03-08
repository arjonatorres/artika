<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\helpers\IconHelper;

use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$js = <<<EOT
    var activo = $('.dropdown').find('.active');
    if (activo.length > 0) {
        activo.closest('.dropdown').addClass('active');
    }
EOT;
$this->registerJs($js);
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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('imagenes/atk-logo.png', [
            'alt' => 'Artika',
            'width' => '30px;',
            'style' => 'display: inline; margin-top: -3px;',
        ]) . ' ' . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => IconHelper::glyphicon('user') . ' Usuarios',
            'encode' => false,
            'items' => [
                [
                    'label' => IconHelper::glyphicon('log-in') . ' Login',
                    'url' => ['/site/login'],
                    'encode' => false,
                ],
                [
                    'label' => IconHelper::glyphicon('edit') . ' Registrarse',
                    'url' => ['usuarios/registro'],
                    'encode' => false,
                ],
            ],
        ];
    } else {
        $menuItems[] = [
            'label' => IconHelper::glyphicon('user')
                . ' Usuarios (' . Yii::$app->user->identity->username . ')',
            'encode' => false,
            'items' => [
                [
                    'label' => IconHelper::glyphicon('cog') . ' Configuración',
                    'url' => ['usuarios/mod-cuenta'],
                    'encode' => false,
                ],
                '<li class="divider"></li>',
                [
                    'label' => IconHelper::glyphicon('log-out') . ' Logout',
                    'url' => ['site/logout'],
                    'encode' => false,
                    'linkOptions' => ['data-method' => 'POST'],
                ],
            ]
        ];
    }

    echo Nav::widget([
        'id' => 'menu-principal',
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
