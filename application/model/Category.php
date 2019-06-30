<?php

namespace app\model;

use think\Model;

/**
 * Description of Category
 *  分类
 * @author 赵洋
 */
class Category extends Model {

    // 设置当前模型对应的完整数据表名称
    protected $table = 'category';

    public function categoryTree(){
        $list = $this->select();
        //生成Tree树
        return $this->getTree($list);
    }

    //生成tree树
    function getTree($list) {
        $tree = array();

        foreach ($list as $value) {
            $items[$value['id']] = $value->toArray();
        }

        foreach ($items as $key => $value) {
            if (isset($items[$value['parent']])) {
                $items[$value['parent']]['son'][] = &$items[$key];
            } else {
                $tree[] = &$items[$key];
            }
        }
        return $tree;
    }
}