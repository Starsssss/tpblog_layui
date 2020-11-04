<?php
namespace app\admin\controller;

use think\App;
use think\Controller;
use think\Request;


//公共控制器,进行登录的验证
class Common extends Controller
{
    //登录页
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        //执行登录验证
        if(!session('admin.admin_id')){//$_SESS[admin][admin_id]
            $this->redirect('admin/login/login');//未登录跳转登录页
        }
    }
    /* public function __construct(Request $request=null){
         parent::__construct($request);
         //执行登录验证
         if(!session('admin.admin_id')){//$_SESS[admin][admin_id]
             $this->redirect('admin/login/login');
         }
     }*/
}