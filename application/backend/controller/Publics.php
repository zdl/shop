<?php

namespace app\backend\controller;

use app\common\Controllers;
use think\Request;
use app\model\Admin;
use think\Session;

/**
 * Description of Public
 *  公共方法
 * @author 亮亮
 */
class Publics extends Controllers {

    public function index() {
        $this->redirect('publics/login');
    }

    /**
     * 管理员登录
     */
    public function login(Request $request) {
        $data = Session::get('_admin');
        if (!empty($data['name'])) {
            $this->success('你已登录！', url('/index/index'));
        }
        $this->view->engine->layout('layouts/easy');
        if ($request->param()) {
            $username = $request->param('username');
            $password = $request->param('password');
            if (empty($username) && empty($username)) {
                $this->error('帐号或密码不能为空！！！');
            }
            $model = new Admin();
            $status = $model->VerifyPwd($username, $password);
            if ($status) {
                $this->success('登录成功！', url('index/index'));
            } else {
                $this->error('帐号或密码错误！！！');
            }
        }
        return $this->fetch('login');
    }

    public function logout() {
        Session::delete('_admin');
        $this->success('退出成功！', url('publics/login'));
    }

}
