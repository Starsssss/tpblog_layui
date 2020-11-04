<?php
namespace app\common\model;

use think\Db;
use think\Model;

class Category extends Model
{
    protected $pk='cate_id';//默认主键为id，如果你没有使用id作为主键名，需要在模型中设置属性
    protected $table='blog_cate';//要写完整的表名
    public function store($data){
        //验证数据合法性
        $validate=(new \app\admin\validate\Category);
        $res=$validate->check($data);
        if(!$res){//验证不通过
            return ['valid'=>0,'msg'=>$validate->getError()];
        }

        //验证通过存入数据库

        if($this->allowField(true)->save($_POST)){
            return ['valid'=>1,'msg'=>'新增分类成功!'];
        }
//        var_dump($this->save());exit();
//        var_dump(Db::name('cate')->insert($data));
//        return $data;
    }

    //获取该类下所有分类
    public function getSubCate($pid)
    {
        static $cates=array();
        $cates[]=(int)$pid;
        $res=Db::name('cate')->where('cate_pid','=',$pid)->select();

        foreach ($res as $k => $v) {
            $this->getSubCate($v['cate_id']);
        }
        return $cates;
    }
    public function aaaa(){
        return'123';
    }
}