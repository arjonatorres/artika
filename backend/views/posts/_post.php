<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use cebe\markdown\GithubMarkdown;

use common\helpers\UtilHelper;

use kartik\dialog\Dialog;

use dosamigos\disqus\Comments;
use dosamigos\disqus\CommentsCount;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
$usuario = $model->usuario;

$nombre = $model->usuarioId->nombre; // !== null ? $usuario->username: 'anónimo';
$rutaImagen = (YII_ENV_PROD ? '/backend': '') . $model->usuarioId->rutaImagen; //$usuario !== null ? $usuario->perfil->rutaImagen : Yii::getAlias('/imagenes/avatar/0.png');
$usuario_id = $model->usuario_id;
$searchModel->usuario_id = $usuario_id;
$imagen = (YII_ENV_PROD ? '/backend': '') . $model->rutaImagen;

?>
<?= Dialog::widget([
    'dialogDefaults' => [
        'alert' => [
            'title' => 'Información',
        ],
        'confirm' => [
            'type' => Dialog::TYPE_DANGER,
            'title' => 'Confirmación',
            'btnOKClass' => 'btn-danger',
            'btnOKLabel' => '<span class="glyphicon glyphicon-remove"></span> ' . 'Borrar',
            'btnCancelLabel' => '<span class="' . Dialog::ICON_CANCEL . '"></span> ' . 'Cancelar'
        ],
    ],
]); ?>

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
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
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
                            &nbsp;<?= Html::a('' . UtilHelper::mostrarCorto(Html::encode($nombre), 20), ['/posts/index'], [
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
                        <?= UtilHelper::glyphicon('comment') ?>
                        <!-- 0 Comentarios -->
                        <?= Html::a('0 Comentarios',
                        ["posts/$model->id" . '#disqus_thread'],
                        ['data-disqus-identifier' => "post$model->id"]) ?>
                        <?= CommentsCount::widget([
                            'shortname' => 'artika',
                            'identifier' => "post$model->id",
                        ]) ?>
                    </div>
                </div>
                <hr>
                <h3>
                    <?= Html::a(Html::encode($model->titulo), ['view', 'id' => $model->id]) ?>
                </h3>
                <?= (new GithubMarkdown())->parse(Html::encode(
                    !$view ?
                    UtilHelper::mostrarCorto($model->contenido, 400) :
                    $model->contenido
                )) ?>
                <hr>
            </div>
            <div class="col-md-1  padding-0">
                <?= Html::a(
                    UtilHelper::glyphicon(
                        'pencil',
                        ['class' => 'btn btn-xs btn-success icon-xs']
                    ),
                    ['posts/update', 'id' => $model->id],
                    [
                        'class' => 'boton-editar icon-derecha',
                        'title' => 'Modificar post',
                    ]
                ) ?>
                <?= Html::a(
                    UtilHelper::glyphicon(
                        'remove',
                        ['class' => 'btn btn-xs btn-danger icon-xs']
                    ),
                    ['posts/delete', 'id' => $model->id],
                    [
                        'class' => 'boton-borrar icon-derecha',
                        'title' => 'Borrar post',
                        'data' => [
                            'confirm' => '¿Estás seguro de que quieres borrar este post?',
                            'method' => 'post',
                        ],
                    ]
                ) ?>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <?php if ($view): ?>
                    <?= Comments::widget([
                        'shortname' => 'artika',
                        'identifier' => "post$model->id",
                        ]) ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
