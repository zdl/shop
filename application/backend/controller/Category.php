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
        $list = $model->categoryTree();
        return view('lists', ['list' => $list]);
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
        $res = Db::table('shop_category')->where(['name' => $postData['name']])->find();
        if ($res) {
            return $this->error('分类名称重复');
        }
        //插入数据
        $res = Db::table('shop_category')->insert($postData);
        if ($res) {
            //跳转到展示
            $this->success('分类添加成功', url('category/lists'));
        } else {
            //失败跳转
            $this->error('添加失败！');
        }
    }

    //删除分类
    public function delCategory() {
        $id = request()->get('id');
        $res = Db::table('shop_category')->where(['parent' => $id])->find();
        //有子分类不允许删除
        if ($res) {
            return $this->error('该分类下有子分类不允许删除！');
        }
        $res = Db::table('shop_category')->delete(['id' => $id]);
        if ($res) {
            $this->success('分类删除成功', url('category/showcategory'));
        } else {
            $this->error('删除失败！');
        }
    }

    //修改分类
    public function updateCategory() {

        $id = input('id');
        //判断访问方式
        if ($id) {
            //查询所有商品种类
            $category = Db::table('shop_category')->where(['id' => $id])->find();
            $parent = array();
            if ($category['parent'] != 0) {
                //查询所有商品种类
                $parent = Db::table('shop_category')->where(['parent' => 0])->select();
            }
            $this->view->engine->layout('layouts/easy');
            return view('updatecategory', ['list' => $category, 'parent' => $parent]);
        }

        $postData = request()->post();
        //dump($postData);die;
        $res = Db::table('shop_category')->where('id',$postData['id'])->update($postData);
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
