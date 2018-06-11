<?php
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'pgsql:host=localhost;dbname=artika_test',
                'username' => 'artika',
                'password' => 'artika',
                'charset' => 'utf8',
            ],
        ],
    ]
);
