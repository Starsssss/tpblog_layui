<?php

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\facade\Request;

class Login extends Controller
{
    public function index()
    {
//        echo 122;
        if (Request::isPost()) {
//            print_r(input('post.'));
            /*Array
(
    [username] => admin
    [password] => 123456
    [captcha1] => 3232
)*/
            $data = input('post.');
            $result = $this->validate($data,'app\admin\validate\Login');

            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['msg'=>$result,'status'=>-1]);
            }else{
                $bool=Db::name('admin')
                    ->where(['admin_username'=>input('post.username'),'admin_password'=>input('post.password')])
                    ->find();
                if(!$bool){
                    return json(['msg'=>'账号或密码错误,请重试','status'=>0]);
                }
                session('admin',['aid'=>$bool['admin_id'],'username'=>$bool['admin_username']]);
                return json(['msg'=>'登陆成功','status'=>1]);
            }
            return;
        }
        return view();
    }

    public function logout()
    {
        if (Request::isGet()) {
            session(null);
//            halt(session('admin'));
//            Session::clear();
            return ;
        }
        return json(['msg'=>'非法请求!','status'=>0]);
    }
}
