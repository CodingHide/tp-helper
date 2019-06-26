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
```

