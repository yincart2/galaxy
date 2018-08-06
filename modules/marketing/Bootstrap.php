<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\marketing;


use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Coupon' => 'star\marketing\models\Coupon',
        'CouponForm' => 'star\marketing\models\CouponForm',
        'CouponRule' => 'star\marketing\models\CouponRule',
        'ShoppingCoupon' => 'star\marketing\models\ShoppingCoupon',
    ];
    public $settingCode = 'system_module_marketing';
} 