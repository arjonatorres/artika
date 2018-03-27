<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\helpers\UtilHelper;

use kartik\markdown\Markdown;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
$usuario = $model->usuario;
$nombre = $usuario !== null ? $usuario->username: 'anónimo';
$rutaImagen = $usuario !== null ? $usuario->perfil->rutaImagen : Yii::getAlias('/imagenes/avatar/0.png');
$usuario_id = $usuario !== null ? $usuario->id : '';
$searchModel->usuario_id = $usuario_id;
$imagen = $model->rutaImagen;
?>

<div class="posts-view">
    <div class="panel panel-default borde-redondo">
        <div class="panel-body panel-body-gris borde-redondo
         <?= $imagen ? 'padding-inf-15': ''?>">
            <?php if ($imagen): ?>
                <div class="text-center">
                    <?= Html::a(Html::img($imagen, [
                        'width' => '100%',
                        'class' => 'foto-post',
                        ]),
                        ['view', 'id' => $model->id]
                    ) ?>
                </div>
            <?php endif ?>
            <div class="col-md-10 col-md-offset-1">
                <div class="barra-info">
                    <div class="col-md-4">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>
                        <div class="hide">
                            <?= $form->field($searchModel, 'usuario_id')
                                ->hiddenInput()->label(false) ?>
                        </div>
                        <?= Html::img($rutaImagen,
                            ['class' => 'img-xss img-circle']
                        ) ?>
                        <strong>
                            &nbsp;<?= Html::a('' . UtilHelper::mostrarCorto($nombre), ['/posts/index'], [
                                'data' => [
                                    'method' => 'get',
                                ],
                                'title' => 'Buscar por usuario',
                            ])?></strong>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="col-md-4">
                        <?= UtilHelper::glyphicon('calendar') ?>
                        <?= Yii::$app->formatter->asDate($model->created_at) ?>
                    </div>
                    <div class="col-md-4">
                        <?= UtilHelper::glyphicon('comment') ?> 0 Comentarios
                    </div>
                </div>
                <hr>
                <h3>
                    <?= Html::a(Html::encode($model->titulo), ['view', 'id' => $model->id]) ?>
                </h3>
                <?= Markdown::convert(Html::encode(
                    !$view ?
                    UtilHelper::mostrarCorto($model->contenido, 400) :
                    $model->contenido
                    )
                ) ?>
                <hr>
            </div>
            <div class="col-md-1">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php if ($usuario->id === Yii::$app->user->id): ?>
                        <?= Html::a(
                            UtilHelper::glyphicon(
                                'pencil',
                                ['class' => 'btn btn-xs btn-success']
                            ),
                            ['posts/update', 'id' => $model->id],
                            [
                                'class' => 'boton-editar icon-derecha',
                                'title' => 'Modificar post',
                            ]
                        ) ?>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
