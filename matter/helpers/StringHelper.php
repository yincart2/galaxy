<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/24/2015
 * Time: 6:28 PM
 */

namespace matter\helpers;


class StringHelper {

    /**
     * 字符串截取，支持中文和其他编码
     * @param $str 需要转换的字符串
     * @param int $start 开始位置
     * @param $length 截取长度
     * @param string $charset 编码格式
     * @param bool $suffix 截断显示字符
     * @return string
     */
    static public function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr"))
            return mb_substr($str, $start, $length, $charset);
        elseif (function_exists('iconv_substr')) {
            return iconv_substr($str, $start, $length, $charset);
        }
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
        if ($suffix)
            return $slice . "…";
        return $slice;
    }

    /**
     * 以下四个函数为必须函数.字符截取
     * @param $content
     * @param int $maxlen
     * @param bool $show
     * @param string $f
     * @return string
     */
    static public function sub($content, $maxlen = 300, $show = false, $f = '……')
    {
        //把字符按HTML标签变成数组。
        $content = preg_split("/(<[^>]+?>)/si", $content, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $wordrows = 0; //中英字数
        $outstr = ""; //生成的字串
        $wordend = false; //是否符合最大的长度
        $beginTags = 0; //除<img><br><hr>这些短标签外，其它计算开始标签，如<div*>
        $endTags = 0; //计算结尾标签，如</div>，如果$beginTags==$endTags表示标签数目相对称，可以退出循环。
        //print_r($content);
        foreach ($content as $value) {
            if (trim($value) == "")
                continue; //如果该值为空，则继续下一个值
            if (strpos(";$value", "<") > 0) {
                //如果与要载取的标签相同，则到处结束截取。
                if (trim($value) == $maxlen) {
                    $wordend = true;
                    continue;
                }
                if ($wordend == false) {
                    $outstr .= $value;
                    if (!preg_match("/<img([^>]+?)>/is", $value) && !preg_match("/<param([^>]+?)>/is", $value) && !preg_match("/<!([^>]+?)>/is", $value) && !preg_match("/<br([^>]+?)>/is", $value) && !preg_match("/<hr([^>]+?)>/is", $value)) {
                        $beginTags++; //除img,br,hr外的标签都加1
                    }
                } elseif (preg_match("/<\/([^>]+?)>/is", $value, $matches)) {
                    $endTags++;
                    $outstr .= $value;
                    if ($beginTags == $endTags && $wordend == true)
                        break; //字已载完了，并且标签数相称，就可以退出循环。
                } else {
                    if (!preg_match("/<img([^>]+?)>/is", $value) && !preg_match("/<param([^>]+?)>/is", $value) && !preg_match("/<!([^>]+?)>/is", $value) && !preg_match("/<br([^>]+?)>/is", $value) && !preg_match("/<hr([^>]+?)>/is", $value)) {
                        $beginTags++; //除img,br,hr外的标签都加1
                        $outstr .= $value;
                    }
                }
            } else {
                if (is_numeric($maxlen)) { //截取字数
                    $curLength = self::getStringLength($value);
                    $maxLength = $curLength + $wordrows;
                    if ($wordend == false) {
                        if ($maxLength > $maxlen) { //总字数大于要截取的字数，要在该行要截取
                            $outstr .= self::subString($value, 0, $maxlen - $wordrows);
                            $wordend = true;
                        } else {
                            $wordrows = $maxLength;
                            $outstr .= $value;
                        }
                    }
                } else {
                    if ($wordend == false)
                        $outstr .= $value;
                }
            }
        }

        //循环替换掉多余的标签，如<p></p>这一类
        while (preg_match("/<([^\/][^>]*?)><\/([^>]+?)>/is", $outstr)) {
            $outstr = preg_replace_callback("/<([^\/][^>]*?)><\/([^>]+?)>/is", "strip_empty_html", $outstr);
        }
        //把误换的标签换回来
        if (strpos(";" . $outstr, "[html_") > 0) {
            $outstr = str_replace("[html_&lt;]", "<", $outstr);
            $outstr = str_replace("[html_&gt;]", ">", $outstr);
        }
        //echo htmlspecialchars($outstr);
        if (true == $show && true == $wordend) {
            $outstr .= $f;
        }
        return $outstr;
    }

    /**
     * 取得字符串的长度，包括中英文
     * @param $text
     * @return int
     */
    static public function getStringLength($text)
    {
        if (function_exists('mb_substr')) {
            $length = mb_strlen($text, 'UTF-8');
        } elseif (function_exists('iconv_substr')) {
            $length = iconv_strlen($text, 'UTF-8');
        } else {
            preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
            $length = count($ar[0]);
        }
        return $length;
    }

    /**
     * 按一定长度截取字符串（包括中文）
     * @param $text
     * @param int $start
     * @param int $limit
     * @return string
     */
    static public function subString($text, $start = 0, $limit = 12)
    {
        if (function_exists('mb_substr')) {
            $more = (mb_strlen($text, 'UTF-8') > $limit) ? TRUE : FALSE;
            $text = mb_substr($text, 0, $limit, 'UTF-8');
            return $text;
        } elseif (function_exists('iconv_substr')) {
            $more = (iconv_strlen($text, 'UTF-8') > $limit) ? TRUE : FALSE;
            $text = iconv_substr($text, 0, $limit, 'UTF-8');
            //return array($text, $more);
            return $text;
        } else {
            preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
            if (func_num_args() >= 3) {
                if (count($ar[0]) > $limit) {
                    $more = TRUE;
                    $text = join("", array_slice($ar[0], 0, $limit));
                } else {
                    $more = FALSE;
                    $text = join("", array_slice($ar[0], 0, $limit));
                }
            } else {
                $more = FALSE;
                $text = join("", array_slice($ar[0], 0));
            }
            return $text;
        }
    }

    /**
     * 去掉多余的空标签
     * @param $matches
     * @return mixed|string
     */
    static public function strip_empty_html($matches)
    {
        $arr_tags1 = explode(" ", $matches[1]);
        if ($arr_tags1[0] == $matches[2]) { //如果前后标签相同，则替换为空。
            return "";
        } else {
            $matches[0] = str_replace("<", "[html_&lt;]", $matches[0]);
            $matches[0] = str_replace(">", "[html_&gt;]", $matches[0]);
            return $matches[0];
        }
    }

    /**
     * PHP判断字符串纯汉字 OR 纯英文 OR 汉英混合
     * @param $str
     * @return string
     */
    static public function utf8_str($str)
    {
        $mb = mb_strlen($str, 'utf-8');
        $st = strlen($str);
        if ($st == $mb)
            return '1'; //纯英文
        if ($st % $mb == 0 && $st % 3 == 0)
            return '2'; //纯汉字
        return '3'; //汉英混合
    }
}