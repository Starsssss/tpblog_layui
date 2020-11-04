<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Category extends Controller
{
    public function index()
    {
        //获取顶级分类
        $topCates = Db::name('cate')->where('cate_pid', '=', 0)->all();
        //获取标签数据
//        $tags = Db::name('tag')->all();
        //获取分类数据
        $cates = Db::name('cate')->all();


        //获取分类树
        $cateTree=((new \app\common\model\Category())->getSubCate(input('param.caid')));
        //所有文章
        $articles = Db::name('article')->alias('a')
            ->join(['blog_cate' => 'c'], 'a.cate_id=c.cate_id')
//            ->where('c.cate_id', input('param.caid'))
            ->where(['a.cate_id'=>$cateTree])
            ->select();
        /* halt(Db::name('arc_tag')
             ->alias('at')
             ->join(['blog_tag'=>'t'],'t.tag_id=at.tag_id')->where("at.arc_id",1)->select());*/
        foreach ($articles as $k => $v) {
            $articles[$k]['tags'] = Db::name('arc_tag')
                ->alias('at')
                ->join(['blog_tag' => 't'], 't.tag_id=at.tag_id')
                ->where("at.arc_id", $v['arc_id'])
                ->select();
        }



//        halt($articles);
        $this->assign([ 'articles' => $articles, 'topCates' => $topCates]);
        return $this->fetch('index/index1');
    }

}
