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
    'bootstrap' => ['log'],
    'controllerNamespace' => 'merchant\controllers',
    'modules' => [
        'site' => [
            'class' => 'merchant\modules\site\Module',
        ],
//        'user' => [
//            'class' => 'dektrium\user\Module',
//            'controllerMap' => [
//                'login' => 'app\modules\site\controllers\LoginController'
//            ],
//        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/site/login/index'],
        ],
        'view' => [
//            'theme' => [
//                'pathMap' => [
////                    '@app/views' => '@theme/merchant/ultra',
////                    '@star/blog/views/lab' => '@theme/merchant/ultra/modules/blog/views',
////                    '@star/blog/widgets/lab/views' => '@theme/merchant/ultra/modules/blog/views/widgets',
////                    '@star/portfolio/views/lab' => '@theme/merchant/ultra/modules/portfolio/views',
////                    '@star/task/views/lab' => '@theme/merchant/ultra/modules/task/views',
////                    '@star/catalog/views/lab' => '@theme/merchant/ultra/modules/catalog/views',
////                    '@app/modules' => '@theme/merchant/ultra/modules',
////                    '@dektrium/user/views' => '@theme/merchant/ultra/modules/user/views'
//                ],
////                'baseUrl' => '@theme/merchant/ultra',
//            ],
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
            'errorAction' => 'site/default/error',
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
//        ],
    ],
    'params' => $params,
];
