<?php


namespace tp\helper;

/**
 * 字符串处理
 * @package tp\helper
 */
class StringHelper
{

    /**
     * 移除所有 HTML 代码
     * @param string $html
     * @return string|string[]|null
     */
    public static function strip_html_tags($html = '')
    {
        $html = preg_replace('/&((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1', str_replace(array('&', '"', '<', '>'), array('&', '"', '<', '>'), $html));
        $html = htmlspecialchars_decode($html);
        $html = preg_replace("@<script(.*?)</script>@is", "", $html);
        $html = preg_replace("@<iframe(.*?)</iframe>@is", "", $html);
        $html = preg_replace("@<style(.*?)</style>@is", "", $html);
        $html = preg_replace("@<(.*?)>@is", "", $html);
        $html = preg_replace("/\s+/", " ", $html);
        $html = preg_replace("/<\!--.*?-->/si", "", $html);
        $html = str_replace("&nbsp;", "", $html);
        return $html;
    }


    /**
     * 同时支持 UTF-8、GB2312 汉字截取
     * @param $string
     * @param $str_len 截取长度
     * @param int $start 开始截取位置
     * @param string $code 编码
     * @return string
     */
    public static function str_cut($string, $str_len, $start = 0, $code = 'UTF-8')
    {
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $str_len) return join('', array_slice($t_string[0], $start, $str_len)) . "...";
            return join('', array_slice($t_string[0], $start, $str_len));
        } else {
            $start = $start * 2;
            $str_len = $str_len * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $str_len)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr .= substr($string, $i, 2);
                    } else {
                        $tmpstr .= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129) $i++;
            }
            if (strlen($tmpstr) < $strlen) $tmpstr .= "...";
            return $tmpstr;
        }
    }

    /**
     * 计算 UTF-8 字符串长度（忽略字节的方案）
     * @param string $str
     * @return int
     */
    public static function strlen_utf8($str)
    {
        $i = 0;
        $count = 0;
        $len = strlen($str);
        while ($i < $len) {
            $chr = ord($str[$i]);
            $count++;
            $i++;
            if ($i >= $len) {
                break;
            }
            if ($chr & 0x80) {
                $chr <<= 1;
                while ($chr & 0x80) {
                    $i++;
                    $chr <<= 1;
                }
            }
        }
        return $count;
    }

    /**
     * 获取指定长度的随机字母数字组合的字符串
     * @param $length int 长度
     * @param $type int 随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
     * @return string
     */
    public static function random($length = 5, $type = 0)
    {
        $arr = array(
            1 => "0123456789",
            2 => "abcdefghijklmnopqrstuvwxyz",
            3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
            4 => "~@#$%^&*(){}[]|"
        );
        if ($type == 0) {
            array_pop($arr);
            $string = implode("", $arr);
        } else if ($type == "-1") {
            $string = implode("", $arr);
        } else {
            $string = $arr[$type];
        }
        $count = strlen($string) - 1;
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $str[$i] = $string[rand(0, $count)];
            $code .= $str[$i];
        }
        return $code;
    }
}