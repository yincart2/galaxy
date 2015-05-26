<?php

namespace home\modules\member\models;

use Yii;

/**
 * This is the model class for table "wishlist".
 *
 * @property integer $wishlist_id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $item_id
 * @property integer $type
 * @property string $desc
 * @property integer $created_at
 */
class Wishlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'item_id', 'type', 'created_at'], 'integer'],
            [['desc'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wishlist_id' => Yii::t('app', 'Wishlist ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'type' => Yii::t('app', 'Type'),
            'desc' => Yii::t('app', 'Desc'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
