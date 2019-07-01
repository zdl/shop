<?php

namespace app\common;

use app\common\Controllers;

/**
 * Description of Backend
 *
 * @author 亮亮
 */
class Backend extends Controllers {

    public $breadcrumb = [
        ['name' => '首页', 'url' => '/']
    ];

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->assign('breadcrumb', $this->breadcrumb);
        $this->isLogin();
    }

    /**
     * 判断是否登录
     */
    public function isLogin() {
        
    }

    /**
     * 后台菜单过滤
     */
    public function filterMenu() {
        
    }

}
