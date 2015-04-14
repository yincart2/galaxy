<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:49 PM
 */

namespace matter\helpers;


class OrderHelper {

    /**
     * 生成新订单号
     * @return string
     */
    static public function get_order_id()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        return date('Ymd') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

}