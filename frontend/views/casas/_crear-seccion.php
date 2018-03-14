<?php

$title = 'Secciones';
$this->params['breadcrumbs'][] = $title;

?>
<div class="panel panel-primary panel-principal">
    <div class="panel-heading panel-heading-principal">
        <h3 class="panel-title">Añadir sección a la casa</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="/imagenes/plano_casa.png" alt="">
            </div>
            <div class="col-md-9">
                <h4><b>Para añadir secciones y habitaciones</b></h4>
                <p>Para añadir una sección escriba su nombre y haga click en Añadir.
                La nueva sección se añadirá a la lista de la izquierda.</p>
                <p>Una vez exista alguna sección podrá añadir una habitación asociada
                a ella. Escriba un nombre para la habitación, elija la sección a
                la que pertenece y haga click en Añadir.</p>
            </div>
        </div>
        <hr>
            <?= $this->render('_input-seccion', [
                    'model' => $model,
                ]);
            ?>
    </div>
</div>
