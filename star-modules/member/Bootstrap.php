<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\member;


use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'DeliveryAddress' => 'star\member\models\DeliveryAddress',
        'Wishlist' => 'star\member\models\Wishlist',
    ];
    public $settingCode = 'system_module_member';
} 