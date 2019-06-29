<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
define("BIND_MODULE",'backend'); # 绑定后台模块
// [ 应用入口文件 ]
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

$url = 'http://' . $_SERVER['HTTP_HOST'].parse_url($_SERVER['SCRIPT_NAME'],PHP_URL_PATH);
preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/',parse_url($_SERVER['SCRIPT_NAME'],PHP_URL_PATH),$match); 
$url = str_replace($match[1],'',$url);
define('HOST_PATH', $url);

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
