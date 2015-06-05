<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'cluster',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'cluster\controllers',
    'bootstrap' => ['log',[ 'home\models\UserEvent', 'frontendRegister'],'star\auth\bootstrap\Bootstrap'],
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
//        'admin' => [
//            'class' => 'mdm\admin\Module',
//            'layout' => 'left-menu', // default to null. other avaliable value 'right-menu' and 'top-menu'
//            'controllerMap' => [
//                'assignment' => [
//                    'class' => 'mdm\admin\controllers\AssignmentController',
//                    'userClassName' => 'dektrium\user\models\User',
//                    'idField' => 'id'
//                ]
//            ],
//            'menus' => [
//                'assignment' => [
//                    'label' => 'Grand Access' // change label
//                ],
//                'route' => null, // disable menu
//            ],
//            'mainLayout' => '@core/views/layouts/main.php',
//        ],
        'station' => [
            'class' => 'core\modules\station\Module',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'catalog' => [
            'class' => 'star\catalog\Module',
        ],
        'cart' => [
            'class' =>'cluster\modules\cart\Module',
        ],
        'order' => [
            'class' =>'star\order\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '[RANDOM KEY HERE]',
            'csrfParam' => '_frontendCSRF',
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
                    '@app/views'=>'@theme/star/cluster/',
                    '@star/catalog/views/home'=>'@theme/star/cluster/modules/catalog',
                    '@app/modules/member/views'=>'@theme/star/cluster/modules/member',
                    '@app/modules/cart/views'=>'@theme/star/cluster/modules/cart',
                ],
                'baseUrl'=>'@theme/star/cluster'
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
