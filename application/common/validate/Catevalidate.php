<?php
namespace app\common\validate;

use think\Validate;

class Catevalidate extends Validate
{
    protected $rule = [
        'catename' => 'require|unique:cate',
        'sort' => 'require'
    ];
    
    protected $scene = [
        'add' => ['catename','sort'],
    ];
    
}