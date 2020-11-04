<?php


namespace app\index\validate;


use think\Validate;

class Login extends Validate
{
    protected $rule=[

        'username'=>'require',
        'password'=>'require',
        'captcha'=>'require|captcha',
    ];
    protected $message  =   [
        'captcha.captcha' => '验证码输入错误',
    ];
}