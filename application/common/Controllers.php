<?php

namespace app\common;

use think\Controller;
use think\Session;

/**
 * Description of Controllers
 *  公共控制器方法
 * @author 亮亮
 */
class Controllers extends Controller {

    /**
     * 初始化构造函数
     */
    public function __construct() {
        parent::__construct();
        Session::init([
            'auto_start' => true,
        ]);
    }
    
    public function setSession($data = [], $prefix = '_web') {
        return Session::set($prefix, $data);
    }
    
    public function getSession($prefix = '_web'){
        return Session::get($prefix);
    }

}
