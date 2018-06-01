<?php

use yii\db\Migration;

/**
 * Class m180530_191911_camaras
 */
class m180530_191911_camaras extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('camaras', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull()->unique(),
            'url' => $this->string(255)->notNull(),
            'puerto' => $this->integer()->notNull(),
            'usuario_id' => $this->bigInteger()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_camaras_usuarios_id',
            'camaras',
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
        $this->dropTable('camaras');
    }
}
