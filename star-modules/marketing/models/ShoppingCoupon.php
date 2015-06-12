<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-10
 * Time: 下午3:13
 */

namespace star\marketing\models;


use star\order\models\Order;
use yii\base\Component;
use yii\helpers\Json;
use Yii;

class ShoppingCoupon extends Component
{
    const SESSION_KEY = 'couponId';
    const SESSION_COUPON_MODEL_KEY = 'couponModel';
    public $couponModel;

    public function init(){
            $this->couponModel = Coupon::findOne(Yii::$app->getSession()->get(self::SESSION_COUPON_MODEL_KEY));
    }

    public function validate(Coupon $couponModel, $cartItems)
    {
        if ($couponModel->start_at < time() && $couponModel->end_at > time() && $couponModel->status == 1 && $couponModel->user_id == \Yii::$app->user->id) {
            $couponRuleModel = $couponModel->couponRule;
            if($couponRuleModel){
                $condition = Json::decode($couponRuleModel->condition);
                $category_id = isset($condition['category_id']) ? $condition['category_id'] : null;
                $orderModel = $this->getOrderModel($category_id, $cartItems);
                foreach ($condition as $key => $value) {
                    if ($orderModel->hasAttribute($key)) {
                        if (!$orderModel->$key >= $value) {
                            return false;
                        }
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * get Order's validate attributes and save them in CouponForm model.
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $category_id
     * @param $cartItems
     * @return CouponForm
     */
    public function getOrderModel($category_id, $cartItems)
    {
        if ($category_id) {
            $tmp = [];
            foreach ($cartItems as $key => $cartItem) {
                if (is_array($category_id)) {
                    if (in_array($cartItem->sku->item->category_id, $category_id)) {
                        $tmp[$key] = $cartItem;
                    }
                } else {
                    if ($cartItem->sku->item->category_id == $category_id) {
                        $tmp[$key] = $cartItem;
                    }
                }
            }
            $cartItems = $tmp;
        }
        $orderModel = new CouponForm();
        if ($cartItems) {
            //todo  $shippingFee
            $totalPrice = $qty = $shippingFee = 0;
            foreach ($cartItems as $carItem) {
                $sku = $carItem->sku;
                $totalPrice += $carItem->qty * $sku->getPrice();
                $qty += $carItem->qty;
            }
        }
        $orderModel->total_price = isset($totalPrice) ? : 0;
        $orderModel->qty = isset($qty) ? : 0;
        $orderModel->shippingFee = isset($shippingFee) ? : 0;
        return $orderModel;
    }


    /**
     * get current user's coupon
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $cartItems
     * @return array
     */
    public function getCouponList($cartItems)
    {
        /** @var  $coupon Coupon */
        $coupons = Coupon::find()->where(['user_id' => \Yii::$app->user->id, 'status' => 1])->all();
        $result = ['usable'=>[\Yii::t('coupon','Please Select One')],'useless'=>[]];
        $couponIdArray = [];
        foreach ($coupons as $coupon) {
            if ($this->validate($coupon, $cartItems)) {
                $couponIdArray[] = $coupon->coupon_id;
                $result['usable'][$coupon->coupon_id] = $coupon->coupon_no;
            } else {
                $result['useless'][$coupon->coupon_id] = $coupon->coupon_no;
            }
        }
        Yii::$app->getSession()->set(self::SESSION_KEY,$couponIdArray);
        return $result;
    }

    public function getResult($couponId){
        $couponModel = Coupon::findOne($couponId);
        $couponRuleModel =  $couponModel->couponRule;
        if($couponRuleModel){
            Yii::$app->getSession()->set(self::SESSION_COUPON_MODEL_KEY,$couponId);
            return $couponRuleModel->result;
        }
        return [];
    }

    public function changeOrder($event){
        /** @var  $order Order */
        $order = $event->sender;
        $couponModel = Coupon::findOne(Yii::$app->getSession()->get(self::SESSION_COUPON_MODEL_KEY));
        if($couponModel){
            $couponRuleModel = $couponModel->couponRule;
            $result = Json::decode($couponRuleModel->result);
            foreach($result as $value){
                var_dump($result);exit;
                if($order->hasAttribute($value[0])){
                    switch($value[1]){
                       case '-':
                           var_dump(2);exit;
                             $order->$value[0] = $order->$value[0] - $value[2];
                                break;
                       case '*':
                           $order->$value[0] = $order->$value[0] * $value[2];
                            break;
                    }
                }
            }
        }
        var_dump($order->total_price);exit;
    }
} 