<?php
return [
    'bootstrap' => ['gii'],
    'controllerMap' => [
        'heroku' => [
            'class' => 'purrweb\heroku\HerokuGeneratorController',
        ],
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
];
