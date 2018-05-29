<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Mensajes;

use common\helpers\UtilHelper;

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => (YII_ENV_PROD ? '/backend': '') . '/favicon.ico']); ?>
    <?= Html::csrfMetaTags() ?>
    <title>Artika Admin</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img((YII_ENV_PROD ? '/backend': '') . '/imagenes/atk-logo-admin.png', [
            'alt' => 'Artika',
            'width' => '30px;',
            'style' => 'display: inline; margin-top: -3px;',
        ]) . ' ' . Yii::$app->name . ' AdMiN',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    if (!Yii::$app->user->isGuest) {
        $etiqueta_mensaje = UtilHelper::glyphicon('envelope');
        $no_leido = Mensajes::find()->where(['destinatario_id' => Yii::$app->user->id, 'estado_dest' => 0])->count();
        if ($no_leido > 0) {
            $etiqueta_mensaje .= ' <span class="badge">' . $no_leido . '</span>';
        }
        $menuItems[] = [
            'label' => $etiqueta_mensaje,
            'url' => '',
            'visible' => !Yii::$app->user->isGuest, 'items' => [
                [
                    'label' => UtilHelper::glyphicon('inbox')
                    . ' Recibidos'
                    . ($no_leido > 0 ? ' (' . $no_leido . ')': ''),
                    'url' => ['/mensajes/recibidos']
                ],
                ['label' => UtilHelper::glyphicon('send') . ' Enviados', 'url' => ['/mensajes/enviados']],
                '<li class="divider"></li>',
                ['label' => UtilHelper::glyphicon('plus') . ' Mensaje nuevo', 'url' => ['/mensajes/create']],
            ],
            'dropDownOptions' => [
                'id' => 'menu-mensajes',
            ],
            'options' => [
                'class' => 'mensajes-dropdown text-center',
            ],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                UtilHelper::glyphicon('log-out') . ' Cerrar sesión',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuCasa = [
            [
                'label' => '',
            ],
            UtilHelper::menuItem('Usuarios', 'user', 'usuarios/index'),
            UtilHelper::menuItem('Blog', 'book', 'posts/index'),
            UtilHelper::menuItem('Localización', 'screenshot', 'usuarios/localizacion'),
        ];
    } else {
        $menuCasa = [];
    }

    echo Nav::widget([
        'id' => 'menu-admin',
        'options' => ['class' => 'navbar-nav navbar-left menu-item'],
        'items' => $menuCasa,
    ]);

    echo Nav::widget([
        'id' => 'menu-sesion',
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
