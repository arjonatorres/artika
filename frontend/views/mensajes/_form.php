<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mensajes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensajes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remitente_id')->textInput() ?>

    <?= $form->field($model, 'destinatario_id')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
