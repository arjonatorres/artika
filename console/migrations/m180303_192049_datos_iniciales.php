<?php

use yii\db\Migration;

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
        $this->batchInsert('usuarios', ['username', 'email', 'password_hash', 'auth_key'], [
            ['admin', 'arjonatika@gmail.com',
                Yii::$app->security->generatePasswordHash(getenv('ADMIN_PASS')),
                Yii::$app->security->generateRandomString(),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('usuarios');
    }
}
