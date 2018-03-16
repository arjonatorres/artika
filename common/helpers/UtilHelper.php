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
                . self::glyphicon($icon)
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
    }

    /**
     * Crea un icono de Bootstrap.
     * @param  string $icon   Nombre del icono de Bootstrap
     * @param  array $options Array de opciones del icono
     * @return string         La etiqueta span con el icono de Bootstrap.
     */
    public static function glyphicon(string $icon, array $options = [])
    {
        if (isset($options['class'])) {
            $options ['class'] .= " glyphicon glyphicon-$icon";
        } else {
            $options ['class'] = "glyphicon glyphicon-$icon";
        }
        return Html::tag(
            'span',
            '',
            $options
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

    /**
     * Devuelve un item de una sección del menú de la casa
     * @param  array  $seccion El array con todas las secciones
     * @return string          El item
     */
    public static function itemMenuCasa($seccion)
    {
        $id = $seccion->id;
        $nombre = $seccion->nombre;
        $habitaciones = '';
        foreach ($seccion->habitaciones as $hab) {
            $habitaciones .= self::itemHabCasa($hab->nombre);
        }
        return "<div id=\"p$id\" data-id=\"$id\" class=\"panel-seccion panel-group\" role=\"tablist\">"
            . '<div class="panel panel-default">'
                . '<div class="panel-heading" role="tab">'
                    . '<h4 class="panel-title">'
                        . "<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#p$id\" href=\"#p$id-collapse$id\" aria-expanded=\"true\" aria-controls=\"p$id-collapse$id\">"
                        . self::glyphicon(
                            'chevron-down',
                            ['class' => 'chev icon-xs d']
                        )
                        . "<span id=\"it$id\">" . Html::encode($nombre) . '</span>'
                        . '</a>'
                        . Html::a(
                            self::glyphicon(
                                'remove',
                                ['class' => 'icon-sm i']
                            ),
                            ['casas/borrar-seccion'],
                            ['class' => 'boton-borrar icon-derecha']
                        )
                        . Html::a(
                            self::glyphicon(
                                'pencil',
                                ['class' => 'icon-sm d']
                            ),
                            ['casas/modificar-seccion'],
                            ['class' => 'boton-editar icon-derecha']
                        )
                    . '</h4>'
                . '</div>'
                . "<div id=\"p$id-collapse$id\" class=\"panel-collapse collapse in\" role=\"tabpanel\">"
                    . '<ul class="list-group">'
                    . $habitaciones
                    . '</ul>'
                . '</div>'
            . '</div>'
        . '</div>';
    }

    public static function itemHabCasa($nombre)
    {
        return "<li class=\"list-group-item\">$nombre</li>";
    }
}
