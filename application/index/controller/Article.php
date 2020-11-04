<?php

namespace app\index\controller;

use think\Controller;
use think\Db;

class Article extends Controller
{
    public function index()
    {
        $arc_id = input('param.art_id');
        //获取一级评论
        $reviews = Db::name('review')->alias('r')
            ->where(['rev_pid' => 0, 'arc_id' => $arc_id])
            ->order('rev_time', 'desc')
            ->select();

        //获取评论总数
        $reviews_count = count($reviews);
        //获取点赞数
        $likes = Db::name('like')->where(['arc_id' => $arc_id, 'status' => 1])->count();

//        halt($reviews);
        //获取评论的用户名
        foreach ($reviews as $k => $v) {
            $reviews[$k]['user'] = Db::name('user')
                ->where('u_id', $v['u_id'])
                ->find();
        }
        //获取二级评论
//        $reviews['reply']=0;
        foreach ($reviews as $k => $v) {
            $reviews[$k]['reply'] = Db::name('review')
                ->alias('r')
                ->join(['blog_user' => 'u'], 'u.u_id=r.u_id')
                ->where('arc_id', $arc_id)
                ->where('rev_pid', $v['rev_id'])
                ->order('rev_time', 'desc')//按时间降序排列,最近的最先展示
                ->select();
            foreach ($reviews[$k]['reply'] as $k1 => $v1) {
//                var_dump($v1);
                //获取被回复评论的用户名
                $reviews[$k]['reply'][$k1]['to_username'] = (Db::name('user')
                    ->where('u_id', $v1['to_uid'])
                    ->field('u_username')
                    ->find())['u_username'];
                ++$reviews_count;//回复评论+1
            }
//            halt($reviews[0]['reply']);
//            halt($reviews[0]['user']);

        }


        /*$reviews=Db::name('article')->alias('a')
            ->join(['blog_review'=>'r'],"r.arc_id=a.arc_id")
            ->join(['blog_user'=>'u'],'u.u_id=r.u_id')
            ->where('a.arc_id',$arc_id)
            //->where('rev_pid',0)//筛选出一级评论
            ->select();*/
//        var_dump($reviews);exit();


        //获取顶级分类
        $topCates = Db::name('cate')->where('cate_pid', '=', 0)->all();
        //获取标签数据
        $tags = Db::name('tag')->all();
        //获取分类数据
        $cates = Db::name('cate')->all();
        //获取评论数


        $arc_id = empty(input('param.art_id')) ? 0 : (int)input('param.art_id');
        $article = Db::name('article')->where('arc_id', '=', $arc_id)->find();

        //点击数加1
        Db::name('article')
            ->where('arc_id', $arc_id)
            ->setInc('arc_click');

        $this->assign(['tags' => $tags, 'cates' => $cates, 'topCates' => $topCates]);
        $this->assign([
            'article' => $article,
            'reviews' => $reviews,
            'reviews_count' => $reviews_count,
            'likes'=>$likes
        ]);
        return $this->fetch();


    }
}