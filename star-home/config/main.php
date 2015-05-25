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
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'mailer' => [
                'sender'                => 'test@yincart.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],
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
            'class' =>'home\modules\member\Module',
        ]
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
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                    '@app/views'=>'@theme/star/home/',
                    '@star/blog/views/home'=>'@theme/star/home/views/blog',
                    '@star/catalog/views/home'=>'@theme/star/home/modules/catalog',
                    '@app/blog/widgets/home/views'=>'@theme/star/home/views/blog/widgets',
                    '@app/modules/member/views'=>'@theme/star/home/modules/member',
                ],
                'baseUrl'=>'@theme/star/home'
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
