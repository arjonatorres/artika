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
            ['Interruptor'],
            ['Persiana'],
            ['Sensor'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('tipos');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180317_171120_datos_modulos cannot be reverted.\n";

        return false;
    }
    */
}
