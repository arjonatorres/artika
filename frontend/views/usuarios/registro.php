<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

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

$title = 'Registrarse';
$this->params['breadcrumbs'][] = $title;

?>
<div class="site-signup">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary panel-principal">
                <div class="panel-heading panel-heading-principal">
                    <h3 class="panel-title"><?= Html::encode($title) ?></h3>
                </div>
                <div class="panel-body panel-body-gris">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username', [
                            'inputTemplate' => UtilHelper::inputGlyphicon('user'),
                            'enableAjaxValidation' => true,
                        ])->textInput(['autofocus' => true]) ?>

                        <?= $form->field( $model, 'email', [
                            'inputTemplate' => UtilHelper::inputGlyphicon('envelope'),
                            'enableAjaxValidation' => true,
                        ])->textInput() ?>

                        <?= $form->field($model, 'password', [
                            'inputTemplate' => UtilHelper::inputGlyphicon('lock'),
                        ])->passwordInput() ?>

                        <?= $form->field($model, 'password_repeat', [
                            'inputTemplate' => UtilHelper::inputGlyphicon('lock'),
                        ])->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Registro', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
