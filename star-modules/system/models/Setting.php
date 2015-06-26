<?php

namespace star\system\models;

use Yii;

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
            [['setting_id', 'menu_code', 'menu_label', 'group_code'], 'required'],
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
}
