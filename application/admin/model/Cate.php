<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;
use app\common\validate\Catevalidate;
use think\Db;

class Cate extends Model
{
    use SoftDelete;
    
    //关联文章
//     public function article(){
//         $this->hasMany('Article','article_id',id);
//     }
    
    //栏目添加
    public function add($data){
        $validate =  new Catevalidate();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->isUpdate(false)->save($data);
        //dump($result);die;
        if($result){
            return 1;
        }else {
            return "添加失败";
        }
    }
    
    public function sort($data){
            //$cate = Db::name('cate')->select($data['id']);
//             $validate = new Catevalidate();
//             if(!$validate->check($data)){
//                 return $validate->getError();
//             }
            $result = Db::name('cate')->where('id',$data['id'])->update(['sort'=>$data['sort']]);
            if($result==1||$result == 0){
                return 1;
            }else {
                return "添加失败";
            }
    }
    
    //编辑栏目
    public function edit($data){
        $result = Db::name('cate')->where('id',$data['id'])->update(['catename'=>$data['catename']]);
        if($result==0||$result==1){
            return 1;
        }else {
            return "添加失败";
        }
    }
    
    //删除栏目
    public function del($id){
        $cate = $this->find($id);
        $result = $cate->delete();
        $articles = model('Article')->where('cate_id',$id)->select();
        foreach ($articles as $article){
            $comments = model('Comment')->where('article_id',$article->id)->select(); 
            $article->delete();
            foreach($comments as $comment){
                $comment->delete();
            }
        }

        if($result){
            return 1;
        }else{
            return "删除失败";
        }
    }
    
    
}