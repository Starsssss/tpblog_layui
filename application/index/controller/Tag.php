<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Tag extends Controller
{
    public function index()
    {
        //获取顶级分类
        $topCates = Db::name('cate')->where('cate_pid', '=', 0)->all();
        //获取标签数据
        $tags = Db::name('tag')->all();
        //获取分类数据
        $cates = Db::name('cate')->all();

        //最新文章
        $tag_id=input('param.tag_id');
        /*$articles = Db::name('article')->alias('a')
            ->join(['blog_cate' => 'c'], 'a.cate_id=c.cate_id')
            ->select();*/

        //找到该标签下的所有文章id===>分页
        $res=Db::name('arc_tag')->where('tag_id',$tag_id)->select();
        $art_id_arr=[];
        foreach ($res as $item) {
            $art_id_arr[]=$item['arc_id'];
        }




        $articles = Db::name('article')
            ->whereIn('arc_id',$art_id_arr)
            ->paginate(2)->each(function ($v) use ($tag_id){
                $v['tags'] = Db::name('arc_tag')
                    ->alias('at')
                    ->join(['blog_tag'=>'t'],'t.tag_id=at.tag_id')
                    ->where("at.arc_id",$v['arc_id'])
                    ->select();
                //给每篇文章添加评论数字段
                $v['review_count'] = Db::name('review')
                    ->where("arc_id", $v['arc_id'])
                    ->count();
                //给每篇文章添加点赞数字段
                $v['likes'] = Db::name('like')
                    ->where("arc_id", $v['arc_id'])//当前文章
                    ->where('status', 1)//已点赞
                    ->count();
                return $v;

            });

//        halt($articles->items());



        /*$articles = Db::name('article')->alias('a')
            ->join(['blog_cate' => 'c'], 'a.cate_id=c.cate_id')
            ->paginate(2)->each(function ($item) use ($tag_id){
                $item['tags'] = Db::name('arc_tag')
                    ->alias('at')
                    ->join(['blog_tag'=>'t'],'t.tag_id=at.tag_id')
                    ->where("at.arc_id",$item['arc_id'])
                    ->select();
                foreach ($item['tags']  as $tag) {
                    if($tag['tag_id']==$tag_id){
                        print_r($item);echo '<br>';
                        return $item;
                    }

                }

            });
        halt($articles->items());*/



      /*  foreach ($articles as $k => $v) {
            $articles[$k]['tags'] = Db::name('arc_tag')
                ->alias('at')
                ->join(['blog_tag'=>'t'],'t.tag_id=at.tag_id')
                ->where("at.arc_id",$v['arc_id'])
                ->select();
        }*/

//        halt($articles[0]);
        //过滤掉不属于本标签的文章
      /*  foreach ($articles as $k => $v){
            foreach ($v['tags'] as $v1){

            }

        }*/
       /* $articles=array_filter($articles,function ($article) use ($tag_id){
             foreach ($article['tags'] as $v1) {
                if($v1['tag_id']==$tag_id){
                    return true;
                }
             }
            return false;
        });*/

        $this->assign(['tags' => $tags, 'cates' => $cates, 'articles' => $articles, 'topCates' => $topCates]);
        return $this->fetch('index');
    }
}
