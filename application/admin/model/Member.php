<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;
    
    //会员添加
    public function add($data){
        $validate = new \app\common\validate\Member();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else {
            return "会员添加失败";
        }
    }
    
    //会员编辑
    public function edit($data){
        $validate = new \app\common\validate\Member();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $member = $this->find($data['id']);
        if($member->password == $data['oldPass']){
           $result = $this->allowField(true)->isUpdate(true)->save($data);
        }else {
            return "原密码错误";
        }
        if($result){
            return 1;
        }else{
            return "修改失败";
        }
    }
    
    //会员删除
    public function del($id){
        $member = $this->find($id);
        $result = $member->delete();
        if($result){
            return 1;
        }else{
            return "删除失败";
        }
    }
    
    //会员注册
    public function register($data)
    {
        $validate = new \app\common\validate\Member();
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
    
    //会员登录
    public function login($data)
    {
        $validate = new \app\common\validate\Member();
        if(!$validate->scene('login')->check($data))
        {
            return $validate->getError();
        }
        unset($data['verify']);
        $result = $this->where($data)->find();
      
        if($result)
        {
            $sessionData = [
                'id' => $result->id,
                'nickname' => $result->nickname,
            ];
            session('index',$sessionData);
            return 1;
        }else 
        {
            return "登录失败";
        }
    }
}