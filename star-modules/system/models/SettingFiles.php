<?php

namespace star\system\models;

use Yii;

/**
 * This is the model class for table "setting_files".
 *
 * @property integer $setting_files_id
 * @property integer $setting_id
 * @property string $files_code
 * @property string $files_label
 * @property string $value
 * @property integer $type
 * @property integer $status
 * @property string $setting_code
 */
class SettingFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_files_id', 'setting_id', 'files_code', 'files_label', 'value', 'setting_code'], 'required'],
            [['setting_files_id', 'setting_id', 'type','status'], 'integer'],
            [['files_code', 'files_label', 'value', 'setting_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_files_id' => Yii::t('system', 'Setting Files ID'),
            'setting_id' => Yii::t('system', 'Setting ID'),
            'files_code' => Yii::t('system', 'Files Code'),
            'files_label' => Yii::t('system', 'Files Label'),
            'value' => Yii::t('system', 'Value'),
            'type' => Yii::t('system', 'Type'),
            'setting_code' => Yii::t('system', 'Setting Code'),
        ];
    }
}
