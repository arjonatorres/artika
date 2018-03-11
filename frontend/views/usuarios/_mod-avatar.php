<?php

use yii\bootstrap\ActiveForm;

use kartik\file\FileInput;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Configuración del avatar</h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'offset' => 'col-md-offset-2',
                    'wrapper' => 'col-md-8',
                ],
            ],
        ]);
        ?>
        <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
                'pluginOptions' => [
                    'allowedFileExtensions' => $model->extensions,
                    'initialPreview' => $model->rutaImagen,
                    'initialPreviewAsData' => true,
                    'uploadLabel' => 'Guardar',
                    'uploadClass' => 'btn btn-success',
                    'removeClass' => 'btn btn-danger',
                ],
            ])->label(false) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
