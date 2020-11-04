<?php

namespace app\admin\controller;

use think\Db;
use think\Request;
use app\admin\controller\Category;
class Article extends Common
{
    protected $db;

    //首页
    public function index()
    {
        //获取文章数据
        $article = Db::name('article')->paginate(2);
//        halt($article);
        //赋值到模板
        $this->assign('article', $article);
        //加载模板视图
        return $this->fetch();
    }

    //添加文章
    public function store()
    {
        //获取标签数据
        $tagData=Db::name('tag')->select();
//        halt($tagData);
//        获取分类数据
        $cateData=(new Category())->getCateTree(Db::name('cate')->all());
        $this->assign(['cates'=>$cateData,'tags'=>$tagData]);
        //加载模板视图
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