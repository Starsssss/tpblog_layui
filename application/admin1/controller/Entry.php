<?php
namespace app\admin\controller;

class Entry extends Common
{
    //首页
    public  function index(){
        //加载模板视图
        return $this->fetch();
    }
}