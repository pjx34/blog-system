<?php
namespace app\admin\controller;

class Member extends Base
{
    //会员列表
    public function ls(){
        $members = model('Member')->order('create_time')->paginate(6);
        $this->assign('members',$members);
        return view();
    }
    
    //会员添加
    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $result = model('Member')->add($data);
            if($result==1){
                $this->success("会员添加成功",url('admin/member/ls'));
            }else {
                $this->error($result);
            }
        }
        return view();
    }
    
    //会员编辑
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            $result = model('Member')->edit($data);
            if($result==1){
                $this->success("修改成功",url('admin/member/ls'));
            }else {
                $this->error("修改失败");
            }
        }
        $member = model('member')->find(input('id'));
        $this->assign('member',$member);
       return view();
    }
    
    //会员删除
    public function del(){
        $id = input('id');
        //dump($id);die;
        $result = model('Member')->del($id);
        if($result==1){
            $this->success("删除成功",url('admin/member/ls'));
        }else{
            $this->error($result);
        }
    }
}