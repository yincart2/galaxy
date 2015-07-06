<?php
/**
 * Created by PhpStorm.
 * User: chalin
 * Date: 6/10/2015
 * Time: 2:13 PM
 */
namespace star\marketing\models;

use Yii;
use yii\base\Model;

class CouponForm extends Model
{
    public $star_id;
    public $total;
    public $desc;
    public $status;
    public $start_at;
    public $end_at;

    //condition attributes
    public $total_price;
    public $qty;
    public $category_id;

    //result attributes
    public $type;
    public $number;
    public $shipping;
    public $shippingFee;

    /** @inheritdoc */
    public function init()
    {
        $this->scenario = 'insert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'total', 'desc', 'status', 'type', 'number', 'shipping'], 'required', 'on' => ['insert']],
            [['star_id', 'total', 'shippingFee', 'total_price', 'qty'],'integer'],
            [['total' ,'status'], 'required', 'on' => 'update'],
            ['start_at', 'date', 'format' => 'yyyy-MM-dd HH:mm', 'timestampAttribute' => 'start_at', 'on' => ['insert','update']],
            ['end_at', 'date', 'format' => 'yyyy-MM-dd HH:mm', 'timestampAttribute' => 'end_at', 'on' => ['insert','update']],
            ['start_at', 'validateStartAt', 'on' => ['insert','update']],
            ['end_at', 'validateEndAt', 'on' => ['insert','update']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => Yii::t('marketing', 'Status'),
            'start_at' => Yii::t('marketing', 'Start At'),
            'end_at' => Yii::t('marketing', 'End At'),
            'star_id' => Yii::t('marketing', 'Star ID'),
            'total' => Yii::t('marketing', 'Total'),
            'desc' => Yii::t('marketing', 'Description'),
            'total_price' => Yii::t('marketing', 'Total Price'),
            'qty' => Yii::t('marketing', 'quantity'),
            'category_id' => Yii::t('marketing', 'Categories'),
            'type' => Yii::t('marketing', 'Type'),
            'number' => Yii::t('marketing', 'Number'),
            'shipping' => Yii::t('marketing', 'Shipping'),
            'shippingFee' => Yii::t('marketing', 'Shipping Fee'),
        ];
    }

    public function validateStartAt()
    {
        if($this->start_at < time()) {
            $this->addError('start_at', '开始时间不能早于当前时间！');
        }
    }

    public function validateEndAt()
    {
        if($this->start_at > $this->end_at) {
            $this->addError('end_at', '结束时间不能早于开始时间！');
        }
    }

    public function saveCoupon()
    {
        if($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $couponRule = Yii::createObject(CouponRule::className()) ;
                if (!$this->shippingFee) {
                    $this->shippingFee = 0;
                }
                $couponRule->desc = $this->desc;
                $condition = [
                    'total_price' => $this->total_price,
                    'qty' => $this->qty,
                    'category_id' => $this->category_id
                ];
                $result = [
                    'type' => $this->type,
                    'number' => $this->number,
                    'shipping' => $this->shipping,
                    'shippingFee' => $this->shippingFee,
                ];
                $couponRule->condition = json_encode($condition);
                $couponRule->result = json_encode($result);
                $couponRule->save();

                for ($i = 0; $i < $this->total; $i++) {
                    $coupon = Yii::createObject(Coupon::className()) ;
                    $coupon->coupon_no = uniqid();
                    $coupon->rule_id = $couponRule->rule_id;
                    $coupon->status = $this->status;
                    $coupon->start_at = $this->start_at;
                    $coupon->end_at = $this->end_at;
                    $coupon->star_id = $this->star_id;
                    $coupon->save();
                }

                $transaction->commit();
                return true;
            } catch (\yii\base\Exception $e) {
                $transaction->rollback();
                return false;
            }
        }
    }

    public function updateCoupon($rule_id) {
        if($this->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                for ($i = 0; $i < $this->total; $i++) {
                    $coupon = Yii::createObject(Coupon::className()) ;
                    $coupon->coupon_no = uniqid();
                    $coupon->rule_id = $rule_id;
                    $coupon->status = $this->status;
                    $coupon->start_at = $this->start_at;
                    $coupon->end_at = $this->end_at;
                    $coupon->star_id = $this->star_id;
                    $coupon->save();
                }

                $transaction->commit();
                return true;
            } catch (\yii\base\Exception $e) {
                $transaction->rollback();
                return false;
            }
        }
    }
}