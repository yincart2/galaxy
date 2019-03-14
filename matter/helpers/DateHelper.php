<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:54 PM
 */

namespace matter\helpers;


class DateHelper {

    /**
     * 获得当前格林威治时间的时间戳
     * @return int
     */
    static public function gmtime()
    {
        return (time() - date('Z'));
    }

}