<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午1:54
 */

namespace star\auth\bootstrap;

use yii\base\BootstrapInterface;
use yii\filters\AccessControl;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app){
        $accessControl = [
            'class' => AccessControl::className(),
            'rules' => [
                // deny all POST requests
                [
                    'class' => 'star\auth\filters\AccessRule',
                    'allow' => true,
                ],
            ],
        ];

        \Yii::$app->attachBehavior('accessControl', $accessControl);

    }
} 