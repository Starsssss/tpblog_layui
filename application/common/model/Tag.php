<?php
namespace app\common\model;

use think\Db;
use think\Model;

class Tag extends Model
{
    protected $pk='tag_id';//默认主键为id，如果你没有使用id作为主键名，需要在模型中设置属性
    protected $table='blog_tag';//要写完整的表名
    public function store($data){
        //验证数据合法性
        $validate=(new \app\admin\validate\Tag);
        $res=$validate->check($data);
        if(!$res){//验证不通过
            return ['valid'=>0,'msg'=>$validate->getError()];
        }

        //验证通过存入数据库

        if($this->allowField(true)->save($_POST)){
            return ['valid'=>1,'msg'=>'新增标签成功!'];
        }
    }
    public function edit($data){

//        halt($data);
        //验证数据合法性
        $tag_id=input('param.tag_id');
        $bool=($this->whereColumn('tag_id','=',$tag_id)->find());;
//        var_dump($bool);exit();
        if (!$bool){
            return ['valid'=>0,'msg'=>'参数异常!'];
        }

        //验证通过存入数据库
        if($this->allowField(true)->save($_POST,['tag_id' => $data['tag_id'],'tag_name' => $data['tag_name']])){
            return ['valid'=>1,'msg'=>'修改标签成功!'];
        }else{
            return ['valid'=>0,'msg'=>'修改标签失败!'];
        }
    }
}