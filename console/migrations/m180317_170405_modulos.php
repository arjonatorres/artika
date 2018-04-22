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
        $this->createTable('tipos_pines', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull()->unique(),
        ]);

        $this->createTable('tipos_modulos', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull()->unique(),
            'tipo_pin_id' => $this->bigInteger()->notNull(),
        ]);

        $this->createTable('modulos', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull(),
            'habitacion_id' => $this->bigInteger()->notNull(),
            'tipo_modulo_id' => $this->bigInteger()->notNull(),
            'icono_id' => $this->integer()->notNull()->defaultValue(1),
            'estado' => $this->integer()->notNull()->defaultValue(0),
            'pin1_id' => $this->bigInteger()->notNull(),
            'pin2_id' => $this->bigInteger(),
            'UNIQUE (nombre, habitacion_id)',
        ]);

        $this->createTable('pines', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull()->unique(),
            'tipo_pin_id' => $this->bigInteger()->notNull(),
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
            'fk_modulos_tipos_modulos',
            'modulos',
            'tipo_modulo_id',
            'tipos_modulos',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_pines_tipos_pines',
            'pines',
            'tipo_pin_id',
            'tipos_pines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_tipos_modulos_tipos_pines',
            'tipos_modulos',
            'tipo_pin_id',
            'tipos_pines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_modulos_pines1',
            'modulos',
            'pin1_id',
            'pines',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_modulos_pines2',
            'modulos',
            'pin2_id',
            'pines',
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
        $this->dropTable('pines');
        $this->dropTable('tipos_modulos');
        $this->dropTable('tipos_pines');
    }
}
