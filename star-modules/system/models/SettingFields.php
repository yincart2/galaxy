<?php

namespace star\system\models;

use Yii;

/**
 * This is the model class for table "setting_fields".
 *
 * @property integer $setting_fields_id
 * @property integer $setting_id
 * @property string $fields_code
 * @property string $fields_label
 * @property string $value
 * @property integer $type
 * @property integer $chosen_value
 * @property string $setting_code
 */
class SettingFields extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 1;
    const TYPE_RADIO = 2;
    const TYPE_CHECKLIST = 3;

    public function getStatusArray()
    {
        return [
            self::TYPE_TEXT => Yii::t('system', 'Text'),
            self::TYPE_RADIO => Yii::t('system', 'Radio'),
            self::TYPE_CHECKLIST => Yii::t('system', 'Checklist'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'setting_id', 'fields_code', 'fields_label', 'setting_code'], 'required'],
            [['setting_fields_id', 'setting_id', 'type'], 'integer'],
            [['fields_code', 'fields_label', 'value', 'setting_code'], 'string', 'max' => 255],
            ['setting_code','unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'setting_fields_id' => Yii::t('system', 'Setting Fields ID'),
            'setting_id' => Yii::t('system', 'Setting ID'),
            'fields_code' => Yii::t('system', 'Fields Code'),
            'fields_label' => Yii::t('system', 'Fields Label'),
            'value' => Yii::t('system', 'Value'),
            'type' => Yii::t('system', 'Type'),
            'setting_code' => Yii::t('system', 'Setting Code'),
        ];
    }
}
