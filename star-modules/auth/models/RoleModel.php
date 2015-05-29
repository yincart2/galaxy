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

class RoleModel extends Model{
    /**
     * @var string the controller class name
     */
    public $controllerClass;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return  [
            [['controllerClass'], 'filter', 'filter' => 'trim'],
            [['controllerClass'], 'required'],
            ['controllerClass', 'match', 'pattern' => '/^[\w\\\\]*Controller$/', 'message' => 'Only word characters and backslashes are allowed, and the class name must end with "Controller".'],
            ['controllerClass', 'validateNewClass'],
        ];
    }

    /**
     * An inline validator that checks if the attribute value refers to a valid namespaced class name.
     * The validator will check if the directory containing the new class file exist or not.
     * @param string $attribute the attribute being validated
     * @param array $params the validation options
     */
    public function validateNewClass($attribute, $params)
    {
        $class = ltrim($this->$attribute, '\\');
        if (($pos = strrpos($class, '\\')) === false) {
            $this->addError($attribute, "The class name must contain fully qualified namespace name.");
        } else {
            $ns = substr($class, 0, $pos);
            $path = \Yii::getAlias('@' . str_replace('\\', '/', $ns), false);
            if ($path === false) {
                $this->addError($attribute, "The class namespace is invalid: $ns");
            } elseif (!is_dir($path)) {
                $this->addError($attribute, "Please make sure the directory containing this class exists: $path");
            }
        }
    }

    /**
     * get actions from class
     * @return array
     */
    public function getActions(){
        $methodArray = [];
        $reflection = new \ReflectionClass('\\'.$this->controllerClass);
        $methods = $reflection->getMethods();
        foreach($methods as $method) {
            if (preg_match('/^action+(\w{2,})/',$method->name,$matches)) {
                $methodArray[$method->name] = $matches[1];
            }
        }
        return $methodArray;
    }

    public function savePermissions(){
        $auth = new DbManager();
        $auth->init();
        $actions = $this->getActions();
        if(strpos($this->controllerClass,'\\')===false){
            \Yii::$app->session->addFlash('error',\Yii::t('auth','wrong data '));
        }else{
            foreach($actions as $action){
                if(!$auth->getPermission($this->controllerClass.'_'.$action)){
                    $permission = $auth->createPermission($this->controllerClass.'_'.$action);
                    if(!$auth->add($permission)){
                        \Yii::$app->session->addFlash('error',\Yii::t('auth', $action.' action add failed'));
                    }else{
                        \Yii::$app->session->addFlash('success',\Yii::t('auth', 'add '. $action.' action success!'));  ;
                    }
                }else{
                    \Yii::$app->session->addFlash('error',\Yii::t('auth', $action.' action has already exist'));
                }
            }
        }
    }

}