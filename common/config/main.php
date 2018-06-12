<?php
use kartik\datecontrol\Module;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@avatar' => '@frontend/web/imagenes/avatar',
        '@avatar_s3' => 'avatar',
        '@post' => '@frontend/web/imagenes/post',
        '@uploads' => '@frontend/web/uploads',
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
                'logs/<created_at:\d{2}-\d{2}-\d{4} a \d{2}-\d{2}-\d{4}>/<page:\d+>' => 'logs/index',
                'logs/<created_at:\d{2}-\d{2}-\d{4} a \d{2}-\d{2}-\d{4}>' => 'logs/index',
                'logs' => 'logs/index',
                'blog/<usuario:\w+>/<page:\d+>/<per-page:\d+>' => 'posts/index',
                'blog/<page:\d+>/<per-page:\d+>' => 'posts/index',
                'blog/<usuario:\w+>' => 'posts/index',
                'blog' => 'posts/index',
                'servidor' => 'servidores/index',
                'camaras' => 'camaras/index',
                'rutas' => 'rutas/index',
                'mensajes/nuevo' => 'mensajes/create',
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
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd-MM-yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            'displayTimezone' => 'Europe/Madrid',

            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ]
            // other settings
        ]
    ],
];
