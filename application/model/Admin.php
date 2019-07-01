<?php

namespace app\model;

use think\Model;

/**
 * Description of Admin
 *  管理员
 * @author 亮亮
 */
class Admin extends Model {

    //开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    // 设置当前模型对应的完整数据表名称
    protected $table = 'admin';
    //定义自动完成的时间戳的实际字段
    protected $createTime = 'create_time';
    protected $updateTime = 'login_time';

    //通过用户名获取用户信息
    public static function ByNameGetInfo($name=false) {
        
    }

    /*
     * 通过用户Id 获取用户信息
     * $id 用户Id 用户唯一id 不能为空 
     * 返回对应的数据库 格式为数组
     **/
    public static function ByIdGetInfo($id=false) {
        
    }

    //密码加密
    public function Encryption($password='') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    /*
     * 验证登录
     * $name  用户输入的用户名  不能为空 必填
     * $password    用户输入的密码  不能为空 必填
     * 验证通过返回true
     * 验证失败返回 false
     * */

    public function VerifyPwd($name, $password) {
        if (empty($name) && empty($password)) {
            return false;
        }
        $uinfo = $this->ByNameGetInfo($name);
        if (empty($uinfo)) {
            return false;
        }
        if (password_verify($password,$uinfo['password'])) {
            return false;
        }
        return true;
    }

}
