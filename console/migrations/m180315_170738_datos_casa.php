<?php

use yii\db\Migration;

/**
 * Class m180315_170738_datos_casa
 */
class m180315_170738_datos_casa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('secciones', ['nombre', 'usuario_id'], [
            ['Planta Baja', 2],
            ['Planta Alta', 2],
            ['Patio', 2],
        ]);

        $this->batchInsert('habitaciones', ['nombre', 'seccion_id', 'icono_id'], [
            ['Cocina', 1, 13],
            ['Entradita', 1, 12],
            ['Salón', 1, 19],
            ['Dormitorio niños', 2, 4],
            ['Dormitorio principal', 2, 1],
            ['Garaje', 3, 18],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('secciones');
        $this->delete('habitaciones');
    }
}
