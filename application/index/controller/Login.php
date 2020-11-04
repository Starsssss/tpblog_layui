<?php

namespace app\index\controller;
use app\common\model\User;
use think\Controller;
use think\Db;
use think\facade\Request;

class Login extends Controller
{
    public function index()
    {
//        halt($this->request->get());
        if($this->request->get()){
            //todo:验证器验证
            $validate = new \app\index\validate\Login;

            if (!$validate->check($this->request->get())) {
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }

            //redis输入密码次数限制
            $name="USER:".$this->request->get('username');
            $num=redis()->get($name);
//            halt($num);
            if($num>=3){
                return json(['code'=>110,'msg'=>'密码错误次数已达到3次,请5分钟再试']);
            }else{
                $res=User::where([
                    'u_username'=>$this->request->get('username'),//
                    'u_password'=>Request::get('password')//使用请求类Request
                ])->find();
                //找不到是null
                if($res){//密码正确
                    //存入session
                    session('user', ['u_id'=>$res['u_id'],'u_username'=>$res['u_username']]);
                    return json(['code'=>1,'msg'=>'登陆成功!']);
                }else{//密码错误
                    $res=User::where(['u_username'=>$this->request->get('username')])->find();
//                    var_dump($res['u_username'],$this->request->get('username'));
                    if($res['u_username']==$this->request->get('username')){
                     // 如果数据库不存在该用户,就没必要存入缓存
                        redis()->incr($name);
                        redis()->expire($name,300);
                    }
                    return json(['code'=>0,'msg'=>'登陆失败!请重新登录']);
                }
            }





//            halt($this->request->get('username'));
            $res=User::where([
                'u_username'=>$this->request->get('username'),//
                'u_password'=>Request::get('password')//使用请求类Request
            ])->find();
//    halt($res);
            //找不到是null
            if($res){
                //存入session
                session('user', ['u_id'=>$res['u_id'],'u_username'=>$res['u_username']]);
                return json(['code'=>1,'msg'=>'登陆成功!']);
            }else{

                return json(['code'=>0,'msg'=>'登陆失败!请重新登录']);
            }
//            halt(Db::getLastSql());
//            print_r($this->request->get());exit();
        }
        return $this->fetch();
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
