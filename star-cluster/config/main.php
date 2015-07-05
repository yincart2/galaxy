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
    'bootstrap' => ['log','matter\Gravitation',[ 'cluster\models\Events', 'attachEvents']],
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
        'catalog' => [
            'class' => 'star\catalog\Module',
        ],
        'cart' => [
            'class' =>'star\cart\Module',
            'modelMap' => [
                'ShoppingCart' =>'cluster\modules\cart\models\ShoppingCart'
            ]
        ],
        'order' => [
            'class' =>'star\order\Module',
        ],
        'member' => [
            'class' =>'star\member\Module',
        ],
        'marketing' => [
            'class' =>'star\marketing\Module',
        ],
        'account' =>[
            'class' =>'star\account\Module',
        ],
        'refund' =>[
            'class' =>'star\refund\Module',
        ]
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
                    '@app/views'=>'@theme/cluster/default/',
                    '@star/catalog/views/home'=>'@theme/cluster/default/modules/catalog',
                    '@star/member/views'=>'@theme/cluster/default/modules/member',
                    '@star/cart/views'=>'@theme/cluster/default/modules/cart',
                    '@star/account/views/home'=>'@theme/cluster/default/modules/account',
                    '@star/order/views/home'=>'@theme/cluster/default/modules/order',
                    '@star/refund/views/home'=>'@theme/cluster/default/modules/refund',
                ],
                'baseUrl'=>'@theme/cluster/default'
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
