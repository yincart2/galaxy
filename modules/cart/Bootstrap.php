<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\cart;


use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Cart' => 'star\cart\models\Cart',
        'ShoppingCart' => 'star\cart\models\ShoppingCart',
    ];
    public $settingCode = 'system_module_cart';
} 