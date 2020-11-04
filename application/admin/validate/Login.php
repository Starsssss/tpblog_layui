<?php


namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
    protected $rule = [

        'captcha1|验证码'=>'require|captcha'
    ];
}