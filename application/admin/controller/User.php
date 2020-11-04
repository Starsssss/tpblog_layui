<?php

namespace app\admin\controller;


use think\Db;
use think\Exception;
use think\facade\Request;

class User extends Common
{
    public function index()
    {
        echo 122;exit();
        return view();
    }

    public function edit()
    {
        $aid = (int)input('param.aid');
//        echo $aid;exit();
        if (Request::isPost()) {
//            print_r(input('post.'));
            $data = input('post.');
            $tags = $data['tags'];
            unset($data['tags']);
//            halt($tags);

            try {
                Db::transaction(function () use ($aid, $data, $tags) {
                    Db::name('article')->where('arc_id', $aid)->update($data);
//                    echo Db::getLastSql();exit();

                    Db::name('arc_tag')->where('arc_id', $aid)->delete();
                    foreach ($tags as $tag) {

                        Db::name('arc_tag')->insert(['arc_id' => $aid, "tag_id" => $tag]);
                    }
                });
                return json(['code' => 1, 'msg' => '修改成功!', 'data' => []]);
            } catch (Exception $e) {
                return json(['code' => 999, 'msg' => '修改失败! ' . $e->getMessage(), 'data' => []]);
            }
            return;
        }
        //当前文章id的所有信息
        $article = Db::name('article')->find(['arc_id' => $aid]);

        //获取所有标签
        $tags = Db::name('tag')->select();
        //获取原文章所有标签
        $a_tags = array_column(Db::name('arc_tag')->where('arc_id', $aid)->select(), 'tag_id');
//        halt(($a_tags,'tag_id'));

        $this->assign(['article' => $article, 'tags' => $tags, 'aid' => $aid, 'a_tags' => $a_tags]);
        return view();
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
//            print_r($_POST);
            $data = input('post.');
            $tags = $data['tags'];
            unset($data['tags']);
//            halt($tags);

            try {


                Db::transaction(function () use ($data, $tags) {
                    Db::name('article')->insert($data);
                    $arc_id = Db::getLastInsID();
                    foreach ($tags as $tag) {
                        Db::name('arc_tag')->insert(['arc_id' => $arc_id, "tag_id" => $tag]);

                    }
                });
                return json(['code' => 1, 'msg' => '成功!', 'data' => []]);
            } catch (Exception $e) {
                return json(['code' => 999, 'msg' => '数据库异常! ' . $e->getMessage(), 'data' => []]);
            }


//            print_r(input('post.'));return;

            // 获取表单上传文件 例如上传了001.jpgS
            /*  $file = \request()->file('image');
             file_put_contents('111.txt',json_encode($_FILES));
              // 移动到框架应用根目录/uploads/ 目录下
              $info = $file->rule('date')->move( '../public/static/uploads');
              if($info){
                  // 成功上传后 获取上传信息
                  // 输出 jpg
                  echo $info->getExtension();
                  // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                  echo $info->getSaveName();
                  // 输出 42a79759f284b767dfcb2a0197904287.jpg
                  echo $info->getFilename();
              }else{
                  // 上传失败获取错误信息
                  echo $file->getError();
              }*/
//            print_r(input('post.'));
            //todo:文件的上传
            return;
        }
        //获取所有标签
        $tags = Db::name('tag')->select();
        $this->assign('tags', $tags);
        return view();
    }

    public function del()
    {
        //列表页复选框删除
        if (Request::isPost()){
            try{
                $ids=array_column ( $_POST['data'] ,  'arc_id' );
//                halt($ids);
                $result=Db::name('article')->delete($ids);
            }catch (Exception $e) {
                return json(['code' => 999, 'msg' => 'sql语句执行出现错误!']);
            }
            if($result>0){
                return json(['code' => 1, 'msg' => '删除成功!']);
            }else{
                return json(['code' => 0, 'msg' => '删除失败!']);
            }

        }else if(Request::isGet()){//单行删除
           $aid=(int)input('param.aid');
            $nums=Db::name('article')->where('arc_id',$aid)->delete();
            //todo:删除文章下的所有评论和赞   开启事务

            if($nums>0){
                return json(['code'=>1,'msg'=>'删除文章成功']);
            }else{
                return json(['code'=>0,'msg'=>'删除文章失败']);
            }

            return ;
        }
    }

    public function upload()
    {
//        halt($_FILES);
        // 获取表单上传文件 例如上传了001.jpg
        $file = \request()->file('image');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->validate(['size' => 1500, 'ext' => 'jpg,png,gif'])->rule('date')->move('../public/static/uploads');
        if ($info) {
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    /***
     * 功能:ajax修改文章标题
     * GET方式
     * @return \think\response\Json  返回Json数据
     * @throws Exception
     * @throws \think\exception\PDOException
     */
    public function editTitle()
    {
        if (Request::isGet()) {
            Db::name('article')->update(input('get.'));
//            return json(Db::getLastSql());
            return json(['code' => 1, 'msg' => '编辑成功!']);
        }
        return json(['code' => 0, 'msg' => '编辑失败!']);
    }

    /***
     * 作用:ajax搜索文章标题
     * @return array 返回查询标题模糊匹配的结果
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function searchTitle()
    {
        $page = (int)input('post.page');
        $limit = (int)input('post.limit');
        $arc_title = input('post.arc_title.arc_title') ?? '';
//        var_dump(input('post.'));
        $res = Db::name('article')
            ->whereLike('arc_title', "%{$arc_title}%", 'AND')
            ->order('arc_id')
            ->limit(($page - 1) * $limit, $limit)
            ->select();

        foreach ($res as $k => $v) {
            //每篇文章下的评论数
            $res[$k]['review_count'] = Db::name('review')->where('arc_id', $v['arc_id'])->count();
            $res[$k]['likes'] = Db::name('like')->where('arc_id', $v['arc_id'])->count();
        }
        return ['code' => 0, 'count' => Db::name('article')->whereLike('arc_title', "%{$arc_title}%", 'AND')->count(), 'msg' => '', 'data' => $res];
    }
}