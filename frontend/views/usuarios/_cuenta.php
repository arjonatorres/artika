<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

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
