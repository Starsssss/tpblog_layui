<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Session;

class Like extends Controller
{
    //点赞功能
    public function like()
    {

//        halt(input('get.'));
        /*$result=Db::name('like')->where('l_id','>',0)->update(['status'=>1]);
        halt($result);*/


        //获取当前文章的id
        $aid = input('get.arc_id');
        //当前用户id
        $uid=\session('user.u_id');
//        $aid=
        if (!Session::has('user.u_id')) {
//            $this->error('请登录','index/login/index');
            return json(['code' => 0, 'msg' => '未登录,请登录']);
        } else {
            $uid = \session('user.u_id');
            //查询点赞状态
            //查看有没有点赞记录/历史,有的话则更改点赞状态->取反,没有则插入点赞记录
            $res = Db::name('like')->where('u_id', $uid)
                ->where('arc_id', $aid)
                ->field(['status', 'l_id'])->find();
//            echo Db::getLastSql();
            if ($res != null) {
                /*$status=$res['status'];
                $l_id=$res['l_id'];*/
                if ($res['status'] == 1) {//之前点赞过
                    $result = Db::name('like')
                        ->where('l_id', $res['l_id'])
                        ->where('arc_id', $aid)
                        ->where('u_id',$uid)
                        ->update(['status' => 0]);
                    $msg = '已取消点赞!';
//                    echo Db::getLastSql();
                } else {
                    $result = Db::name('like')
                        ->where('l_id', $res['l_id'])
                        ->where('arc_id', $aid)
                        ->where('u_id',$uid)
                        ->update(['status' => 1]);
                    $msg = '点赞成功!';
//                    echo Db::getLastSql();
                }

            } else {
                //插入新纪录
                Db::name('like')->insert(['status' => 1, 'u_id' => $uid, 'arc_id' => $aid]);
                $msg = '点赞成功!';
            }
            return json(['code' => 1, 'msg' => $msg]);
//            return json(['code' => 1, 'msg' => '点赞成功']);

        }
    }
}
