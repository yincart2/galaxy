<?php

namespace star\store\models;

use Yii;

/**
 * This is the model class for table "store_user".
 *
 * @property integer $store_id
 * @property integer $user_id
 */
class StoreUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'user_id'], 'required'],
            [['store_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'store_id' => Yii::t('store', 'Store ID'),
            'user_id' => Yii::t('store', 'User ID'),
        ];
    }
}
