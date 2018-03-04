<?php

$host = $username = $password = $dbname = '';

$url = parse_url(getenv('DATABASE_URL'));
if (isset($url['host']) && isset($url['user']) && isset($url['pass']) && isset($url['path'])) {
    $host = $url['host'];
    $username = $url['user'];
    $password = $url['pass'];
    $dbname = substr($url['path'], 1);
}

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=' . $host . ';dbname=' . $dbname,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'arjonatika@gmail.com',
                'password' => getenv('SMTP_PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
];
