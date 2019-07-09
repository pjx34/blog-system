<?php
namespace app\common\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'username' => 'require|unique',
        'password' => 'require',
        'conpass' => 'require|confirm:password',
        'nickname' => 'require',
        'email' => 'email|require',
        'verify' => 'captcha|require'
    ];
    
    protected $scene = [
        'add' => ['username','password','nickname','email'=>'email'],
        'edit' => ['username','password','nickname','email'=>'email','oldPass'=>'require'],
        'register' => ['username','password','nickname','email','conpass','verify'],
        'login' => ['username'=>'require','password','verify'],
        ];
}