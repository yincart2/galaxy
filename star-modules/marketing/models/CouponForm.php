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
    public $isNewRecord;

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
            [['star_id', 'total', 'desc', 'status', 'total_price', 'qty', 'type', 'number', 'shipping'], 'required'],
            [['shippingFee', 'total_price'],'integer'],
            ['start_at', 'date', 'format' => 'yyyy-MM-dd HH:mm', 'timestampAttribute' => 'start_at', 'on' => ['insert']],
            ['end_at', 'date', 'format' => 'yyyy-MM-dd HH:mm', 'timestampAttribute' => 'end_at', 'on' => ['insert']],
            ['start_at', 'validateStartAt', 'on' => ['insert']],
            ['end_at', 'validateEndAt', 'on' => ['insert']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => Yii::t('coupon', 'Status'),
            'start_at' => Yii::t('coupon', 'Start At'),
            'end_at' => Yii::t('coupon', 'End At'),
            'star_id' => Yii::t('coupon', 'Star ID'),
            'total' => Yii::t('coupon', 'Total'),
            'desc' => Yii::t('coupon', 'Description'),
            'total_price' => Yii::t('coupon', 'Total Price'),
            'qty' => Yii::t('coupon', 'quantity'),
            'category_id' => Yii::t('coupon', 'Categories'),
            'type' => Yii::t('coupon', 'Type'),
            'number' => Yii::t('coupon', 'Number'),
            'shipping' => Yii::t('coupon', 'Shipping'),
            'shippingFee' => Yii::t('coupon', 'Shipping Fee'),
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
                $couponRule = new CouponRule();
                if (!$this->shippingFee) {
                    $this->shippingFee = 0;
                }
                $couponRule->desc = $this->desc;
                $condition = [
                    'total_price' => $this->total_price,
                    'qty' => $this->qty,
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
                    $coupon = new Coupon();
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
}