<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Collapse;

$title = 'Configuración';
$this->params['breadcrumbs'][] = $title;

$css = <<<EOT
    .panel-menu {
        margin-bottom: 5px;
    }
EOT;

$this->registerCss($css);

$accion = Yii::$app->controller->action->id;
?>
<div class="conf-cuenta">
    <div class="row">
        <div class="col-md-3">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'Collapsible Group Item #1',
                        'content' => 'Anim pariatur cliche...',
                        'options' => [
                            'class' => 'panel-primary',
                        ],
                    ],
                ],
                'options' => [
                    'class' => 'panel-menu',
                ],
            ]); ?>
        </div>
        <div class="col-md-9">

        </div>
    </div>
</div>
