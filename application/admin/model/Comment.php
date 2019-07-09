<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Comment extends Model
{
    //软删除
    use SoftDelete;
    
    //关联文章
    public function article(){
        return $this->belongsTo('Article','article_id','id');
    }
    
    //关联会员
    public function member(){
        return $this->belongsTo('Member','member_id','id');
    }
    
    //删除评论
    public function del($id){
        $comment = $this->find($id);
        $result = $comment->delete();
  
        if($result){
            return 1;
        }else {
            return "删除失败";
        }
    }
    
    //添加评论
    public function comm($data)
    {
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else {
            return "评论失败";
        }
    }
}