<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username', [
                        'inputTemplate' =>
                        '<div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>{input}
                        </div>'
                        ])->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password', [
                        'inputTemplate' =>
                        '<div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>{input}
                        </div>'
                        ])->passwordInput()
                        ->label(
                            $model->getAttributeLabel('password') . ' ('
                            . Html::a(
                                '¿No recuerda su contraseña?',
                                ['site/request-password-reset'])
                                . ')'
                                ) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="text-center">
                <?= Html::a('¿No ha recibido el email de confirmación?', ['site/request-active-email']) ?>
            </div>
        </div>
    </div>
</div>
