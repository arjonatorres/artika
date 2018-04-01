<?php

use yii\db\Migration;

/**
 * Class m180329_180615_mensajes
 */
class m180329_180615_mensajes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mensajes', [
            'id' => $this->bigPrimaryKey(),
            'asunto' => $this->string(255)->notNull(),
            'contenido' => $this->string(10000)->notNull(),
            'remitente_id' => $this->bigInteger()->notNull(),
            'destinatario_id' => $this->bigInteger()->notNull(),
            'estado_rem' => $this->smallInteger()->notNull()->defaultValue(0),
            'estado_dest' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->datetime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_mensajes_remitente_id',
            'mensajes',
            'remitente_id',
            'usuarios_id',
            'id',
            'NO ACTION',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_mensajes_destinatario_id',
            'mensajes',
            'destinatario_id',
            'usuarios_id',
            'id',
            'NO ACTION',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('mensajes');
    }
}
