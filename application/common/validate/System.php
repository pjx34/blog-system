<?php
namespace app\common\validate;

use think\Validate;

class System extends Validate
{
    protected $rule = [
      'webname' => 'require',
        'copyright' => 'require',
    ];
    
    protected $scene = [
        'edit' => ['webname','copyright'],
    ];
}