<?php

namespace app\backend\controller;

use think\Controller;
use think\Db;
use think\Request;


class Property extends Controller
{

    //展示属性
    public function lists(){
        $data = Db::table('category')
            ->join("property","category.id=property.cid")
            ->field("category.id as cid,category.name as cname,property.id as pid,property.name as pname")
            ->select();
        foreach ($data as $k => $v){
            $tmp[$k]['property'] = $v;
            $resData = Db::table('pvalue')->where('property_id',$v['pid'])->field('property_id',true)->select();
            $tmp[$k]['pvalue'] = $resData;
        }

        return view('showproperty',['list'=>$tmp]);
    }

    //添加商品属性
    public function addproperty(){
        if(Request::instance()->isGet()){
            $category = Db::table('category')->select();
            $category = $this->getTree($category);
            return view('addproperty',['list'=>$category]);
        }
        $postData = Request::instance()->post();
        print_r($postData);die;
    }


    //生成tree树
    function getTree($array){
        $list = array();

        foreach($array as $value){
            $items[$value['id']] = $value;
        }

        foreach($items as $key => $value){
            if(isset($items[$value['parent']])){
                $items[$value['parent']]['son'][] = &$items[$key];
            }else{
                $list[] = &$items[$key];
            }
        }
        return $list;
    }
}