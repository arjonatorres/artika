<?php

use yii\db\Migration;

/**
 * Class m180326_092146_posts
 */
class m180326_092146_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->bigPrimaryKey(),
            'titulo' => $this->string(255)->notNull()->unique(),
            'contenido' => $this->string(10000)->notNull(),
            'usuario_id' => $this->bigInteger()->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk_posts_usuarios_id',
            'posts',
            'usuario_id',
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
        $this->dropTable('posts');
    }
}
