<?php

namespace star\account\models;

use Yii;
use yii\base\Exception;

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
    /** used to log the info of money  */
    public $info;
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
            [['avatar','info'], 'string', 'max' => 255]
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

    public function getUserProfileModel()
    {
        $model = self::findOne(['user_id' => Yii::$app->user->id]);
        if (!$model) {
            $this->user_id = Yii::$app->user->id;
            $this->money = 0;
            $this->save();
            $model = $this;
        }
        return $model;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            if (isset($changedAttributes['money']) ) {
                /**@var $moneyLogModel MoneyLog **/
                $moneyLogModel = Yii::createObject(MoneyLog::className());
                if($changedAttributes['money'] > $this->money){
                    $moneyLogModel->type = $moneyLogModel::STATUS_EXPEND;

                }else{
                    $moneyLogModel->type = $moneyLogModel::STATUS_INCOME;
                }
                $moneyLogModel->user_id =$this->user_id;
                $moneyLogModel->money =abs($changedAttributes['money'] - $this->money) ;
                $moneyLogModel->info =$this->info;
                if(!$moneyLogModel->save()) {
                    throw new Exception(Yii::t('money',MoneyLog::className().'save fail'));
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
