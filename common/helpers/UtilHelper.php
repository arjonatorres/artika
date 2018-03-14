<?php

namespace common\helpers;

use yii\helpers\Html;

/**
 * Clase Helper
 */
class UtilHelper
{
    /**
     * Crea un item en el menú principal, con el texto y el icono de Boostrap
     * centrados.
     * @param  string $texto El texto del item
     * @param  string $icon  El nombre del icono de Boostrap
     * @param  string $url   La url del item
     * @return string        El código Html con el item
     */
    public static function menuItem(string $texto, string $icon, string $url)
    {
        return [
            'label' =>  '<div class="text-center">'
                . UtilHelper::glyphicon($icon)
                . '</div>'
                . '<div class="text-center">'
                . $texto
                . '</div>',
            'url' => [$url],
            'encode' => false,
            'options' => [
                'class' => 'menu-item-principal',
            ],
        ];

        return '<div class="text-center">'
            . UtilHelper::glyphicon($icon)
            . '</div>'
            . '<div class="text-center">'
            . $texto
            . '</div>';
    }

    /**
     * Crea un icono de Bootstrap.
     * @param  string $icon  Nombre del icono de Bootstrap
     * @param  string $class Nombre de la clase a añadir
     * @return string        La etiqueta span con el icono de Bootstrap.
     */
    public static function glyphicon(string $icon, string $class = '')
    {
        return Html::tag(
            'span',
            '',
            ['class' => "glyphicon glyphicon-$icon $class"]
        );
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

    /**
     * Recorta un string a partir de 30 caracteres de logitud
     * @param  string $cadena La cadena a recortar
     * @return string         La cadena recortada
     */
    public static function mostrarCorto(string $cadena): string
    {
        if (mb_strlen($cadena) > 30) {
            $cadena = mb_substr($cadena, 0, 30) . '...';
        }
        return $cadena;
    }
}
