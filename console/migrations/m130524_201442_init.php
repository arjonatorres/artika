<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('usuarios', [
            'id' => $this->bigprimaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'auth_key' => $this->string(255)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255)->unique(),
            'email' => $this->string(255)->notNull()->unique(),

            'token_val' => $this->string(255)->unique(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ], $tableOptions);

        $this->createTable('generos', [
            'id'=> $this->bigPrimaryKey(),
            'denominacion'=> $this->string(255)->notNull()->unique(),
        ], $tableOptions);

        $this->createTable('perfiles', [
            'id'=> $this->bigPrimaryKey(),
            'usuario_id' => $this->bigInteger()->notNull()->unique(),
            'nombre_apellidos' => $this->string(255),
            'genero_id' => $this->bigInteger(),
            'direccion' => $this->string(255),
            'ciudad' => $this->string(255),
            'provincia' => $this->string(255),
            'pais'=>$this->string(255),
            'cpostal' => $this->char(5),
            'fecha_nac'=>$this->date(),
            'updated_at' => $this->datetime(),
            ], $tableOptions);

            $this->addForeignKey(
                'fk_perfiles_generos',
                'perfiles',
                'genero_id',
                'generos',
                'id',
                'CASCADE'
            );

            $this->addForeignKey(
                'fk_perfiles_usuarios',
                'perfiles',
                'usuario_id',
                'usuarios',
                'id',
                'CASCADE'
            );
    }

    public function down()
    {
        $this->dropTable('usuarios');
    }
}
