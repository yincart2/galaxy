<?php

namespace star\account\models;

use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "withdrawal".
 *
 * @property integer $withdrawal_id
 * @property integer $user_id
 * @property double $withdrawal_fee
 * @property string $withdrawal_account
 * @property string $account_name
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 */
class Withdrawal extends \yii\db\ActiveRecord
{
    const STATUS_WAIT_CHECK = 0;
    const STATUS_PASS = 1;
    const STATUS_NOT_PASS = 2;

    public function getStatusArray()
    {
        return [
            self::STATUS_WAIT_CHECK => Yii::t('account', 'Wait Check'),
            self::STATUS_PASS => Yii::t('account', 'Pass'),
            self::STATUS_NOT_PASS => Yii::t('account', 'Not Pass'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdrawal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id',], 'required'],
            [['user_id', 'status', 'create_at', 'update_at'], 'integer'],
            [['withdrawal_fee'], 'number'],
            ['withdrawal_fee', 'validateFee'],
            [['withdrawal_account', 'account_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'withdrawal_id' => Yii::t('account', 'Withdrawal ID'),
            'user_id' => Yii::t('account', 'User ID'),
            'withdrawal_fee' => Yii::t('account', 'Withdrawal Fee'),
            'withdrawal_account' => Yii::t('account', 'Withdrawal Account'),
            'account_name' => Yii::t('account', 'Account Name'),
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

    public function validateFee()
    {
        $userProfile = Yii::createObject(userProfile::className())->findOne(['user_id' => Yii::$app->user->id]);
        if ($this->withdrawal_fee > $userProfile->money) {
            $this->addError('withdrawal_fee', '提现金额大于余额！');
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            if (isset($changedAttributes['status'])&& $changedAttributes['status'] == self::STATUS_WAIT_CHECK && $this->status == self::STATUS_PASS) {
                $userProfile = Yii::createObject(UserProfile::className());
                /**@var $userProfileModel UserProfile  * */
                $userProfileModel = $userProfile::findOne(['user_id' => Yii::$app->user->id]);
                $userProfileModel->money -= $this->withdrawal_fee;
                $userProfileModel->info = Yii::t('account','提现支出');
               if(!$userProfileModel->save()) {
                    throw new Exception(Yii::t('account',UserProfile::className().'save fail'));
               }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

}
