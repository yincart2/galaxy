<?php

namespace star\system\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "setting".
 *
 * @property integer $setting_id
 * @property string $menu_code
 * @property string $menu_label
 * @property string $group_code
 * @property string $group_label
 * @property integer $menu_sort
 * @property integer $group_sort
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'menu_code', 'menu_label', 'group_code', 'group_label','menu_sort','group_sort'], 'required'],
            [['setting_id', 'menu_sort', 'group_sort'], 'integer'],
            [['menu_code', 'menu_label', 'group_code', 'group_label'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => Yii::t('system', 'Setting ID'),
            'menu_code' => Yii::t('system', 'Menu Code'),
            'menu_label' => Yii::t('system', 'Menu Label'),
            'group_code' => Yii::t('system', 'Group Code'),
            'group_label' => Yii::t('system', 'Group Label'),
            'menu_sort' => Yii::t('system', 'Menu Sort'),
            'group_sort' => Yii::t('system', 'Group Sort'),
        ];
    }

    public function afterSave($insert, $changedAttributes){
        $this->saveSettingFields($this->setting_id);
        parent::afterSave($insert, $changedAttributes);
    }

    public function saveSettingFields($settingId){
        if (isset($_POST['SettingFields'])) {
            $settingFields = $_POST['SettingFields'];
            unset($_POST['SettingFields']);
            if (is_array($settingFields['type']) && $count = count($settingFields['type'])) {
                for ($i = 0; $i < $count; $i++) {
                    if(isset($settingFields['setting_fields_id'][$i]) && $settingFields['setting_fields_id'][$i]) {
                        $propValue = Yii::createObject(SettingFields::className());
                        $settingFieldsModel = $propValue::find()->where(['setting_fields_id' => $settingFields['setting_fields_id'][$i]])->one();;
                    } else {
                        $settingFieldsModel = Yii::createObject(SettingFields::className());
                    }
                    $settingFieldsModel->setAttributes(array(
                        'setting_id' => $settingId,
                        'type' => $settingFields['type'][$i],
                        'fields_code' => $settingFields['fields_code'][$i],
                        'fields_label' => $settingFields['fields_label'][$i],
                        'value' => $settingFields['value'][$i],
                        'setting_code' => $this->menu_code.'_'.$this->group_code.'_'. $settingFields['fields_code'][$i],
                        'status' => 1,
                    ));
                    if(isset($settingFields['setting_fields_id'][$i]) && $settingFields['setting_fields_id'][$i]) {
                        $settingFieldsModel->update();
                    } else {
                        if(!$settingFieldsModel->save()){
                            throw new Exception(Yii::t('system','save attributes fail'));
                        }
                    }
                    $settingFields['setting_fields_id'][$i] = $settingFieldsModel->setting_fields_id;
                }
                $propValueModel = Yii::createObject(SettingFields::className());
                //删除
                $models = $propValueModel::findAll(['setting_id' => $settingId]);
                $delArr = array();
                foreach ($models as $k1 => $v1) {
                    if (!in_array($v1->setting_fields_id, $settingFields['setting_fields_id'])) {
                        $delArr[] = $v1->setting_fields_id;
                    }
                }
                if (count($delArr)) {
                    $propValueModel = Yii::createObject(SettingFields::className());
                    $propValueModel::deleteAll('setting_fields_id IN (' . implode(', ', $delArr) . ')');
                }
            }
        }else{
            //已经没有属性了，要清除数据表内容
            $propValueModel = Yii::createObject(SettingFields::className());
            $propValueModel::deleteAll('setting_id = ' . $settingId);
        }
    }

    public function getSettingFields(){
        return self::hasMany(SettingFields::className(),['setting_id'=>'setting_id']);
    }
}
