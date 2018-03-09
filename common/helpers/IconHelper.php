<?php

namespace common\helpers;

use yii\helpers\Html;

/**
 * Clase Helper relacionada con iconos
 */
class IconHelper
{
    /**
     * Crea un icono de Bootstrap.
     * @param  string $icon  Nombre del icono de Bootstrap
     * @return string        La etiqueta span con el icono de Bootstrap.
     */
    public static function glyphicon(string $icon)
    {
        return Html::tag('span', '', ['class' => "glyphicon glyphicon-$icon"]);
    }

    /**
     * Devuelve un template para colocar un icono de Bootstrap en un campo
     * de ActiveForm.
     * @param  string $glyphicon Nombre del icono de Bootstrap
     * @return string            La cadena del template
     */
    public static function inputGlyphicon($glyphicon)
    {
        return '<div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-' . $glyphicon . '"></span>
                    </span>
                    {input}
               </div>';
    }
}
