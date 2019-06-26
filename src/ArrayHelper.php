<?php


namespace tp\helper;


class ArrayHelper
{
    /**
     * 二维数组按某个键值进行排序
     * @param $arr 初始数组
     * @param $keys 排序变量名
     * @param int $order 0顺序，1倒序
     * @return array|bool
     */
    public static function array_sort($arr, $keys, $order = 0)
    {
        if (!is_array($arr)) {
            return false;
        }
        $keysValue = array();
        foreach ($arr as $key => $val) {
            $keysValue[$key] = $val[$keys];
        }
        if ($order == 0) {
            asort($keysValue);
        } else {
            arsort($keysValue);
        }
        reset($keysValue);//设定数组的内部指标到它的第一个元素
        $keySort = array();
        foreach ($keysValue as $key => $vv) {
            $keySort[$key] = $key;
        }
        $new_array = array();
        foreach ($keySort as $key => $val) {
            $new_array[$key] = $arr[$val];
        }
        return $new_array;
    }
}