<?php
namespace star\account\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "activity".
 *
 * @property integer $activity_id
 * @property integer $activity_type
 * @property integer $activity_send_type
 * @property string $activity_send_value
 * @property integer $vaild_date
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $is_delete
 *
 * @property ActivityRecord[] $activityRecords
 */
class Activity extends \yii\db\ActiveRecord
{
    //TODO:add event name
    const TYPE_BIND_EMAIL = 1;
    const TYPE_BIND_PHONE = 2;
    const TYPE_RECHARGE = 3;

    const SEND_TYPE_POINTS = 1;
    const SEND_TYPE_ANNUAL = 2;

    public function getActivityType(){
        return [
            self::TYPE_BIND_EMAIL => Yii::t('account','Bind Email'),
            self::TYPE_BIND_PHONE => Yii::t('account','Bind Phone'),
            self::TYPE_RECHARGE => Yii::t('account','Recharge'),
        ];
    }

    public function getSendType(){
        return [
            self::SEND_TYPE_POINTS => Yii::t('account','Points'),
            self::SEND_TYPE_ANNUAL => Yii::t('account','Annual'),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_type', 'activity_send_type', 'activity_send_value',], 'required'],
            [['activity_type', 'activity_send_type', 'vaild_date', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['activity_send_value'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_id' => Yii::t('account', 'Activity ID'),
            'activity_type' => Yii::t('account', 'Activity Type'),
            'activity_send_type' => Yii::t('account', 'Activity Send Type'),
            'activity_send_value' => Yii::t('account', 'Activity Send Value'),
            'vaild_date' => Yii::t('account', 'Vaild Date'),
            'create_time' => Yii::t('account', 'Create Time'),
            'update_time' => Yii::t('account', 'Update Time'),
            'is_delete' => Yii::t('account', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityRecords()
    {
        return $this->hasMany(ActivityRecord::className(), ['activity_id' => 'activity_id']);
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
        ];
    }

    /**
     * use coupon before create order
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $event
     */
    public function useCoupon($event){
        /** @var  $order Order */
        $order = $event->sender;
        /** @var  $couponModel  Coupon */
        $couponModel = Coupon::findOne(Yii::$app->getSession()->get(self::SESSION_COUPON_MODEL_KEY));
        if($couponModel){
            $couponRuleModel = $couponModel->couponRule;
            $result = Json::decode($couponRuleModel->result);
            if($result['type']){
                $order->total_price = $order->total_price * $result['number'];
            }else{
                $order->total_price = $order->total_price - $result['number'];
            }
            switch($result['shipping']){
                case 1:
                    $order->shipping_fee = $order->shipping_fee - $result['shippingFee'];
                    break;
                case 2:
                    $order->shipping_fee = 0;
            }
            Event::on(Order::className(),Order::EVENT_AFTER_INSERT,[ShoppingCoupon::className(),'updateCouponStatus'],['couponModel'=>$couponModel]);
        }
    }
}