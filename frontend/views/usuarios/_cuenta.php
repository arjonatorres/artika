<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Configuración de la cuenta</h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'id' => 'login-form',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-md-3',
                    'wrapper' => 'col-md-8',
                ],
            ],
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-12">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<hr>
<h3>Zona de peligro</h3>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">Eliminar cuenta</h3>
    </div>
    <div class="panel-body">
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
