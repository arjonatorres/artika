<?php

use yii\db\Migration;

/**
 * Class m180317_171120_datos_modulos
 */
class m180317_171120_datos_modulos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('tipos', ['nombre'], [
            ['Interruptor'], ['Persiana'], ['Sensor'],
        ]);

        $this->batchInsert(
            'modulos',
            ['nombre', 'habitacion_id', 'tipo_id', 'icono_id'],
            [
                ['Horno', 1, 1, 6],
                ['Tostador', 1, 1, 9],
                ['Lamparita', 2, 1, 1],
                ['Televisión', 3, 1, 10],
                ['Luz lectura', 3, 1, 4],
                ['Aire acondicionado', 3, 1, 3],
                ['Aire 2', 3, 1, 3],
                ['Radio', 4, 1, 11],
                ['Ventilador techo', 5, 1, 8],
                ['Aire acondicionado', 5, 1, 3],
                ['Enchufe', 6, 1, 16],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('tipos');
    }
}
