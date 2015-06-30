<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\system;


use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Setting' => 'star\system\models\Setting',
        'SettingFields' => 'star\system\models\SettingFields',
        'SettingSearch' => 'star\system\models\SettingSearch',
    ];

} 