<?php
namespace app\common;

use think\Controller;

/**
 * Description of Backend
 *
 * @author 亮亮
 */
class Backend extends Controller{
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->isLogin();
    }
    
    //判断是否登录
    public function isLogin(){
        
    }
    
    
    
}
