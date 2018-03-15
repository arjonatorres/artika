<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\dialog\Dialog;

use common\helpers\UtilHelper;
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

<?php

$urlModificarSeccion = Url::to(['casas/modificar-seccion']);
$js = <<<EOL
    $('.boton-borrar').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var enlace = $(this);
        var panelPropio = enlace.closest('.panel-seccion');
        var seccionId = panelPropio.data('id');
        var nombre = (enlace.closest('h4').text()).trim();
        krajeeDialog.confirm('¿Estás seguro que quieres borrar la sección "'
            + nombre +
            '" y todo el contenido que tiene dentro?', function (result) {
            if (result) {
                $.ajax({
                    url: enlace.attr('href') + '?id=' + seccionId,
                    type: 'POST',
                    data: {},
                    success: function(data) {
                        if (data) {
                            panelPropio.remove();
                        } else {
                            krajeeDialog.alert('No se ha podido borrar la sección.');
                        }
                    }
                });
            }
        });
    });
    $('.boton-editar').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var seccionId = $(this).closest('.panel-seccion').data('id');
        $.ajax({
            url: $(this).attr('href') + '?id=' + seccionId,
            type: 'GET',
            data: {},
            success: function(data) {
                $('#casa-usuario').html(data);
            }
        });
    });
EOL;

$this->registerJs($js);
?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Casa</h3>
    </div>
    <div class="panel-body panel-body-principal">
        <?php foreach ($secciones as $key => $seccion): ?>
            <?= UtilHelper::itemMenuCasa($seccion->id, $seccion->nombre) ?>
        <?php endforeach ?>
    </div>
</div>
