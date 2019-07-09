<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\Cate;
use app\admin\model\System;
use app\admin\model\Comment;
use app\admin\model\Member;

class Article extends Controller
{
    //文章详情
    public function detail()
    {

        $article = new \app\admin\model\Article();
        $article = $article->where('id',input('id'))->find();
        $article->setInc('click');
        $where = [];
        
        $cate = new Cate();
        $cates = $cate->select();
        if(input('id')){
            $where = [
                'cate_id' => input('id'),
            ];
            $catename = $cate->where('id',input('id'))->value('catename');
        }else {
            $catename = "";
        }
        $system = new System();
        $systems = $system->select();
        $comment = new Comment();
        $comments = $comment->where('article_id',input('id'))->select();
        $member = new Member();
        $members = $member->select();
        foreach ($systems as $system)
            $topArticles = $article->where('is_top',1)->limit(3)->select();
            $viewData = [
                'cates' => $cates,
                'system' => $system,
                'article' =>$article,
                'catename' => $catename,
                'topArticles' => $topArticles,
                'comments' => $comments,
                'members' => $members,
            ];
        $this->assign($viewData);
        return view();
    }
    
    //文章评论
    public function comm()
    {
        if(session('index.id')){
            $data = input('post.');
            $comment = new Comment();
            $result = $comment->comm($data);
            if($result==1){
                $this->success("评论成功",url("index/article/detail/".$data['article_id']));
            }else {
                $this->error("未登录");
            }
        }else{
            $this->error("未登录");
        }
    }
}