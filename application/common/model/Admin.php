<?php

namespace app\common\model;

use app\admin\validate\Admin as v;
use think\Db;
use think\Loader;
use think\Model;

class Admin extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'blog_admin';

    // 设置当前模型的数据库连接
    protected $connection = 'db_config';

    public function login($data)
    {
        $validate = new v;
        if (!$validate->check($data)) {
//            dump($validate->getError());
            return ['valid' => 0, 'msg' => $validate->getError()];
        }
        $res = Db::name('admin')->where('admin_username', $data['admin_username'])->find();
        if (!$res) {
            return ['valid' => 0, 'msg' => '不存在该账号'];
        } else {
            $res = Db::name('admin')->where('admin_username', $data['admin_username'])->where('admin_password', $data['admin_password'])->find();
            if (!$res) {
                return ['valid' => 0, 'msg' => '密码错误!'];
            }
        }

//        halt(serialize($this));
        session('admin.admin_id', $res['admin_id']);
        session('admin.admin_username', $data['admin_username']);
        return ['valid' => 1, 'msg' => '登录成功!'];
    }
}