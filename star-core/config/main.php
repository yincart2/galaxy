<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'core',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'core\controllers',
    'bootstrap' => ['log','matter\Gravitation',['home\models\UserEvent', 'beforeLogin']],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // default to null. other avaliable value 'right-menu' and 'top-menu'
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    'idField' => 'id'
                ]
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => null, // disable menu
            ],
            'mainLayout' => '@core/views/layouts/main.php',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableRegistration' => false,
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
        'station' => [
            'class' => 'core\modules\station\Module',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'catalog' => [
            'class' => 'star\catalog\Module',
        ],
        'blog' => [
            'class' => 'star\blog\Module',
        ],
        'order' => [
            'class' => 'star\order\Module',
        ],
        'marketing' => [
            'class' => 'star\marketing\Module',
        ],
        'account' => [
            'class' => 'star\account\Module',
        ],
        'refund' => [
            'class' =>'star\refund\Module',
        ],
        'shipment' => [
            'class' =>'star\shipment\Module',
        ],
        'payment' => [
            'class' =>'star\payment\Module',
        ],
        'system' => [
            'class' =>'star\system\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'rbac-admin' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/mdmsoft/yii2-admin/messages',
                    'sourceLanguage' => 'en',
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@core/views' => '@theme/core/default/',
                ],
                'baseUrl' => '@theme/core/default/'
            ]
        ]
    ],
//    'as access' => [
//        'class' => 'mdm\admin\components\AccessControl',
//        'allowActions' => [
//            'site/index',
//            'user/registration/register',
//            'user/security/login',
//            'site/error',
//            'gii',
//        ]
//    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl' => 'http://localhost/galaxy/star-image',
                    'basePath' => '@image',
                    'path' => '/',
                    'name' => 'Images',
                    'access' => ['read' => '*', 'write' => false]
                ],
            ]
        ],
    ],
    'params' => $params,
];
