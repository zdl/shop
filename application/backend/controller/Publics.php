<?php

namespace app\backend\controller;

use app\common\Backend;
use think\Request;

/**
 * Description of Public
 *  公共方法
 * @author 亮亮
 */
class Publics extends Backend {

    public function index() {
        
    }

    public function login(Request $request) {
        if ($request->param()) {
            $username = $request->param('username');
            $password = $request->param('password');
            if(empty($username) && empty($username)){
                $this->error('帐号或密码不能为空！！！');
            }
            $this->success('登录成功！',url('index/index'));
        }
        return $this->fetch('login');
    }

}
