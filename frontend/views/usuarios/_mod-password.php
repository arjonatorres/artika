<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use common\helpers\UtilHelper;
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Configuración de la cuenta</h3>
    </div>
    <div class="panel-body panel-body-gris">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'id' => 'cuenta-form',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-md-4',
                    'wrapper' => 'col-md-7',
                ],
            ],
        ]);
        ?>

        <?= $form->field($model, 'old_password', [
            'inputTemplate' => UtilHelper::inputGlyphicon('lock'),
            ])->passwordInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password', [
            'inputTemplate' => UtilHelper::inputGlyphicon('lock'),
            ])->passwordInput() ?>
        <?= $form->field($model, 'password_repeat', [
            'inputTemplate' => UtilHelper::inputGlyphicon('lock'),
            ])->passwordInput() ?>

        <div class="form-group">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
