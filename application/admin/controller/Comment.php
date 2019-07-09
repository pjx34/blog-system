<?php
namespace app\admin\controller;

class Comment extends Base
{
    //评论列表
    public function ls(){
        $comments = model('Comment')->with('article','member')->order('id','desc')->paginate(10);
        //dump($comments);die;
        $this->assign('comments',$comments);
        return view();
    }
    
    //评论删除
    public function del(){
        //dump(input('id'));die;
        $result = model('comment')->del(input('id'));
        if($result==1){
            $this->redirect('admin/comment/ls');
        }else {
            $this->error($result);
        }
    }
}