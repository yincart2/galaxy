<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午12:30
 */
namespace star\auth\filters;

use yii\base\Controller;

class AccessRule extends \yii\filters\AccessRule{
    public $params = [];

    public function allows($action, $user, $request)
    {
        if ($this->matchActionAccess($action, $user, $request)) {
            return parent::allows($action, $user, $request);
        }
        return null;
    }

    /**
     * check the permission, if we rewrite and controller, the controller id and module id is not changed
     * @param \yii\base\Action $action
     * @param \yii\web\User $user
     * @param \yii\web\Request $request
     * @return bool
     */
    public function matchActionAccess($action, $user, $request)
    {
        if ($user->getIsGuest()) {
            return false;
        }

        if ($this->isAdmin()) {
            return true;
        }

        if ($action->controller instanceof Controller) {
            $key =  $action->controller->uniqueId . '_' . $action->id;
            return $user->can($key, $this->params);
        }
//        else {
//            $key = $action->getUniqueId();
//            $key = explode('/', $key);
//            array_shift($key);
//            $key = implode('_', $key);
//        }
//        $formatKey = lcfirst(implode('', array_map(function($k) { return ucfirst($k); }, explode('-', $key))));

    }

    public function isAdmin()
    {
        $roles = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
        return isset($roles['__admin__']);
    }
} 