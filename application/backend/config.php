<?php

use think\Config;

Config::load(APP_PATH . '/config.php');


//配置文件
return [
    // 视图输出字符串内容替换
//    'view_replace_str' => [
//        '__BACKEND_STYLE__' => APP_PATH . '/public/static/backend/',
//    ],
    'template' => [
        'layout_on' => true,
        'layout_name' => 'layouts/main',
    ]
];
