<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午12:30
 */
namespace star\auth\filters;

use yii\base\Controller;
use yii\helpers\StringHelper;

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
        if ($this->isAdmin()) {
            return true;
        }

        if ($action->controller instanceof Controller) {
            $key = get_class($action->controller) . '_' . $action->id;
            $keys = explode('-', $key);
            $keys = array_map(function($v) { return ucfirst($v); }, $keys);
            $key = implode($keys);
            if(\Yii::$app->authManager->getPermission($key)){
                return $user->can($key, $this->params);
            }else{
                return true;
            }
        }
    }

    public function isAdmin()
    {
        return (\Yii::$app->user->id==1);
    }

} 