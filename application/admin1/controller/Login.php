<?php
namespace app\admin\controller;
use app\common\model\Admin;
use think\Controller;

class Login extends Controller
{
    //登录页
    public  function login(){
       //测试数据库连接
        /*$data=db('admin')->find(1);
        dump($data);*/
        if(request()->isPost()){
//            halt($this->request->post());
            $res=(new Admin())->login(input('post.'));//模型层负责接收表单提交的数据
//            halt(input('post.'));p
            if($res['valid']){
                $this->success($res['msg'],'Entry/index');
            }else{
                $this->error($res['msg']);
            }
//            halt($_POST);;
            echo 123;
        }
        echo '这里登录';
        return $this->fetch();
    }
}