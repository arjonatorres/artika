<?php

use yii\db\Migration;

/**
 * Class m180324_174710_logs
 */
class m180324_174710_logs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('logs', [
            'id' => $this->bigPrimaryKey(),
            'descripcion' => $this->string(255)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'usuario_id' => $this->bigInteger()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_logs_usuarios',
            'logs',
            'usuario_id',
            'usuarios',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('logs');
    }
}
