<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-26
 * Time: 下午6:50
 */

namespace home\models;

use dektrium\user\models\User;
use yii\base\Event;
use yii\rbac\DbManager;

class RegisterEvent
{

    /**
     * the register customer will be added  'customer' role
     */
    public static  function frontendRegister()
    {
        Event::on(User::className(), User::USER_REGISTER_DONE, function($event) {
            /** @var \yii\base\ModelEvent $event */
            $user = $event->sender;
            $auth = new DbManager();
            $auth->init();
            $role = $auth->getRole('Customer');
            if(!$role){
                $role = $auth->createRole('Customer');
                $auth->add($role);
            }

            $auth->assign($role, $user->id);
        });
    }

    public static  function backendRegister()
    {
        Event::on(User::className(), User::USER_REGISTER_DONE, function() {

        });
    }
} 