<?php

namespace star\account\models;

use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "recharge".
 *
 * @property integer $recharge_id
 * @property integer $user_id
 * @property integer $money
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 */
class Recharge extends \yii\db\ActiveRecord
{

   const STATUS_WAIT_PAYMENT = 0;
   const STATUS_HAS_PAYED = 1;

    public function getStatusArray()
    {
        return [
            self::STATUS_WAIT_PAYMENT => Yii::t('account', 'Wait Pay'),
            self::STATUS_HAS_PAYED => Yii::t('account', 'Has Payed'),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recharge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','money'], 'required'],
            [['user_id', 'money', 'status', 'create_at', 'update_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recharge_id' => Yii::t('account', 'Recharge ID'),
            'user_id' => Yii::t('account', 'User ID'),
            'money' => Yii::t('account', 'Money'),
            'status' => Yii::t('account', 'Status'),
            'create_at' => Yii::t('account', 'Create At'),
            'update_at' => Yii::t('account', 'Update At'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
            ]
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            if (isset($changedAttributes['status'])&& $changedAttributes['status'] == self::STATUS_WAIT_PAYMENT && $this->status == self::STATUS_HAS_PAYED) {
                $userProfile = Yii::createObject(UserProfile::className());
                /**@var $userProfileModel UserProfile  * */
                $userProfileModel = $userProfile::findOne(['user_id' => Yii::$app->user->id]);
                $userProfileModel->money += $this->money;
                $userProfileModel->info = Yii::t('account','充值收入');
                if(!$userProfileModel->save()) {
                    throw new Exception(Yii::t('account',UserProfile::className().'save fail'));
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
