<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:46 PM
 */

namespace matter\helpers;


class TreeHelper {

    /**
     * 无限级分类，显示
     * @param $arr
     * @param string $selected
     * @param string $id
     * @param string $pid
     * @param string $name
     * @param int $span
     * @return string
     */
    static public function toTree($arr, $selected = '', $id = 'id', $pid = 'pid', $name = 'title', $span = 1)
    {
        static $str;
        foreach ($arr as $rs) {
            if ($rs->$pid == 0) {
                if ($selected == $rs->$id)
                    $select = "selected='selected'";
                $str .= "<option value='" . $rs->$id . "' $select >" . F::t($rs->$name) . "</option>";
                $str .= self::toTreeHelper($arr, $selected, $rs->$id, $pid, $id, $name, $span);
            }
        }
        return $str;
    }

    /**
     * 辅助生成树
     * @param $arr
     * @param $selected
     * @param $value
     * @param $pid
     * @param $id
     * @param $name
     * @param $span
     * @return string
     */
    static public function toTreeHelper($arr, $selected, $value, $pid, $id, $name, $span)
    {
        static $string;
        static $str;
        $array = array();
        for ($i = 0; $i < $span; $i++) {
            $string .= '&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        foreach ($arr as $rs) {
            if ($value == $rs->$pid) {
                if ($selected == $rs->$id)
                    $select = "selected='selected'";
                $str .= "<option value='" . $rs->$id . "' $select>" . $string . F::t($rs->$name) . "</option>";
                if (self::toTreeHelper($arr, $selected, $rs->$id, $pid, $id, $name, $span))
                    $str .= self::toTreeHelper($arr, $selected, $rs->$id, $pid, $id, $name, $span + 1);
            }
        }
        return $str;
    }

}