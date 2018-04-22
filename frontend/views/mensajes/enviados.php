<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\MensajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensajes enviados';
$this->params['breadcrumbs'][] = $this->title;
$js = <<<JS
    $('#menu-principal-user').children('li.mensajes-dropdown').addClass('active');
JS;

$this->registerJs($js);
?>

<?= $this->render('_mensajes', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'recibidos' => false,
]) ?>
