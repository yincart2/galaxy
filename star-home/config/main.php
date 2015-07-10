<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'star-home',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'home\controllers',
    'layout'=>'/main',
    'bootstrap' => ['log',[ 'home\models\UserEvent', 'frontendRegister'],'matter\Gravitation',],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableConfirmation' => false
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
        'member' => [
            'class' =>'star\member\Module',
        ],
        'blog' => [
            'class' => 'star\blog\Module',
        ],
        'cart' => [
            'class' =>'star\cart\Module',
        ],
        'order' => [
            'class' =>'star\order\Module',
        ],
        'shipment' => [
            'class' =>'star\shipment\Module',
        ],
        'payment' => [
            'class' =>'star\payment\Module',
        ],
        'refund' =>[
            'class' =>'star\refund\Module',
        ]
    ],
    'components' => [
        'urlManager'=>[
            'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
            ]
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '[RANDOM KEY HERE]',
            'csrfParam' => '_frontendCSRF',
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
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                    '@app/views'=>'@theme/home/default/',
                    '@star'=>'@theme/home/default/modules',
                ],
                'baseUrl'=>'@theme/home/default'
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
    'params' => $params,
];
