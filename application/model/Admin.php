<?php

namespace app\model;

use think\Model;
use think\Session;
use app\common\F;

/**
 * Description of Admin
 *  管理员
 * @author 亮亮
 */
class Admin extends Model {

    //开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    // 设置当前模型对应的完整数据表名称
    //protected $table = 'admin';
    //
    //定义自动完成的时间戳的实际字段
    protected $createTime = 'created_at';

    //通过用户名获取用户信息
    public static function ByNameGetInfo($name = false) {
        if (!empty($name)) {
            $data = Admin::where('status != 0')->getByName($name);
            return !empty($data) ? $data->toArray()      : false;
        } else {
            return false;
        }
    }

    /*
     * 通过用户Id 获取用户信息
     * $id 用户Id 用户唯一id 不能为空 
     * 返回对应的数据库 格式为数组
     * */

    public static function ByIdGetInfo($id = false) {
        
    }

    //密码加密
    public static function Encryption($password = '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    /**
     * 更新用户最后登录时间及ip
     */
    public function upLoginInfo($id = false) {
        $ip = F::getIP();
        if (!empty($id)) {
            Admin::where(array('id' => $id))->update(['loginip' => $ip, 'login_time' => time()]);
        }
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
        $uinfo = self::ByNameGetInfo($name);
        if (empty($uinfo)) {
            return false;
        }
        if (password_verify($password, $uinfo['password'])) {
            $data = [
                'id' => $uinfo['id'],
                'name' => $uinfo['name'],
                'status' => $uinfo['status'],
                'login_time' => $uinfo['login_time'],
            ];
            Session::set('_admin', $data);
            $this->upLoginInfo($uinfo['id']);
            return true;
        }
        return false;
    }

}
