<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\payment;

use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Payment' => 'star\payment\models\Payment',
        'Order' => 'star\order\models\Order',
    ];
    public $settingCode = 'system_module_payment';
} 