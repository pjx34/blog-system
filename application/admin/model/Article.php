<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;
use think\Db;

class Article extends Model
{
    //软删除
    use SoftDelete;
    
    //关联评论
//     public function comments(){
//         return $this->hasMany('Comment','article_id','id');
//     }
    
    //关联栏目表
    public function cate(){
        return $this->belongsTo('Cate','cate_id','id');
    }
    
    //文章添加
    public function add($data){
        //$result = $this->allowField(true)->save($data);
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else {
            return "文章添加失败";
        }
    }
    
    //文章推荐
    public function top($id){
        $article = Db::name('article')->where('id',$id)->find();
        if($article['is_top'] == 1){
            $article['is_top'] = 0;
        }else{
            $article['is_top'] =1;
        }
        $result = Db::name('article')->update($article);
        if($result){
            return 1;
        }else {
            return "操作失败";
        }
    }
    
    //文章编辑
    public function edit($data){
        $result = Db::name('article')->update($data);
        if($result ==1 ||$result == 0){
            return 1;
        }else{
            return "修改失败";
        }
    }
    
    //文章删除
    public function del($id){
        $article = $this->find($id);
        $result = $article->delete();
        $comments = model('Comment')->where('article_id',$article->id)->select();
       // dump($comments);die;
        foreach ($comments as $v){
            $v->delete();
        }
        if($result){
            return 1;
        }else {
            return "删除文章失败";
        }
    }
}