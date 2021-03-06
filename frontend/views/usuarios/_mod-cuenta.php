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
                    'label' => 'col-md-3',
                    'wrapper' => 'col-md-8',
                ],
            ],
        ]);
        ?>

        <?= $form->field($model, 'username', [
            'inputTemplate' => UtilHelper::inputGlyphicon('user'),
            ])->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email', [
            'inputTemplate' => UtilHelper::inputGlyphicon('envelope'),
        ])->textInput() ?>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-9">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<hr>

<h3><span class="label label-danger">Zona de peligro</span></h3>
<div class="panel panel-danger panel-principal">
    <div class="panel-heading panel-heading-danger">
        <h3 class="panel-title">Eliminar cuenta</h3>
    </div>
    <div class="panel-body panel-body-gris">
        <p>Una vez hayas eliminado la cuenta no hay vuelta atrás.</p>
        <?= Html::a(
            'Eliminar cuenta',
            ['delete'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de que quieres borrar la cuenta?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
