<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii2mod\markdown\MarkdownEditor;

use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput([
        'maxlength' => true,
        'tabIndex' => 1
        ]) ?>
        <hr>
        <?= $form->field($model, 'contenido')->widget(MarkdownEditor::class, [
            'editorOptions' => [
                'showIcons' => ["code", "table"],
            ],
        ]); ?>
        <hr>
        <blockquote cite="">
            <p>Nota: La foto deberá tener un formato apaisado</p>
        </blockquote>
    <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
            'pluginOptions' => [
                'allowedFileExtensions' => $model->extensions,
                'initialPreview' => $model->rutaImagen,
                'initialPreviewAsData' => true,
                'uploadLabel' => 'Guardar',
                'uploadClass' => 'btn btn-success',
                'showUpload' => false,
                'removeClass' => 'btn btn-danger',
            ],
            'options' => ['tabIndex' => 3]
        ]) ?>
        <hr>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
