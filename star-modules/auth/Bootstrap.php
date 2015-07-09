<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午1:54
 */

namespace star\auth;

use matter\base\BaseBootstrap;
use matter\base\BaseModule;
use yii\filters\AccessControl;

class Bootstrap extends BaseBootstrap
{

    public  $_modelMap = [
        'AssignModel' => 'star\auth\models\AssignModel',
        'RoleModel' => 'star\auth\models\RoleModel',
    ];

    public $settingCode = 'system_module_auth';

    public function bootstrap($app){
        parent::bootstrap($app);

        if ($app->hasModule($this->_moduleName) && ($module = $app->getModule($this->_moduleName)) instanceof BaseModule) {
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
} 