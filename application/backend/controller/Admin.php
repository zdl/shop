<?php

namespace app\backend\controller;

use app\common\Backend;
use think\Db;
use think\Request;
use app\model\User as UserModel;
use app\model\Roles as RolesModel;
use app\model\Nodes as NodesModel;

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
        //查询会员列表
        $user = new UserModel;
        $list = $user->paginate(7);
        $page = $list->render();
        $count = Db::table("shop_user")->count();

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('count', $count);
        $this->assign('breadcrumb', $breadcrumb);
        return $this->fetch('index');
    }

    //增加修改用户
    public function info(){
        if(!empty(input('user_id'))){
            $user_id = input('user_id');
            $user = Db::table("shop_user")->find($user_id);
            $this->assign('user', $user);
        }
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('info');
    }
    //增加修改用户方法
    public function store() {
        $user_id = input('user_id');
        if(!empty(input('user_id'))){
             $user = User::get($user_id);
             $str = "修改";
        }else{
            $user = new User;
            $str = "添加";
            $user->created_at = date("Y-m-d H:i:s");
        }

        $user->user_name = input('user_name');
        $user->phone = input('phone');
        $user->email = input('email');
        $user->user_password = password_hash(input('pass'), PASSWORD_DEFAULT);
        $save = $user->save();

        if ($save) {
            $this->success("用户 $str 成功！");
        } else {
            $this->error("用户 $str 失败！");
        }
        
    }

    //删除用户
    public function del() {
        $user_id = request()->post('user_id');
        $res = Db::table('shop_user')->delete(['user_id' => $user_id]);
        if ($res) {
            $this->success('用户删除成功');
        } else {
            $this->error('用户删除失败！');
        }
    }

    //修改用户状态
    public function status() {
        $user_id = input('user_id');
        $status = request()->post('status');
        $res = Db::table('shop_user')->where('user_id', $user_id)->update(["status" => $status]);

        if ($res) {
            $this->success('状态修改成功!');
        } else {
            $this->error('状态修改成功!');
        }
    }

    /*     * ******角色相关操作******* */

    //角色列表
    public function role() {
        $breadcrumb =[
            ['name'=>'角色管理','url'=>'role'],
            ['name'=>'角色列表']
        ];
        $role = new RolesModel;
        //查询角色列表
        $list = $role->paginate(7);
        $page = $list->render();
        $count = Db::table("shop_roles")->count();

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('count', $count);
        $this->assign('breadcrumb', $breadcrumb);
        return $this->fetch('role');
    }
    
    //增加修改用户
    public function roleInfo(){
        if(!empty(input('id'))){
            $id = input('id');
            $role = Db::table("shop_roles")->find($id);
            $this->assign('role', $role);
        }
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('role_info');
    }
    //增加编辑角色
    public function roleStore() {
        $id = input('id');
        if(!empty(input('id'))){
             $role = RolesModel::get($id);
             $str = "修改";
        }else{
            $role = new RolesModel;
            $str = "添加";
            $role->created_at = date("Y-m-d H:i:s");
        }

        $role->role_name = input('role_name');
        $role->description = input('desc');
        $save = $role->save();

        if ($save) {
            $this->success("角色 $str 成功！");
        } else {
            $this->error("角色 $str 失败！");
        }
    }

    //删除角色
    public function delRole() {
        $id = request()->post('id');
        $res = Db::table('shop_roles')->delete(['id' => $id]);
        if ($res) {
            $this->success('角色删除成功');
        } else {
            $this->error('角色删除失败！');
        }
    }

    //修改角色转态
    public function statusRole() {
        $id = input('id');
        $status = request()->post('status');
        $res = Db::table('shop_roles')->where('id', $id)->update(["status" => $status]);

        if ($res) {
            $this->success('状态修改成功!');
        } else {
            $this->error('状态修改成功!');
        }
    }

    /*     * ******节点相关操作******* */

    //节点列表
    public function node() {
        $breadcrumb =[
            ['name'=>'节点管理','url'=>'node'],
            ['name'=>'节点列表']
        ];
        $node = new NodesModel;
        //查询角色列表
        $list = $node->paginate(7);
        $page = $list->render();
        $count = Db::table("shop_nodes")->count();

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('count', $count);
        $this->assign('breadcrumb', $breadcrumb);

        return $this->fetch('node');
    }

    //增加节点
    public function nodeInfo() {
         if(!empty(input('id'))){
            $id = input('id');
            $node = Db::table("shop_nodes")->find($id);
            $this->assign('node', $node);
        }
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('node_info');
    }

    //编辑节点
    public function nodeStore() {
        $id = input('id');
        if(!empty(input('id'))){
             $node = NodesModel::get($id);
             $str = "修改";
        }else{
            $node = new NodesModel;
            $str = "添加";
        }

        $node->name = input('name');
        $node->http_path = input('http_path');
        $node->description = input('desc');
        $save = $node->save();

        if ($save) {
            $this->success("节点 $str 成功！");
        } else {
            $this->error("节点 $str 失败！");
        }
    }

    //删除节点
    public function delNode() {
        $id = request()->post('id');
        $res = Db::table('shop_nodes')->delete(['id' => $id]);
        if ($res) {
            $this->success('节点删除成功');
        } else {
            $this->error('节点删除失败！');
        }
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
