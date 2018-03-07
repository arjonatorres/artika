<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-signup">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field(
                                $model,
                                'username',
                                ['enableAjaxValidation' => true])
                                ->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>

                                <?= $form->field($model, 'password')->passwordInput() ?>

                                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Registro', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
