<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class System extends Model
{
    //软删除
    use SoftDelete;
    
    //系统设置
    public function edit($data){
        $validate = new \app\common\validate\System();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $result = $this->isUpdate(true)->save($data);
        if($result){
            return 1;
        }else {
            return "设置失败";
        }
    }
}