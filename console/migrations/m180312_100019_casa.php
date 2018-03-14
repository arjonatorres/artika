<?php

use yii\db\Migration;

/**
 * Class m180312_100019_casa
 */
class m180312_100019_casa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('secciones', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull(),
            'usuario_id' => $this->bigInteger()->notNull(),
            'UNIQUE (nombre, usuario_id)',
        ]);

        $this->addForeignKey(
            'fk_secciones_usuarios_id',
            'secciones',
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
        $this->dropTable('secciones');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180312_100019_casa cannot be reverted.\n";

        return false;
    }
    */
}
