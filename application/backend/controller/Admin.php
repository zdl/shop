<?php

namespace app\backend\controller;

use app\common\Backend;

/**
 * Description of Admin
 *  管理员
 * @author 亮亮
 */
class Admin extends Backend {
    /*     * ******管理员相关操作******* */

    //管理员列表
    public function index() {
        $breadcrumb =[
            ['name'=>'会员管理','url'=>'index'],
            ['name'=>'会员列表']
        ];
        $this->assign('breadcrumb', $breadcrumb);
        return $this->fetch('index');
    }

    //增加管理员
    public function add() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('add');
    }

    //编辑管理员
    public function edit() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('info');
    }

    //删除管理员
    public function del() {
        
    }

    //修改转态
    public function status() {
        
    }

    /*     * ******角色相关操作******* */

    //角色列表
    public function role() {
        return $this->fetch('role');
    }

    //增加角色
    public function addRole() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('role_info');
    }

    //编辑角色
    public function editRole() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('role_info');
    }

    //删除角色
    public function delRole() {
        
    }

    //修改角色转态
    public function statusRole() {
        
    }

    /*     * ******节点相关操作******* */

    //节点列表
    public function node() {
        return $this->fetch('node');
    }

    //增加节点
    public function addNode() {
        $planPath = APP_PATH . 'backend/controller';
        $planList = array();
        $dirRes = opendir($planPath);
        while (false !== ($dir = readdir($dirRes))) {
            if ($dir[0] == ".") {
                continue;
            }
            $planList[] = basename($dir, '.php');
        }

        $ctrlId = 'Publics';
        $class_methods = get_class_methods($ctrlId);
        var_dump($planList);
        exit;

        foreach ($class_methods as $method_name) {
            echo "$method_name\n";
        }
        //echo JSON::encode($diffArray);
        var_dump($planList);
        exit;
        return $this->fetch('node_info');
    }

    //编辑节点
    public function editNode() {
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('node_info');
    }

    //删除节点
    public function delNode() {
        
    }

    //修改节点转态
    public function statusNode() {
        
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
