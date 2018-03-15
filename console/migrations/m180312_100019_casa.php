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
            'fk_secciones_usuarios',
            'secciones',
            'usuario_id',
            'usuarios',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('habitaciones', [
            'id' => $this->bigPrimaryKey(),
            'nombre' => $this->string(20)->notNull(),
            'seccion_id' => $this->bigInteger()->notNull(),
            'UNIQUE (nombre, seccion_id)',
        ]);

        $this->addForeignKey(
            'fk_habitaciones_secciones',
            'habitaciones',
            'seccion_id',
            'secciones',
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
        $this->dropTable('habitaciones');
    }
}
