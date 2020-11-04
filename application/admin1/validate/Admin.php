<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule=[

        'admin_username'=>'require|max:25|min:4',
        'admin_password'=>'require|min:4',
        'admin_code'=>'require|captcha',
    ];
    protected $message  =   [
        'admin_username.max' => '最多25位',
        'admin_password.min'=>'最少4',
    ];
}
