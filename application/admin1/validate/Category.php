<?php

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule=[

        'cate_name'=>'require|min:2',
//        'cate_pid'=>'require|number',
        'cate_sort'=>'require|number',
    ];
    protected $message  =   [
        'cate_name.min'=>'分类名最少4位',
        'cate_name.require'=>'请填写分类名',
        'cate_sort.number'=>'排序必须为数字',
    ];
}
