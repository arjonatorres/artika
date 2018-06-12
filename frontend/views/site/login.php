<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use common\helpers\UtilHelper;
$css = <<<CSS
    html, body {
        background: url("../imagenes/fondo.jpg") no-repeat center center fixed;
        background-size: cover;
    }
    .wrap {
        background: none;
        background-color: rgba(0,0,0,0.7);
    }
CSS;
$this->registerCss($css);

$title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary panel-principal">
                <div class="panel-heading panel-heading-principal">
                    <h3 class="panel-title"><?= Html::encode($title) ?></h3>
                </div>
                <div class="panel-body panel-body-gris">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username', [
                        'inputTemplate' => UtilHelper::inputGlyphicon('user'),
                        ])->textInput(['autofocus' => true, 'tabindex' => 1]) ?>

                    <?= $form->field($model, 'password', [
                        'inputTemplate' => UtilHelper::inputGlyphicon('lock'),
                        ])->passwordInput(['tabindex' => 2])
                        ->label(
                            $model->getAttributeLabel('password') . ' ('
                            . Html::a(
                                '¿No recuerda su contraseña?',
                                ['site/request-password-reset'])
                                . ')'
                                ) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <hr>
                    <div class="text-center">
                        <?= Html::a('¿No ha recibido el email de confirmación?', ['site/request-active-email']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
