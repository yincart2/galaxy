<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-29
 * Time: 下午4:04
 */

namespace star\account\models;


use star\system\models\SettingFiles;
use yii\base\Model;

class ShoppingCredit extends Model{

    const settingCode = 'credit_credit_scale';
    public $scale = 1;

    public function init(){
        $settingModel = \Yii::createObject(SettingFiles::className())->findOne(['setting_code'=>self::settingCode]);
        if($settingModel){
            $this->scale = $settingModel->value;
        }
    }

    /**
     * @param $event
     */
    public function useCredit($event){
        /** @var  $order  \star\order\models\Order */
        $order = $event->sender;


    }
}