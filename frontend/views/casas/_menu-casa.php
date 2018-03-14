<?php

use yii\helpers\Url;
use yii\helpers\Html;

use common\helpers\UtilHelper;

$urlModificarSeccion = Url::to(['casas/modificar-seccion']);
$js = <<<EOL
    $('.icon-derecha').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var seccionId =$(this).data('id');
        $.ajax({
            url: '$urlModificarSeccion',
            type: 'GET',
            data: {
                id: seccionId
            },
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
            <div id="p<?= $key ?>" class="panel-seccion panel-group" role="tablist">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#p<?= $key ?>" href="#p<?= $key ?>-collapse<?= $key ?>" aria-expanded="false" aria-controls="p<?= $key ?>-collapse<?= $key ?>">
                              <?= UtilHelper::glyphicon('chevron-right', 'icon-xs d') ?>
                              <?= Html::encode($seccion->nombre) ?>
                              <span data-id="<?= $seccion->id ?>" class="text-right icon-derecha">
                                  <?= UtilHelper::glyphicon('pencil', 'icon-sm') ?>
                              </span>
                            </a>
                        </h4>
                    </div>
                    <div id="p<?= $key ?>-collapse<?= $key ?>" class="panel-collapse collapse" role="tabpanel">
                        <ul class="list-group">
                            <!-- <li class="list-group-item"></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
