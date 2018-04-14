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
        $this->batchInsert('tipos_pines', ['nombre'], [
            ['Salida'], ['Entrada'],
        ]);

        $this->batchInsert('tipos_modulos', ['nombre', 'tipo_pin_id'], [
            ['Interruptor', 1], ['Persiana', 1], ['Sensor temperatura', 2],
        ]);

        $this->batchInsert('pines', ['nombre', 'tipo_pin_id'], [
            ['A0', 2], ['A1', 2], ['A2', 2], ['A3', 2], ['A4', 2], ['A5', 2],
            ['D2', 1], ['D3', 1], ['D4', 1], ['D5', 1], ['D6', 1], ['D7', 1],
            ['D8', 1], ['D9', 1], ['D10', 1], ['D11', 1], ['D12', 1], ['D13', 1]
        ]);

        $this->batchInsert(
            'modulos',
            ['nombre', 'habitacion_id', 'tipo_modulo_id', 'icono_id', 'pin1_id', 'pin2_id'],
            [
                ['Horno', 1, 1, 6, 7, null],
                ['Tostador', 1, 1, 9, 8, null],
                ['Lamparita', 2, 1, 1, 9, null],
                ['Televisión', 3, 1, 10, 10, null],
                // ['Luz lectura', 3, 1, 4, 11, null],
                ['Aire acondicionado', 3, 1, 3, 12, null],
                ['Persiana', 3, 2, 2, 13, 14],
                ['Radio', 4, 1, 11, 15, null],
                ['Ventilador techo', 5, 1, 8, 16, null],
                // ['Aire acondicionado', 5, 1, 3, 17, null],
                ['Enchufe', 6, 1, 16, 18, null],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('tipos_modulos');
        $this->delete('tipos_pines');
        $this->delete('pines');
        $this->delete('modulos');
    }
}
