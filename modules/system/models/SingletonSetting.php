<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-7-1
 * Time: 下午2:25
 */

namespace star\system\models;


use yii\base\Exception;
use yii\base\Model;

class SingletonSetting extends Model{

    public static  function getSettingValue($code,$moduleName=null){
        $settingFieldsModel = SettingFields::findOne(['setting_code'=>$code]);
        if($settingFieldsModel){
            return $settingFieldsModel->chosen_value;
        }else{
           throw new Exception(\Yii::t('system','the '.$moduleName.' Module\'s setting code is not exist:'. $code));
        }

    }
} 