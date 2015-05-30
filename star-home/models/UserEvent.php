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

class UserEvent
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

    /**
     * when user login in backend , it should be 'Administrator' or ,'Merchant'
     */
    public static  function beforeLogin()
    {
        Event::on(\yii\web\User::className(), \yii\web\User::EVENT_BEFORE_LOGIN, function($event) {
            $user = $event->identity;
            $auth = new DbManager();
            $auth->init();
            $role = $auth->getRolesByUser($user->id);
            $event->isValid = in_array(current($role)->name,['Administrator','Merchant']);
        });
    }
} 