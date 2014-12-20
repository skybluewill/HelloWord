<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
