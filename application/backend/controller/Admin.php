<?php

namespace app\backend\controller;

use app\common\Backend;

/**
 * Description of Admin
 *  管理员
 * @author 亮亮
 */
class Admin extends Backend {

    //管理员列表
    public function index() {
        return $this->fetch('index');
    }

    //增加管理员
    public function add() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('add');
    }

    //角色列表
    public function role() {
        return $this->fetch('role');
    }

    //增加角色
    public function addRole() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('add_role');
    }

    //节点列表
    public function node() {
        return $this->fetch('node');
    }

    //增加节点
    public function addNode() {
        return $this->fetch('add_node');
    }

    //商品分类添加
    public function add_cate() {
        return $this->fetch('add_cate');
    }

    //商品分类列表
    public function cate_list() {
        return $this->fetch('cate_list');
    }

}
