<?php

namespace star\member\models;

use Yii;

/**
 * This is the model class for table "wishlist".
 *
 * @property integer $wishlist_id
 * @property integer $user_id
 * @property integer $item_id
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
            [['user_id', 'item_id', 'created_at'], 'integer'],
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
            'item_id' => Yii::t('app', 'Item ID'),
            'desc' => Yii::t('app', 'Desc'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
