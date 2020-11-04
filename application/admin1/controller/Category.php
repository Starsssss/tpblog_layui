<?php

namespace app\admin\controller;

use Arr\Arr\Arr;
use think\Db;
use think\Request;

class Category extends Common
{

    protected $db;
    /* protected  function _initialize(){
         parent::_initialize();
         var_dump(123);
         $this->db=new \app\common\model\Category();
     }*/
    /***
     * 获取分类树状结构
     */
    public function getCateTree($data){
        $obj=new Arr();
        return $obj->tree($data, 'cate_name', 'cate_id', 'cate_pid');
    }


    //首页
    public function index()
    {
        $cates = [];
        //获取栏目数据
//        $cates = Db::name('cate')->select();
        $data =Db::name('cate')->all();
        $cates    =$this->getCateTree($data);
//        halt($cates);
        //赋值到模板
        $this->assign('cates', $cates);
        //加载模板视图
        return $this->fetch();
    }

    //添加分类
    public function store()
    {
        if ($this->request->isPost()) {
//            var_dump(model('Category'));exit();
//            halt(input('post.'));
            $res = model('Category')->store(input('post.'));
//            var_dump($res);exit;
            if ($res['valid']) {
                $this->success($res['msg'], 'index');
            } else {
                $this->error($res['msg']);
            }
        }
        $data =Db::name('cate')->all();
        $obj=new Arr();
        $cates    =$obj->tree($data, 'cate_name', 'cate_id', 'cate_pid');
        $this->assign('cates',$cates);
        //加载模板视图
        return $this->fetch();
    }

    //添加子分类
    public function addSon()
    {
        if ($this->request->isPost()) {
            $res = model('Category')->store(input('post.'));
            if ($res['valid']) {
                $this->success($res['msg'], 'index');
            } else {
                $this->error($res['msg']);
            }
        }

        $cates = Db::name('cate')->field('cate_name')->field('cate_id')->select();
//        halt($cates);

        //赋值到模板
        $this->assign('cates', $cates);

        $cate_id = $this->request->param('cate_id');
        $res = model('Category')->whereColumn('cate_id', '=', $cate_id)->findOrFail();
        $this->assign('cate', $res);
        return $this->fetch('addSon');
    }

    public function a()
    {

        $data =Db::name('cate')->all();
        $obj=new Arr();
        $d    =$obj->tree($data, 'cate_name', 'cate_id', 'cate_pid');
        halt($d);
       /* $result = Db::name('cate')->whereColumn('cate_pid', '=', 0)->all();
        halt($result);
        static $cateTree = array();
        foreach ($result as $item) {
            //把它所有的子类
            $currCateId=$item['cate_pid'];
            $result = Db::name('cate')->whereColumn('cate_pid', '=', $currCateId)->all();
        }*/
    }

//    function tree($pid=0,&$res=[],$space=''){
//        //获取同一级分类
//        $space='#'.$space;
////        /*$sql = "select distinct * from deepcate where pid=$pid";
////        $result = $mysqli->query($sql);*/
//        $result=Db::name('cate')->whereColumn('cate_pid','=',$pid)->all();
//        if ($result->rowCount() > 0) {
//            while ($row = $result->nextRowset()) {
//                $row['catename']=$space.$row['cate_name'];
//                $res[] = $row;
//                tree($row['id'], $res, $space,$mysqli);
//            }
//        }
//    }
}