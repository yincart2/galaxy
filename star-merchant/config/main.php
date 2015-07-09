<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'star-merchant',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'merchant\controllers',
    'layout' => '/main',
    'bootstrap' => ['log', ['home\models\UserEvent', 'beforeLogin'], 'matter\Gravitation',],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableRegistration' => false,
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'catalog' => [
            'class' => 'star\catalog\Module',
        ],
        'core' => [
            'class' => 'home\modules\core\Module',
        ],
        'auth' => [
            'class' => 'star\auth\Module',
        ],
        'order' => [
            'class' => 'star\order\Module',
        ],
        'payment' => [
            'class' => 'star\payment\Module',
        ],
        'system' => [
            'class' => 'star\system\Module',
        ],
        'shipment' => [
            'class' => 'star\shipment\Module',
        ],
    ],
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
            'enablePrettyUrl' => false,
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser', // unique for backend
            ]
        ],
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '[DIFFERENT UNIQUE KEY]',
            'csrfParam' => '_backendCSRF',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
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
                    '@merchant/views' => '@theme/merchant/ultra',
                    '@star' => '@theme/merchant/ultra/modules',
                ],
                'baseUrl' => '@theme/merchant'
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
