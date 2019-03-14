<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:48 PM
 */

namespace matter\helpers;


class FileHelper {

    /**
     * 按日期生成目录
     * @param $day_file
     * @param $path
     * @return mixed
     */
    static public function do_mkdir($day_file, $path)
    {
        $dir_array = explode("-", $day_file);
        if (count($dir_array) == 3) {
            $dir_1 = $path . '/' . $dir_array[0];
            $dir_2 = $dir_1 . "/" . $dir_array[1];
            $dir_3 = $dir_2 . "/" . $dir_array[2];
            $dir_file_array = array($dir_1, $dir_2, $dir_3);
            $dir_file_array = array();
            $dir_str = $path . '/';
            for ($i = 0; $i < count($dir_array); $i++) {
                $dir_str .= $dir_array[$i] . "/";
                array_push($dir_file_array, $dir_str);
            }
            for ($i = 0; $i < count($dir_file_array); $i++) {
                $dir_file = $dir_file_array[$i];
                if (file_exists($dir_file)) {
                    continue;
                } else {
//                    echo $dir_file;
//                    exit;
                    mkdir($dir_file, 0777);
                    chmod($dir_file, 0777);
                }
            }
            return $dir_file_array[count($dir_file_array) - 1];
        } else {
            echo "error!!!!!!!!!";
            exit;
        }
    }

    /**
     * 检查是否是文件
     * @param $url
     * @return bool
     */
    static public function isfile($url)
    {
        static $isfilestr;
        $isfile = get_headers($url);
        foreach ($isfile as $str) {
            $isfilestr .= $str;
        }
        $pos = strpos($isfilestr, "Content-Type: image/");
        if ($pos > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * 递归地删除指定目录
     * @param $dir
     */
    static public function deleteDir($dir)
    {
        if ($items = glob($dir . "/*")) {
            foreach ($items as $obj) {
                is_dir($obj) ? deleteDir($obj) : unlink($obj);
            }
        }
        rmdir($dir);
    }

    /**
     * 显示文件
     * @param $dir
     * @return array
     */
    function listFile($dir)
    {
        $fileArray = array();
        $cFileNameArray = array();
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . "\\" . $file)) {
                        $cFileNameArray = self::listFile($dir . "\\" . $file);
                        for ($i = 0; $i < count($cFileNameArray); $i++) {
                            $fileArray[] = $cFileNameArray[$i];
                        }
                    } else {
                        $fileArray[] = $file;
                    }
                }
            }

            return $fileArray;
        } else {
            echo "listFile出错了";
        }
    }

}