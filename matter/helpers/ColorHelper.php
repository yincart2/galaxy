<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:55 PM
 */

namespace matter\helpers;


class ColorHelper {

    /**
     * 生成随机颜色
     * @return string
     */
    static public function rand_color()
    {
        static $d;
        for ($a = 0; $a < 6; $a++) { //采用#FFFFFF方法，
            $d .= dechex(rand(0, 15)); //累加随机的数据--dechex()将十进制改为十六进制
        }
        return '#' . $d;
    }

}