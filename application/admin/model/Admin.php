<?php 
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;
use app\common\validate\Adminvalidate;

class Admin extends Model{
    //软删除
    use SoftDelete;
    
    //登录校验
    public function login($data){
        $validate = new Adminvalidate();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        $result = $this->where('username',$data['username'])->find();
        if($result){
            if($result['status']==0){
                return "此用户已被禁用";
            }
            if($data['password'] == $result->password){
                $sessionData = [
                    'id' => $result['id'],
                    'nickname' => $result['nickname'],
                    'is_super' => $result['is_super']
                ];
                session('admin',$sessionData);
                return "1";
            }else{
                return "密码错误";
            }
        }else{
            return "用户名不存在";
        }
    }

    //注册账户
    public function register($data){
        if($data['password'] != $data['conpass']){
            return "密码不一致";
        }else{
            $validate = new Adminvalidate();
            if(!$validate->scene('register')->check($data)){
                return $validate->getError();
            }
            $result = $this->allowField(true)->save($data);
            if($result){
                return 1;
            }else {
                return "注册失败";
            }
        }
      
    }
    
    //添加管理员
    public function add($data){
        if($data['password']!=$data['conpass']){
            return "密码不一致";
        }
        $validate = new Adminvalidate();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $data["password"] = md5($data["password"]);
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return "添加失败";
        }    
    }
    
    //启用|禁用管理员
    public function status($id){
        $admin = $this->find($id);
        if($admin->status==0){
            $admin->status =1;
        }else {
            $admin->status =0;
        }
       $result =  $admin->save();
       if($result){
           return 1;
       }else{
           return "操作失败";
       }
    }
    
    //编辑管理员
    public function edit($data){
        $validate = new \app\common\validate\Adminvalidate();
        if(!$validate->scene("edit")->check($data)){
            return $validate->getError();
        }
        $admin = $this->find($data['id']);
        if($admin->password != $data['oldpass']){
            return "密码错误";
        }
        $result = $this->allowField(true)->isUpdate(true)->save($data);
        if($result==1||$result==0){
            return 1;
        }else{
            return "修改失败";
        }
    }
    
    //管理员删除
    public function del($id){
        $admin = $this->find($id);
        $result = $admin->delete();
        if($result){
            return 1;
        }else{
            return "删除失败";
        }
    }
}
?>