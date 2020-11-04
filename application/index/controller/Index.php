<?php

namespace app\index\controller;

use app\common\model\User;
use think\Controller;
use think\Db;

class Index extends Common
{
    public function index()
    {
//        halt(session('user'));
        //获取公告列表
        $affiche=Db::name('affiche')->order('aff_order','desc')->select();
        //获取顶级分类
        $topCates = Db::name('cate')->where('cate_pid', '=', 0)->all();
        //获取标签数据
        $tags = Db::name('tag')->all();
        //获取分类数据
        $cates = Db::name('cate')->all();

        //最新文章+分页
        $articles = Db::name('article')->alias('a')
            ->join(['blog_cate' => 'c'], 'a.cate_id=c.cate_id')
            ->order('updatetime','desc')//最新的先展示
            ->paginate(4)->each(function ($v,$key){
                //给每篇文章添加标签字段
                $v['tags'] = Db::name('arc_tag')
                    ->alias('at')
                    ->join(['blog_tag'=>'t'],'t.tag_id=at.tag_id')
                    ->where("at.arc_id",$v['arc_id'])
                    ->select();
                //给每篇文章添加评论数字段
                $v['review_count'] = Db::name('review')
                    ->where("arc_id",$v['arc_id'])
                    ->count();
                //给每篇文章添加点赞数字段
                $v['likes'] = Db::name('like')
                    ->where("arc_id",$v['arc_id'])//当前文章
                    ->where('status',1)//已点赞
                    ->count();
                return $v;
            });

     /*   print_r(Db::name('arc_tag')
            ->alias('at')
            ->join(['blog_tag'=>'t'],'t.tag_id=at.tag_id')
            ->where('at.arc_id=$v["arc_id"]')
            ->select());*/
        /*     ->alias('a')arc_tag
             ->leftJoin(['blog_arc_tag'=>'at'],'a.arc_id=at.arc_id')
             ->leftJoin(['blog_tag'=>'t'],'t.tag_id=at.tag_id')
           ->where('article.arc_id', '=', 'tag.tag_id')
             ->order('updatetime', 'desc')
             ->select();*/
//            ->paginate(20);
//        var_dump($articles);
//        exit();
        //todo:分页
        $this->assign([
            'tags' => $tags,
            'cates' => $cates,
            'articles' => $articles,
            'topCates' => $topCates,
            'affiche'=>$affiche,
        ]);
        return $this->fetch('index4');

    }

}
