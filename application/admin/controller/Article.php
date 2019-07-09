<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\controller\Base;
use think\Db;

class Article extends Base
{

    
    //文章列表
    public function ls(){
        $articles = model('Article')->order(['is_top'=>'desc','id'])->paginate(10);
        $this->assign('articles',$articles);
        return view();
    }
    
    
    //文章编辑
    public function edit(){
        if(request()->isPost()){
            $data = [
                'id' => input('post.id'),
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top'),
                'cate_id' => input('post.cate_id'),
                'desc' => input('post.desc'),
                'content' => input('post.content'),
            ];
            $result = model('Article')->edit($data);
            if($result == 1){
                $this->success("修改成功",url('admin/article/ls'));
            }else{
                $this->error($result);
            }
        }
        $article = Db::name('article')->where('id',input('id'))->find();
        $cates = Db::name('cate')->select();
        $this->assign('cates',$cates);
        $this->assign('article',$article);
        return view();
    }
    
    
    //文章添加
    public function add(){
        if(request()->isPost()){
            $data = [
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top'),
                'cate_id' => input('post.cateid'),
                'desc' => input('post.desc'),
                'content' => input('post.content'),
            ];
            $result = model('Article')->add($data);
            if($result ==1 ){
                $this->success("文章添加成功",url('admin/article/add'));
            }else {
                $this->error($result);
            }
        }
        $cates = model('cate')->select();
        $this->assign('cates',$cates);
        return view();
    }
    
    public function top(){
        $id = input('id');
        $result = model('Article')->top($id);
        if($result == 1){
            $this->success("操作成功",url('admin/article/ls'));
        }else {
            $this->error($result);
        }
    }
    
    //删除文章
    public function del(){
        //$result = Db::name('article')->delete(input('id'));
        $result = model('Article')->del(input('id'));
        if($result){
            $this->success("删除成功",url('admin/article/ls'));
        }else {
            $this->error($result);
        }
    }
}