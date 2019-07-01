<?php

namespace app\backend\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\model\Category as CategoryModel;

class Category extends Controller {

    //商品分类展示
    public function lists() {
        $model = new CategoryModel;
        //查询所有商品种类
        $list = $model->order('sort')->paginate(7);
        $page = $list->render();

        return view('lists', ['list' => $list, "page" => $page]);
    }

    //商品分类添加
    public function addCategory() {
        //判断访问方式
        if (request()->isGet()) {
            //查询所有商品种类
            $category = Db::table('shop_category')->where(['parent' => 0])->select();
            $this->view->engine->layout('layouts/easy');
            return $this->fetch('addcategory', ['list' => $category]);
        }
        //接收提交数据
        $postData = input('post.');
        $unique = Db::table('shop_category')->where(['name' => $postData['name']])->find();
        if ($unique)
            $this->error('分类名称已经存在！');
        $insert = Db::table('shop_category')->insert($postData);
        //插入数据1是成功 0是失败
        if ($insert) {
            $this->success('分类添加成功');
        } else {
            $this->error('分类添加失败！');
        }
    }

    //删除分类
    public function delCategory() {
        $id = request()->post('id');
        $res = Db::table('shop_category')->where(['parent' => $id])->find();
        //有子分类不允许删除
        if ($res) {
            return $this->error('该分类下有子分类不允许删除！');
        }
        $res = Db::table('shop_category')->delete(['id' => $id]);
        if ($res) {
            $this->success('分类删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    //修改分类是否开启显示
    public function updateStatus() {

        $id = input('id');
        $status = request()->post('status');

        $res = Db::table('shop_category')->where('id', $id)->update(["status" => $status]);

        if ($res) {
            $this->success('状态修改成功!');
        } else {
            $this->error('状态修改失败');
        }
    }

    //修改分类是否开启显示
    public function updateShow() {

        $id = input('id');
        $is_show = request()->post('is_show');

        $res = Db::table('shop_category')->where('id', $id)->update(["is_show" => $is_show]);

        if ($res) {
            $this->success('显示属性修改成功!');
        } else {
            $this->error('显示属性修改失败');
        }
    }
    //修改分类
    public function updateCategory() {

        $id = input('id');

        //判断访问方式
        if ($id) {
            //查询所有商品种类
            $category = Db::table('shop_category')->where(['id' => $id])->find();

            $this->view->engine->layout('layouts/easy');
            return view('updatecategory', ['category' => $category]);
        }

        $postData = request()->post();
        //dump($postData);die;
        $res = Db::table('shop_category')->where('id', $postData['id'])->update($postData);
        // $res = $cate->save($data,['cat_id'=>$data['cat_id']]);
        if ($res) {
            // $this->success('分类修改成功!', url('category/updatecategory'));
        } else {
            $this->error('分类修改失败');
        }

        // $cate = new CategoryModel;
        // if(request()->isPost()){
        //     $data = input('post.');
        //     // $save=$cate->save($data,['id'=>$data['id']]);
        //     $save = $cate->save($data,['id'=>$data['id']]);
        //     if($save !== false){
        //         $this->success('修改商品类型成功！',url('lists'));
        //     }else{
        //         $this->error('修改商品类型失败！');
        //     }
        //     return;
        // }
        // $cates = $cate->find(input('id'));
        // $cateres = $cate->getTree();
        // // dump(input());die;
        // $this->assign(array(
        //     'cateres'=>$cateres,
        //     'cates'=>$cates
        // ));
        // $this->view->engine->layout('layouts/easy');
        // return $this->fetch('updatecategory');
    }

}
