<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123456',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => true,
            'enablePrettyUrl' => true,
            'suffix' => '.html',
            //'urlFormat' => 'path',
            'routeParam' =>'t',
            'rules' => [
                    'sites' => 'site/index',
                    'post/<id:\d+>' => 'site/about',
                    'site'  => 'site/about',
                    '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' 
                        => '<controller>/<action>',
                    'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
                    'http://<user:\w+>.digpage.com/<lang:\w+>/profile' => 'user/profile',
                ]
        ],
        
        'view' => [
            'theme' => require(__DIR__.'/theme.php'),
            
            ],
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
