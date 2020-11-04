<?php

namespace app\admin\controller;


use think\Db;
use think\Exception;
use think\facade\Request;

class Tag extends Common
{
    public function index()
    {
//        echo 122;exit();
        if (Request::isAjax()) {
            $page = (int)input('get.page');
            $limit = (int)input('get.limit');
//            return $page;
            $res = Db::name('tag')->order('tag_id')->limit(($page - 1) * $limit, $limit)->select();
//            halt($res);

            $data = ['code' => 0, 'count' => Db::name('tag')->count(), 'msg' => '', 'data' => $res];
            return $data;
        }
        return view();
    }

    public function edit()
    {

    }
    
    public function del()
    {
        //列表页复选框删除
        if (Request::isPost()){
            try{
                $ids=array_column ( $_POST['data'] ,  'tag_id' );
                $result=Db::name('tag')->delete($ids);
            }catch (Exception $e) {
                return json(['code' => 999, 'msg' => 'sql语句执行出现错误!']);
            }
           if($result>0){
               return json(['code' => 1, 'msg' => '删除成功!']);
           }else{
               return json(['code' => 0, 'msg' => '删除失败!']);
           }

        }
    }
    public function test()
    {
        $res = Db::name('article')->select();
        halt(Db::name('article')->count());
//        FileSys

    }

    public function add()
    {
        if (Request::isPost()) {
            $data=(input('post.'));
            halt($data);
            $data['tag_isshow']=isset($data['tag_isshow'])??0;
            try {
                $bool = Db::name('tag')->insert($data);
            } catch (Exception $e) {
                return json(['code' => 999, 'msg' => 'Database Error!']);
            }
            if (1 == $bool) {
                return json(['code' => 1, 'msg' => '添加成功!']);
            } else {
                return json(['code' => 0, 'msg' => '添加失败!']);
            }

            return;
        }



        return view();
    }
    public function getAllTags()
    {
        if(\request()->isPost()){
            $data=Db::name('tag')->select();
            return json(['code'=>1,'msg'=>'','data'=>$data]);
        }
        return json(['code'=>0,'msg'=>'请求非法','data'=>[]]);
        halt(Db::name('tag')->select()); ;
    }
}