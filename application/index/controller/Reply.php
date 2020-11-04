<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Session;

class Reply extends Controller
{

    /**
     * 评论回复ajax接口
     * @return \think\response\Json 返回json格式
     */
    public function index()
    {

//        echo '123';
//        print_r(input('param.'));exit();
//        print_r(input('get.')) ;exit();

        if (!Session::has('user.u_id')) {
//            $this->error('请登录','index/login/index');
            return json(['code' => 99, 'msg' => '未登录,请登录']);
        }

        $data=input('param.');
//        var_dump($data);exit();
        if(empty($data['to_uid'])){//是一级评论
            $data['rev_time']=time();
            $res=Db::name('review')
                ->data($data)
                ->insert();
        }else{//是评论的回复

            $to_uid = input('param.to_uid');
            $from_uid = input('param.from_uid');
            $rev_content = input('param.content');
            $arc_id = input('param.article_id');
            $rev_id = input('param.rev_id');

            $res = Db::name('review')
                ->data([
                    'u_id' => $from_uid,//todo:到时根据登录状态确定
                    'to_uid' => $to_uid,
                    'rev_content' => $rev_content,
                    'arc_id' => $arc_id,
                    'rev_pid' => $rev_id,
                    'rev_time'=>time()
                ])
                ->insert();
//            file_put_contents('2222.txt',Db::getLastSql()) ;exit();
        }
//        echo $res;
//        echo Db::getLastSql();exit;
        if ($res==1){
            return json(['code'=>1,'msg'=>'评论成功']);
        }else{
            return json(['code'=>0,'msg'=>'评论失败']);
        }

    }
/*INSERT INTO `blog_review` (`u_id` , `to_uid` , `rev_content` , `arc_id` , `rev_pid` , `rev_time`) VALUES (NULL , NULL , NULL , NULL , NULL , 1604038640)*/



}
