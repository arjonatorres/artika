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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('secciones');
    }
}
