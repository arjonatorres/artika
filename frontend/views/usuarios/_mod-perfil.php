<?php

use yii\jui\DatePicker;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Configuración del perfil</h3>
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

        <?= $form->field($model, 'nombre_apellidos')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'genero_id')->dropDownList($listaGeneros, ['id' => 'lista']) ?>
        <?= $form->field($model, 'direccion')->textInput() ?>
        <?= $form->field($model, 'ciudad')->textInput() ?>
        <?= $form->field($model, 'provincia')->textInput() ?>
        <?= $form->field($model, 'pais')->textInput() ?>
        <?= $form->field($model, 'cpostal')->textInput() ?>
        <?= $form->field($model, 'fecha_nac')
            ->textInput()
            ->widget(DatePicker::classname(), [
                'dateFormat' => 'dd-MM-yyyy',
                'clientOptions' => [
                    'showOn' => 'both',
                    'changeYear' => true,
                    'changeMonth' => true,
                    'buttonImage' => 'imagenes/calendar.png',
                ]
                ]) ?>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-12">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
