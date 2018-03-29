<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@avatar' => '@frontend/web/imagenes/avatar',
        '@avatar_s3' => 'avatar',
        '@post' => '@frontend/web/imagenes/post',
        '@post_s3' => 'post',
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
            'rules' => [
                'mi-casa' => 'casas/mi-casa',
                'secciones' => 'casas/crear-seccion',
                'modulos' => 'modulos/create',
                'logs' => 'logs/index',
                'blog' => 'posts/index',
                'posts/<id:\d+>' => 'posts/view',
                'cuenta' => 'usuarios/mod-cuenta',
                'perfil' => 'usuarios/mod-perfil',
                'avatar' => 'usuarios/mod-avatar',
            ],
        ],
        'i18n' => [
            'translations' => [
                'kvmarkdown*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    # El archivo de traducciones se encuentra en:
                    # folder/to/project/common/messages
                    'basePath' => '@common/messages',
                    # Para el componente la variable sourceLanguage
                    # siempre debe estar por defecto 'en-US'
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        // 'app' => 'app.php',
                        'kvmarkdown' => 'kvmarkdown.php',
                        'app/error' => 'error.php',
                    ],
                ],

            ],
        ],
    ],
    'modules' => [
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],
    ],
];
