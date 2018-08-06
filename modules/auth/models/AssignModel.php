<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午3:01
 */
namespace star\auth\models;

use yii\base\Model;
use yii\rbac\DbManager;

class AssignModel extends Model{

    public $role_name;
    public $permissions;
    protected  $_permissions;


    public function rules()
    {
        return  [
            [['role_name'], 'required'],
            [['permissions'], 'string'],
        ];
    }

    /**
     * get all permissions from DB
     * @return array
     */
    public function getPermissions(){
        $auth = new DbManager();
        $auth->init();
        $permissions =  $auth->getPermissions();
        return $this->serializePermissions($permissions);
    }

    /**
     * serialize permissions
     * @param $permissions
     * @return array
     */
    public function serializePermissions($permissions){
        $permissionArray = [];
        foreach($permissions as $permission=>$v){
            $tmp = explode('_',$permission);
            $permissionArray[$tmp[0]][isset($tmp[1])? $tmp[1]: $tmp[0]] = isset($tmp[1])? $tmp[1]: $tmp[0];
        }
        $this->_permissions = $permissionArray;
        return $permissionArray;
    }

    /**
     * assign permissions to roles
     */
    public function save(){
        $permissions = $this->permissions;
        $auth = new DbManager();
        $auth->init();
        $role = $auth->getRole($this->role_name);
        $auth->removeChildren($role);
       foreach($this->_permissions as $key=>$value){
           if(isset($permissions[$key]) && is_array($permissions[$key]) ){
               foreach($permissions[$key] as $v){
                   if($key == $value[$v]){
                       $auth->addChild($role,$auth->getPermission($key));
                   }else{
                       $auth->addChild($role,$auth->getPermission($key.'_'.$value[$v]));
                   }
               }
           }
       }
    }

    /**
     * load permissions for selected
     * @return array
     */
    public function loadPermissions(){
        $auth = new DbManager();
        $auth->init();
        $children = $auth->getChildren($this->role_name);
        $dbPermissions = $this->serializePermissions($children);
        $selectedValue = [];
        foreach($dbPermissions as $key=>$value){
            $selectedValue[$key]=array_keys($value);
        }
        return $selectedValue;
    }
}