<?php

namespace star\account\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_profile_id
 * @property integer $user_id
 * @property integer $money
 * @property integer $credit
 * @property integer $phone
 * @property integer $pay_password
 * @property integer $sex
 * @property string $avatar
 * @property integer $birthday
 * @property integer $rank
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'money', 'credit', 'phone', 'pay_password', 'sex', 'birthday', 'rank'], 'integer'],
            [['avatar'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_profile_id' => Yii::t('store', 'User Profile ID'),
            'user_id' => Yii::t('store', 'User ID'),
            'money' => Yii::t('store', 'Money'),
            'credit' => Yii::t('store', 'Credit'),
            'phone' => Yii::t('store', 'Phone'),
            'pay_password' => Yii::t('store', 'Pay Password'),
            'sex' => Yii::t('store', 'Sex'),
            'avatar' => Yii::t('store', 'Avatar'),
            'birthday' => Yii::t('store', 'Birthday'),
            'rank' => Yii::t('store', 'Rank'),
        ];
    }

    public function getUserProfileModel(){
        $model =  self::findOne(['user_id'=>Yii::$app->user->id]);
        if(!$model){
            $this->user_id = Yii::$app->user->id;
            $this->money = 0;
            $this->save();
            $model= $this;
        }
        return $model;
    }
}
