# MiniPHP

## 简介

MiniPHP 项目常用 PHP 方法扩展包，包含如下扩展：

- String
- Array

## 安装

```bash
composer require mpcn/tp-helper
```

## 插件使用

### StringHelper

```php
//去除字符串中所有 HTML 代码
StringHelper::strip_html_tags($string);

//同时支持 UTF-8、GB2312 汉字截取
ArrayHelper::str_cut($string, $str_len, $start = 0, $code = 'UTF-8');

//计算 UTF-8 字符串长度
ArrayHelper::strlen_utf8($string);

//获取指定长度的随机字母数字组合的字符串
ArrayHelper::random($length = 5, $type = 0);
```



### ArrayHelper

```php
//二维数组按某个键值进行排序
ArrayHelper::array_sort($array, $keys, $order);
```

