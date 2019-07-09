<?php
namespace app\admin\controller;

use think\helper\hash\Md5;

class Admin extends Base
{
    //管理员列表
    public function ls(){
        $admins = model('Admin')->order(['is_super'=>'desc','status'=>'desc','id'=>'asc'])->paginate(10);
        $this->assign('admins',$admins);
        return view();
    }
    
    //管理员添加
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $result = model('Admin')->add($data);
            if($result==1){
                $this->success("添加成功",url('admin/admin/ls'));
            }else {
                $this->error($result);
            }
        }
     
        return view();
    }
    
    //启用|禁用管理员
    public function status(){
        $result = model('Admin')->status(input('id'));
        if($result==1){
            $this->redirect('admin/admin/ls');
        }else{
            $this->error($result);
        }
    }
    
    //编辑管理员
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            //dump($data);die;
            $result = model('Admin')->edit($data);
            if($result==1){
                $this->success("修改成功",url('admin/admin/ls'));
            }else {
                $this->error($result);
            }
        }
        $admin = model('Admin')->find(input('id'));
        $this->assign('admin',$admin);
        return view();
    }
    
    //删除管理员
    public function del(){
        $result = model('Admin')->del(input('id'));
        if($result==1){
            $this->redirect('admin/admin/ls');
        }else{
            $this->error($result);
        }
    }
}