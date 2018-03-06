<?php

namespace console\controllers;

use yii\console\ExitCode;
use yii\console\Controller;

use common\models\Usuarios;

/**
 * Comandos de mantenimiento relacionados con los usuarios
 */
class UsuariosController extends Controller
{
    /**
     * Elimina los usuarios que llevan más de $dias horas sin validarse
     * @param mixed $dias BlaBlaBla
     */
    public function actionLimpiar($dias = 1)
    {
        $ahora = date('Y-m-d H:i:s');
        $res = Usuarios::deleteAll(
            "token_val IS NOT NULL AND '$ahora' - created_at >= :dias::interval",
            [
                'dias' => "P{$dias}D",
            ]
        );
        echo "Se han eliminado $res usuarios.\n";
        return ExitCode::OK;
    }
}
