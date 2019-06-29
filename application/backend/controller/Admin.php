<?php


namespace app\backend\controller;

use app\common\Backend;

/**
 * Description of Admin
 *
 * @author 亮亮
 */
class Admin extends Backend{
   
    public function index(){
        return $this->fetch('index');
    }
    
    public function add(){
        return $this->fetch('add');
    }
}
