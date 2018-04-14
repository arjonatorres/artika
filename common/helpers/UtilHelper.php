<?php

namespace common\helpers;

use Yii;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

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
     * Recorta un string a partir de los caracteres de logitud indicados
     * @param  string $cadena   La cadena a recortar
     * @param  int    $longitud La longitud a partir de la cual recortar
     * @return string           La cadena recortada
     */
    public static function mostrarCorto(string $cadena, int $longitud = 30): string
    {
        if (mb_strlen($cadena) > $longitud) {
            $cadena = mb_substr($cadena, 0, $longitud) . '...';
        }
        return $cadena;
    }

    /**
     * Devuelve un item de una sección del menú de la casa
     * @param  array  $seccion La sección
     * @return string          El item
     */
    public static function itemMenuCasa($seccion)
    {
        $id = $seccion->id;
        $nombre = $seccion->nombre;
        $habitaciones = '';
        $mod = Yii::$app->controller->action->id !== 'mi-casa';

        foreach ($seccion->getHabitaciones()->orderBy('id')->all() as $hab) {
            $habitaciones .= self::itemSecundarioCasa($hab, $mod);
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
                        . "<span id=\"it$id\">"
                        . Html::encode($nombre)
                        . '</span>'
                        . '</a>'
                        . ($mod ?
                        Html::a(
                            self::glyphicon(
                                'remove',
                                ['class' => 'btn btn-xs btn-danger icon-sm i']
                            ),
                            ['casas/borrar-seccion'],
                            ['class' => 'boton-borrar icon-derecha']
                        )
                        . Html::a(
                            self::glyphicon(
                                'pencil',
                                ['class' => 'btn btn-xs btn-success icon-sm']
                            ),
                            ['casas/modificar-seccion'],
                            ['class' => 'boton-editar icon-derecha']
                        ) : '')
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

    /**
     * Devuelve un item de una habitación para el menú
     * @param  string $item El modelo al cual pertenece el item
     * @param  bool   $mod Indica si se tienen que mostrar los botones de modificación
     * @param  string $den La denominación del modelo
     * @param  string $dir El directorio del icono
     * @return string      El item del modelo
     */
    public static function itemSecundarioCasa($item, $mod = true, $den = 'habitacion', $dir = '')
    {
        return "<li class=\"icono-nombre list-group-item\" data-id=\"$item->id\">"
        . Html::img("/imagenes/iconos/$dir{$item->icono_id}.png", [
            'id' => "it-$den-icono$item->id",
            'class' => 'img-xs img-circle',
        ])
        . "<span id=\"it-$den-nombre$item->id\"> "
        . (!$mod ?
            Html::a(
                Html::encode($item->nombre),
                "#$den-nombre$item->id"
            ): Html::encode($item->nombre))
        . '</span>'
        . ($mod ?
        Html::a(
            self::glyphicon(
                'remove',
                ['class' => 'btn btn-xs btn-default icon-sm secundario i', 'style' => 'color: #d9534f']
            ),
            [($den == 'modulo' ? 'modulos': 'casas') . "/borrar-$den"],
            ['class' => "boton-borrar-$den icon-derecha"]
        )
        . Html::a(
            self::glyphicon(
                'pencil',
                ['class' => 'btn btn-xs btn-default icon-sm secundario', 'style' => 'color: #5cb85c']
            ),
            [($den == 'modulo' ? 'modulos': 'casas') . "/modificar-$den"],
            ['class' => "boton-editar-$den icon-derecha"]
        ) : '')
        . '</li>';
    }

    /**
     * Devuelve un item de una habitación del menú de los módulos
     * @param  array  $habitacion Las habitación
     * @return string             El item
     */
    public static function itemMenuModulos($habitacion)
    {
        $id = $habitacion->id;
        $nombre = $habitacion->nombre;
        $modulos = '';
        $mod = Yii::$app->controller->action->id !== 'mi-casa';

        foreach ($habitacion->getModulos()->orderBy('id')->all() as $modulo) {
            $modulos .= self::itemSecundarioCasa($modulo, $mod, 'modulo', 'modulos/');
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
                    . '</h4>'
                . '</div>'
                . "<div id=\"p$id-collapse$id\" class=\"panel-collapse collapse in\" role=\"tabpanel\">"
                    . '<ul class="list-group">'
                    . $modulos
                    . '</ul>'
                . '</div>'
            . '</div>'
        . '</div>';
    }

    /**
     * Crea una array cuya clave es el id del modelo y el valor el nombre
     * @param  mixed $modelos El modelo
     * @return array          El array con el id y el nombre
     */
    public static function getDropDownList($modelos)
    {
        $s = ArrayHelper::toArray($modelos);
        $a = ArrayHelper::getColumn($s, 'id');
        $b = ArrayHelper::getColumn($s, 'nombre');
        return array_combine($a, $b);
    }

    /**
     * Envia un email
     * @param  string $archivo Archivo con el cuerpo del email
     * @param  array  $params  Array de parámetros pasados al archivo
     * @param  string $dest    Email de destino
     * @param  string $asunto  Asunto del email
     * @return bool            True si el email se ha enviado con éxito
     */
    public static function enviarMail($archivo, $params, $dest, $asunto)
    {
        return Yii::$app->mailer->compose(['html' => $archivo], $params)
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->setTo($dest)
            ->setSubject($asunto)
            ->send();
    }
}
