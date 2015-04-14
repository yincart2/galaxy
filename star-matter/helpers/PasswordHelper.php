<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:44 PM
 */

namespace matter\helpers;


class PasswordHelper {

    /**
     * 生成随机密码
     * @param int $length
     * @return string
     */
    public static function generatePassword($length = 8)
    {
        $chars = array_merge(range(0, 9),
            range('a', 'z'),
            range('A', 'Z'),
            array('!', '@', '$', '%', '^', '&', '*'));
        shuffle($chars);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[$i];
        }
        return $password;
    }

}