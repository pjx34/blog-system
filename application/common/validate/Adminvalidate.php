<?php
namespace app\common\validate;

use think\Validate;

class Adminvalidate extends Validate{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'oldpass' => 'require',
        'conpass' => 'require|confirm:password',
        'nickname' => 'require',
        'email' => 'require|email'
    ];
    
  
    protected $scene = [
        'login' => ['username','password'],  //登录验证场景
        'register' => ['username','password','conpass','email'],//注册验证场景
        'add' => ['username','password','conpass','email'],
        'edit' => ['username','password','nickname','oldpass']
    ];
    
}