<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-10
 * Time: 下午3:13
 */

namespace star\marketing\models;


use yii\base\Component;
use yii\helpers\Json;

class ShoppingCoupon extends Component
{

    public $couponModel;

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
                $this->couponModel = $couponModel;
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
        foreach ($coupons as $coupon) {
            if ($this->validate($coupon, $cartItems)) {
                $result['usable'][$coupon->coupon_id] = $coupon->coupon_no;
            } else {
                $result['useless'][$coupon->coupon_id] = $coupon->coupon_no;
            }
        }
        return $result;
    }
} 