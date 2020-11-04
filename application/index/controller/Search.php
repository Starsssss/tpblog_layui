<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;
use think\facade\Session;


class Search extends Common
{
    public function index()
    {
//        halt(input('post.'));
        if (Session::has('q')) {//已经搜索了
            $q = (Session::get('q'));
            $res = Db::name('article')->where('arc_title', 'like', "%{$q}%")
                ->paginate(2)->each(function ($v, $key) {
                    //给每篇文章添加标签字段
                    $v['tags'] = Db::name('arc_tag')
                        ->alias('at')
                        ->join(['blog_tag' => 't'], 't.tag_id=at.tag_id')
                        ->where("at.arc_id", $v['arc_id'])
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
//            halt($res->items());

            $this->assign('res', $res);
            return $this->fetch();
        } else {
            $this->error('请输入搜索结果', 'index/index/index');
        }
        echo 'index__';

    }

    public function sear()
    {
        if (Request::isPost()) {
            session('q', input('post.title'));//搜索结果
        }
        $this->redirect('/index/search/index');
    }

}
