<?php

namespace star\store\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $store_id
 * @property integer $star_id
 * @property integer $theme_id
 * @property string $name
 * @property string $desc
 * @property string $domain
 * @property string $logo
 * @property string $tags
 * @property integer $credit
 * @property integer $fans
 * @property integer $item_count
 * @property integer $money
 * @property integer $rank
 * @property integer $create_time
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['star_id', 'theme_id', 'credit', 'fans', 'item_count', 'money', 'rank', 'create_time'], 'integer'],
            [['create_time'], 'required'],
            [['name', 'desc', 'domain', 'logo', 'tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => Yii::t('store', 'Store ID'),
            'star_id' => Yii::t('store', 'Star ID'),
            'theme_id' => Yii::t('store', 'Theme ID'),
            'name' => Yii::t('store', 'Name'),
            'desc' => Yii::t('store', 'Desc'),
            'domain' => Yii::t('store', 'Domain'),
            'logo' => Yii::t('store', 'Logo'),
            'tags' => Yii::t('store', 'Tags'),
            'credit' => Yii::t('store', 'Credit'),
            'fans' => Yii::t('store', 'Fans'),
            'item_count' => Yii::t('store', 'Item Count'),
            'money' => Yii::t('store', 'Money'),
            'rank' => Yii::t('store', 'Rank'),
            'create_time' => Yii::t('store', 'Create Time'),
        ];
    }
}
