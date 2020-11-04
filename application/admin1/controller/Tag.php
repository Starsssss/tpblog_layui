<?php

namespace app\admin\controller;

use think\Db;
use think\Request;

class Tag extends Common
{
    protected $db;

    //首页
    public function index()
    {
        //获取标签数据
        $tags = Db::name('tag')->paginate(2);
        //赋值到模板
        $this->assign('tags', $tags);
        //加载模板视图
        return $this->fetch();
    }

    //添加标签
    public function store()
    {
        if ($this->request->isPost()) {
            $res = model('Tag')->store(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'], 'index');
            } else {
                $this->error($res['msg']);
            }
        }
        //加载模板视图
        return $this->fetch();
    }

    public function edit()
    {
        if ($this->request->isPost()){
            $res = model('Tag')->edit(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'], 'index');
            } else {
                $this->error($res['msg']);
            }
        }
        //获取标签名称
        $data=(Db::name('tag')->find(['tag_id'=>input('param.tag_id')]));
        if(!$data){
            $this->error('参数异常!');
        }
        $this->assign('tag',$data);
        return $this->fetch();
    }

    public function del()
    {
        $res=model('tag')->where('tag_id','=',input('param.tag_id'))->delete();
        if($res){
            $this->success('删除成功!','index');
        }else{
            $this->error('删除失败!');
        }
    }


}