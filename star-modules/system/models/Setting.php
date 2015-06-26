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
        $this->saveSettingFiles($this->setting_id);
        parent::afterSave($insert, $changedAttributes);
    }

    public function saveSettingFiles($settingId){
        if (isset($_POST['SettingFiles'])) {
            $settingFiles = $_POST['SettingFiles'];
            unset($_POST['SettingFiles']);
            if (is_array($settingFiles['type']) && $count = count($settingFiles['type'])) {
                for ($i = 0; $i < $count; $i++) {
                    if(isset($settingFiles['setting_files_id'][$i]) && $settingFiles['setting_files_id'][$i]) {
                        $propValue = Yii::createObject(SettingFiles::className());
                        $settingFilesModel = $propValue::find()->where(['setting_files_id' => $settingFiles['setting_files_id'][$i]])->one();;
                    } else {
                        $settingFilesModel = Yii::createObject(SettingFiles::className());
                    }
                    $settingFilesModel->setAttributes(array(
                        'setting_id' => $settingId,
                        'type' => $settingFiles['type'][$i],
                        'files_code' => $settingFiles['files_code'][$i],
                        'files_label' => $settingFiles['files_label'][$i],
                        'value' => $settingFiles['value'][$i],
                        'setting_code' => $this->menu_code.'_'.$this->group_code.'_'. $settingFiles['files_code'][$i],
                        'status' => 1,
                    ));
                    if(isset($settingFiles['setting_files_id'][$i]) && $settingFiles['setting_files_id'][$i]) {
                        $settingFilesModel->update();
                    } else {
                        if(!$settingFilesModel->save()){
                            throw new Exception(Yii::t('system','save attributes fail'));
                        }
                    }
                    $settingFiles['setting_files_id'][$i] = $settingFilesModel->setting_files_id;
                }
                $propValueModel = Yii::createObject(SettingFiles::className());
                //删除
                $models = $propValueModel::findAll(['setting_id' => $settingId]);
                $delArr = array();
                foreach ($models as $k1 => $v1) {
                    if (!in_array($v1->setting_files_id, $settingFiles['setting_files_id'])) {
                        $delArr[] = $v1->setting_files_id;
                    }
                }
                if (count($delArr)) {
                    $propValueModel = Yii::createObject(SettingFiles::className());
                    $propValueModel::deleteAll('setting_files_id IN (' . implode(', ', $delArr) . ')');
                }
            }
        }else{
            //已经没有属性了，要清除数据表内容
            $propValueModel = Yii::createObject(SettingFiles::className());
            $propValueModel::deleteAll('setting_id = ' . $settingId);
        }
    }

    public function getSettingFiles(){
        return self::hasMany(SettingFiles::className(),['setting_id'=>'setting_id']);
    }
}
