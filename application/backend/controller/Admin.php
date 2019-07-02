<?php

namespace app\backend\controller;

use app\common\Backend;
use think\Db;
use think\Request;
use app\model\Admin as AdminModel;
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
        $breadcrumb = [
                ['name' => '会员管理', 'url' => 'index'],
                ['name' => '会员列表']
        ];
        //查询会员列表
        $admin = new AdminModel;
        $list = $admin->join('shop_user_role sur', 'sur.user_id = shop_admin.id', "left")
                ->join('shop_roles sr', 'sr.id = sur.role_id', "left")
                ->field('shop_admin.*,sr.role_name')
                ->paginate(7);

        $page = $list->render();
        $count = Db::table("shop_admin")->count();

        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('count', $count);
        $this->assign('breadcrumb', $breadcrumb);
        return $this->fetch('index');
    }

    //增加修改用户
    public function info() {
        if (!empty(input('id'))) {
            $id = input('id');
            $admin = Db::table("shop_admin")
                    ->join('shop_user_role sur', 'sur.user_id = shop_admin.id', "left")
                    ->field('shop_admin.*,sur.role_id')
                    ->where("shop_admin.id", $id)
                    ->find();

            $this->assign('admin', $admin);
        }
        $roles = Db::table("shop_roles")->select();

        $this->assign('roles', $roles);
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('info');
    }

    //增加修改用户方法
    public function store() {
        Db::startTrans();
        try {
            $id = input('id');
            if (!empty(input('id'))) {
                $admin = AdminModel::get($id);
                $str = "修改";
            } else {
                $admin = new AdminModel;
                $str = "添加";
                $admin->created_at = date("Y-m-d H:i:s");
            }

            $admin->name = input('name');
            $admin->phone = input('phone');
            $admin->email = input('email');
            $admin->loginip = "127.0.0.1";
            $admin->password = AdminModel::Encryption(input('pass'));
            $save = $admin->save();
            $userId = input('id') > 0 ? input('id') : Db::name('shop_admin')->getLastInsID();
            $data = [
                "role_id" => input('role'),
                "user_id" => $userId
            ];

            Db::table('shop_user_role')->where('user_id', $id)->delete();
            Db::table('shop_user_role')->insert($data);

            // 提交事务
            Db::commit();
            $this->success("用户 $str 成功！");
        } catch (\Exception $e) {

            // 回滚事务
            Db::rollback();
            throw $e;
            $this->error("用户 $str 失败！");
        }
    }

    //删除用户
    public function del() {
        $id = request()->post('id');
        $res = Db::table('shop_admin')->delete(['id' => $id]);
        if ($res) {
            $this->success('用户删除成功');
        } else {
            $this->error('用户删除失败！');
        }
    }

    //修改用户状态
    public function status() {
        $id = input('id');
        $status = request()->post('status');
        $res = Db::table('shop_admin')->where('id', $id)->update(["status" => $status]);

        if ($res) {
            $this->success('状态修改成功!');
        } else {
            $this->error('状态修改成功!');
        }
    }

    /*     * ******角色相关操作******* */

    //角色列表
    public function role() {
        $breadcrumb = [
                ['name' => '角色管理', 'url' => 'role'],
                ['name' => '角色列表']
        ];
        $role = new RolesModel;
        //查询角色列表
        $list = $role->paginate(7);
        $page = $list->render();
        $count = Db::table("shop_roles")->count();
        if(!empty($list)){
            foreach ($list as $k=>$ro) {
                $list[$k]['nodes'] = Db::table("shop_role_node")
                        ->join("shop_nodes sn","sn.id=shop_role_node.node_id","left")
                        ->where("role_id",$ro['id'])
                        ->column("sn.name");
            }
        }
        
        $this->assign('list', $list);
        $this->assign('page', $page);
        $this->assign('count', $count);
        $this->assign('breadcrumb', $breadcrumb);
        return $this->fetch('role');
    }

    //增加修改用户
    public function roleInfo() {
        $role_nodes = [];
        if (!empty(input('id'))) {
            $id = input('id');
            $role = Db::table("shop_roles")->find($id);
            $this->assign('role', $role);
            //角色拥有的节点
            $role_nodes = Db::table("shop_role_node")->where("role_id", $id)->column('node_id');
        }

        $this->assign('role_nodes', $role_nodes);
        $nodes = Db::table("shop_nodes")->select();
        $this->assign('nodes', $nodes);
        $this->view->engine->layout('layouts/easy');
        return $this->fetch('role_info');
    }

    //增加编辑角色
    public function roleStore() {

        Db::startTrans();
        try {
            $id = input('id');
            if (!empty(input('id'))) {
                $role = RolesModel::get($id);
                $str = "修改";
            } else {
                $role = new RolesModel;
                $str = "添加";
                $role->created_at = date("Y-m-d H:i:s");
            }

            $role->role_name = input('role_name');
            $role->description = input('desc');
            $save = $role->save();

            $role_id = input('id') > 0 ? input('id') : Db::name('shop_roles')->getLastInsID();
            $node = explode(",",trim(input('node'),","));
            $data = [];

            if(!empty($node)){
                foreach ($node as $n){
                    $data[] = ["role_id"=>$role_id,"node_id"=>$n];
                }
            }
            Db::table('shop_role_node')->where('role_id', $id)->delete();

            Db::table('shop_role_node')->insertAll($data);

            // 提交事务
            Db::commit();
            $this->success("角色 $str 成功！");
        } catch (\Exception $e) {

            // 回滚事务
            Db::rollback();
            throw $e;
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
        $breadcrumb = [
                ['name' => '节点管理', 'url' => 'node'],
                ['name' => '节点列表']
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
        if (!empty(input('id'))) {
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
        if (!empty(input('id'))) {
            $node = NodesModel::get($id);
            $str = "修改";
        } else {
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
