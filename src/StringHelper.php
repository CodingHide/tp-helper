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
    public static function strip_html_tags($html = '') {
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

}