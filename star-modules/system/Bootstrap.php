<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\system;


use matter\base\BaseBootstrap;
use matter\base\BaseModule;
use yii\helpers\Json;
use yii\web\GroupUrlRule;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Setting' => 'star\system\models\Setting',
        'SettingFields' => 'star\system\models\SettingFields',
        'SettingSearch' => 'star\system\models\SettingSearch',
    ];

    public function bootstrap($app){
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

        \Yii::$container->setSingleton('setting',[
            'class'=>'star\system\models\SingletonSetting'
        ]);
    }
} 