<?php

namespace app\common;

use app\common\Controllers;
use think\Session;

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
        $this->assign('breadcrumb', $this->breadcrumb); //初始化面包屑导航
        $this->isLogin();   //检查登录转态
        $this->isStatus();  //判断账号是否可用
    }

    /**
     * 判断是否登录
     */
    public function isLogin() {
        $data = Session::get('_admin');
        if (empty($data['name'])) {
            $this->success('请先登录！', url('/publics/login'));
        }
    }

    /**
     * 检查帐号是否可用
     */
    public function isStatus() {
        $data = Session::get('_admin');
        if ($data['status'] != 1) {
            $this->success('当前帐号不能使用，请联系相关人员！', url('/publics/login'));
        }
    }

    /**
     * 后台菜单过滤
     */
    public function filterMenu() {
        
    }

}
