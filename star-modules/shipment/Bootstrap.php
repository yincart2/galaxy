<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\shipment;

use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Shipment' => 'star\shipment\models\Shipment',
    ];
    public $settingCode = 'system_module_shipment';
} 