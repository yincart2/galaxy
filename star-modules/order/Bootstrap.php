<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\order;

use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Order' => 'star\order\models\Order',
        'OrderItem' => 'star\order\models\OrderItem',
        'OrderSearch' => 'star\order\models\OrderSearch',
        'ShoppingCart' => 'star\cart\models\ShoppingCart',
        'Shipment' => 'star\shipment\models\Shipment',
    ];
    public $settingCode = 'system_module_order';
} 