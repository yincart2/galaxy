<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午1:37
 */

namespace star\catalog;


use matter\base\BaseBootstrap;

class Bootstrap extends BaseBootstrap{

    public  $_modelMap = [
        'Currency' => 'star\catalog\models\Currency',
        'Item' => 'star\catalog\models\Item',
        'ItemImg' => 'star\catalog\models\ItemImg',
        'ItemProp' => 'star\catalog\models\ItemProp',
        'ItemPropSearch' => 'star\catalog\models\ItemPropSearch',
        'ItemSearch' => 'star\catalog\models\ItemSearch',
        'Language' => 'star\catalog\models\Language',
        'PropValue' => 'star\catalog\models\PropValue',
        'Sku' => 'star\catalog\models\Sku',
    ];
    public $settingCode = 'system_module_catalog';
} 