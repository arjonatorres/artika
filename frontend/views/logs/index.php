<?php
use yii\grid\GridView;

use common\helpers\UtilHelper;

/* @var $this yii\web\View */
?>

<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">
            <?= UtilHelper::glyphicon('th-large', ['class' => 'icon-sm']) ?>
             Logs
         </h3>
    </div>
    <div class="panel-body panel-body-gris">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="/imagenes/logs.png" alt="" style="padding-top: 10px">
            </div>
            <div class="col-md-9">
                <p>Selecciona el rango de fechas para una búsqueda más específica:</p>
                <?= $this->render('_search', ['model' => $searchModel]) ?>
            </div>
        </div>
        <hr>
        <div class="col-md-10 col-md-offset-1">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'descripcion',
                    'created_at:datetime',
                ],
            ]); ?>
        </div>
    </div>
</div>
