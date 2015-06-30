<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午1:54
 */

namespace star\auth;

use matter\base\BaseBootstrap;
use yii\filters\AccessControl;

class Bootstrap extends BaseBootstrap
{

    public  $_modelMap = [
        'AssignModel' => 'star\auth\models\AssignModel',
        'RoleModel' => 'star\auth\models\RoleModel',
    ];


    public function bootstrap($app){

        parent::bootstrap($app);
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