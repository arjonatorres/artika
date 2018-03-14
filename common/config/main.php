<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@avatar' => '@frontend/web/avatar',
        '@avatar_s3' => 'avatar',
    ],
    'name' => 'ArTiKa',
    'language' => 'es-ES',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        's3' => [
            'class' => 'frostealth\yii2\aws\s3\Service',
            'credentials' => [ // Aws\Credentials\CredentialsInterface|array|callable
                'key' => getenv('AWS_KEY'),
                'secret' => getenv('AWS_SECRET'),
            ],
            'region' => 'eu-west-3',
            'defaultBucket' => 'artika',
            'defaultAcl' => 'public-read',
        ],
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => getenv('GMAPS_KEY'),
                        'language' => 'es',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'rules' => [
            // ],
        ],
    ],
];
