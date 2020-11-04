<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function ff($data){
    return $data.' =>by common';
}


/*网上封装好基于tp的缩略图函数*/
// $src = ''      原图来源
// $width = 500   宽
// $height = 500  高
// $type = 1
// $replace = false

function thumb($src = '', $width = 500, $height = 500, $type = 1, $replace = false) {

    $src = './'.$src;
    // 图片存在就生成缩略图
    if(is_file($src) && file_exists($src)) {

        //uploads/2020/  logo_01  .  png

        $ext = pathinfo($src, PATHINFO_EXTENSION);
        $name = basename($src, '.'.$ext);
        $dir = dirname($src);
        $thumb_dir = dirname($src).'/'.'thumbs'.'/'.$name;//缩略图存放在与原图同名的目录
        if(!file_exists($thumb_dir)){
            mkdir($thumb_dir,0777,true);
        }

//        echo($dir);exit();
        if(in_array($ext, array('gif','jpg','jpeg','bmp','png'))) {
            $name = $name.'_thumb_'.$width.'_'.$height.'.'.$ext;
//            echo($thumb_dir); exit();
            $file = $dir.'/'.$name;
            $thumb_file=$thumb_dir.'/'.$name;

            if(!file_exists($thumb_file) || $replace == TRUE) {
                $image = \think\Image::open($src);
                $image->thumb($width, $height, $type);
                 $image->save($thumb_file);
            }
            $thumb_file=str_replace("\\","/",$thumb_file);
            $thumb_file = '/'.trim($thumb_file,'./');
            return $thumb_file;//返回缩略图存放的路径
        }
    }
    // 图片不存在 显示默认图
//    $src=str_replace("\\","/",$src);
    $src = '/static/home/imagespic.gif';
    return $src;
}
/*function thumb($src = '', $width = 500, $height = 500, $type = 1, $replace = false) {

    $src = './'.$src;
    // 图片存在就生成缩略图
    if(is_file($src) && file_exists($src)) {

        //uploads/2020/  logo_01  .  png

        $ext = pathinfo($src, PATHINFO_EXTENSION);//获得文件后缀名
        $name = basename($src, '.'.$ext);//获取文件名部分
        $dir = dirname($src);//获取当前目录
        if(in_array($ext, array('gif','jpg','jpeg','bmp','png'))) {
            $name = $name.'_thumb_'.$width.'_'.$height.'.'.$ext;
            $file = $dir.'/'.$name;//原来的缩略图不存在,则创建
            if(!file_exists($file) || $replace == TRUE) {
                $image = \think\Image::open($src);
                $image->thumb($width, $height, $type);
                $image->save($file);
            }
            $file=str_replace("\\","/",$file);
            $file = '/'.trim($file,'./');
            return $file;
        }
    }
    // 图片不存在 显示默认图
//    $src=str_replace("\\","/",$src);
    $src = '/static/home/imagespic.gif';
    return $src;
}*/



//设置报错级别--by William
/*error_reporting(E_ERROR | E_PARSE );*/