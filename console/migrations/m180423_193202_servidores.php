<?php

use yii\db\Migration;

/**
 * Class m180423_193202_servidores
 */
class m180423_193202_servidores extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('servidores', [
            'id' => $this->bigPrimaryKey(),
            'url' => $this->string(255)->notNull(),
            'puerto' => $this->smallInteger()->notNull(),
            'token_val' => $this->string(255)->notNull(),
            'usuario_id' => $this->bigInteger()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_servidores_usuarios_id',
            'servidores',
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
        $this->dropTable('servidores');
    }
}
