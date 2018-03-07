<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Class m180303_192049_datos_iniciales
 */
class m180303_192049_datos_iniciales extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('usuarios_id', []);
        $this->insert('usuarios_id', []);

        $this->batchInsert('usuarios', ['id', 'username', 'email', 'password_hash', 'auth_key', 'created_at'], [
            [
                1,
                'admin',
                'arjonatika@gmail.com',
                Yii::$app->security->generatePasswordHash(getenv('ADMIN_PASS')),
                Yii::$app->security->generateRandomString(), date('Y-m-d H:i:s')
            ],
            [
                2,
                'jose',
                'arjonatorres79@gmail.com',
                Yii::$app->security->generatePasswordHash('jose1234'),
                Yii::$app->security->generateRandomString(), date('Y-m-d H:i:s')
            ],
        ]);

        $this->batchInsert('perfiles', ['usuario_id'], [[1], [2]]);

        $this->batchInsert('generos', ['denominacion'], [['Hombre'], ['Mujer']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('usuarios');
        $this->delete('generos');
    }
}
