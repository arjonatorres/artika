<?php

use yii\db\Migration;

/**
 * Class m180317_170405_modulos
 */
class m180317_170405_modulos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tipos', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull()->unique(),
        ]);

        $this->createTable('modulos', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull(),
            'habitacion_id' => $this->bigInteger()->notNull(),
            'tipo_id' => $this->bigInteger()->notNull(),
            'icono_id' => $this->integer()->notNull()->defaultValue(1),
            'estado' => $this->integer()->notNull()->defaultValue(0),
            'UNIQUE (nombre, habitacion_id)',
        ]);

        $this->addForeignKey(
            'fk_modulos_habitaciones',
            'modulos',
            'habitacion_id',
            'habitaciones',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_modulos_tipos',
            'modulos',
            'tipo_id',
            'tipos',
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
        $this->dropTable('modulos');
        $this->dropTable('tipos');
    }
}
