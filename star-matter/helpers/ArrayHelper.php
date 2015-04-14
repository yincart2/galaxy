<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:50 PM
 */

namespace matter\helpers;


class ArrayHelper {

    /**
     * 多维数组转一维数组
     * @param $array
     * @return array
     */
    static public function array_values_one($array)
    {
        static $span;
        $arrayValues = array();
        $i = 0;
        foreach ($array as $key => $value) {
            if (is_scalar($value) or is_resource($value)) {
                $arrayValues[$key] = $span . $value;
            } elseif (is_array($value)) {

                $arrayValues = array_merge($arrayValues, self::array_values_one($value));
            }
        }

        return $arrayValues;
    }

    /**
     * xml转数组
     * @param $xml
     * @return array
     */
    static public function xml_to_array($xml)
    {
        $res = array();
        foreach ($xml as $key => $value) {
            if (count($value) >= 1) {
                isset($keys[$key]) ? ($keys[$key] += 1) : ($keys[$key] = 1);
                if ($keys[$key] == 1)
                    $res[$key] = to_array($value);
                elseif ($keys[$key] == 2)
                    $res[$key] = array($res[$key], to_array($value)); else
                    $res[$key][] = to_array($value);
            } else {
                $res[$key] = (string)$value;
            }
        }
        return $res;
    }

    /**
     * 对象转数组
     * @param $object
     * @return array
     */
    static public function objectToArray($object)
    {
        $out = array();
        foreach ($object as $key => $value) {
            switch (true) {
                case is_object($value):
                    $out[$key] = self::objectToArray($value);
                    break;

                case is_array($value):
                    $out[$key] = self::objectToArray($value);
                    break;

                default:
                    $out[$key] = $value;
                    break;
            }
        }

        return $out;
    }
}