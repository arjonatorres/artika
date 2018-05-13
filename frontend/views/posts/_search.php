<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $model common\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-md-10">
        <?= $form->field($model, 'titulo')
        ->textInput(['placeholder' => 'Texto a buscar'])
        ->label(false) ?>
    </div>
    <div class="col-md-2 padding-l-0">
        <div class="form-group">
            <?= Html::submitButton(
                UtilHelper::glyphicon('search'),
                ['class' => 'btn btn-primary']) ?>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
