<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-29
 * Time: 下午8:23
 */

namespace matter\base;

use star\system\models\SingletonSetting;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

class BaseBootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    public $_modelMap = [];

    /** @var  string Model's path  .for example: "dektrium\\user\\models\\" */
    public $_modelPath;

    /** @var  string module's name */
    public $_moduleName;

    /** @var  string  */
    public $settingCode;

    /** @inheritdoc */
    public function bootstrap($app)
    {

        if(!\Yii::createObject(SingletonSetting::className())->getSettingValue($this->settingCode,$this->_moduleName)){
            $app->setModule($this->_moduleName,null);
        }
        /** @var $module BaseModule */
        if ($app->hasModule($this->_moduleName) && ($module = $app->getModule($this->_moduleName)) instanceof BaseModule) {
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);

            foreach ($this->_modelMap as $name => $definition) {
                $class = $this->_modelPath . DIRECTORY_SEPARATOR . $name;
                \Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;
            }

            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules' => $module->urlRules
            ];

            $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
        }
    }

    public function __construct()
    {

        $className = get_class($this);
        $namespace = explode(DIRECTORY_SEPARATOR, $className);
        $n = count($namespace) - 1;
        $namespace[$n] = 'models';
        $this->_moduleName = $namespace[$n - 1];
        $this->_modelPath = implode(DIRECTORY_SEPARATOR, $namespace);

    }

}