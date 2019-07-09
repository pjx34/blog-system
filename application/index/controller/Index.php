<?php
namespace app\index\controller;

use think\Controller;
use app\admin\controller\Base;
use app\admin\model\Cate;
use app\admin\model\System;
use app\admin\model\Article;
use app\admin\model\Member;
use think\Db;

class Index extends Base
{
    //首页
    public function index()
    {   
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
        $article = new Article();
        $articles = $article->where($where)->order('create_time','desc')->paginate(7);
        foreach ($systems as $system)
        $topArticles = $article->where('is_top',1)->limit(3)->select();
        $viewData = [
            'cates' => $cates,
            'system' => $system,
            'articles' => $articles,
            'catename' => $catename,
            'topArticles' => $topArticles,
        ];
        $this->assign($viewData);
        return view();
    }
    
    //注册
    public function register(){
        if(request()->ispost()){
            $data = input('post.');
            $member = new Member();
            $result = $member->register($data);
            if($result==1){
                $this->success("注册成功",url('index/index/login'));
            }else {
                $this->error($result);
            }
        }
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
        $article = new Article();
        $articles = $article->where($where)->order('create_time','desc')->paginate(7);
        foreach ($systems as $system)
            $topArticles = $article->where('is_top',1)->limit(3)->select();
            $viewData = [
                'cates' => $cates,
                'system' => $system,
                'articles' => $articles,
                'catename' => $catename,
                'topArticles' => $topArticles,
            ];
            $this->assign($viewData);
            return view();
    }
    
    //用户登录
    public function login()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $member = new Member();
            $result = $member->login($data);
            if($result == 1){
                $this->success("登陆成功",url('index/index/index'));
            }else {
                $this->error("登录失败");
            }
        }
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
        $article = new Article();
        $articles = $article->where($where)->order('create_time','desc')->paginate(7);
        foreach ($systems as $system)
            $topArticles = $article->where('is_top',1)->limit(3)->select();
            $viewData = [
                'cates' => $cates,
                'system' => $system,
                'articles' => $articles,
                'catename' => $catename,
                'topArticles' => $topArticles,
            ];
            $this->assign($viewData);
            return view();
    }
    
    //退出登录
    public function loginout()
    {
        session('index',null);
        if(session('index')){
            $this->error("退出失败");
        }else {
            $this->success("退出成功",url('index/index/index'));
        }
    }
    
    //搜索
    public function search()
    {
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
        $where1[] = [];
        $where2[] = [];
        $article = new Article();
        $articles = Db::name('Article')->where('title','like','%'.input('keyword').'%')->whereOr('content','like','%'.input('keyword').'%')->paginate(10);
        foreach ($systems as $system)
            $topArticles = $article->where('is_top',1)->limit(3)->select();
            $viewData = [
                'cates' => $cates,
                'system' => $system,
                'articles' => $articles,
                'catename' => $catename,
                'topArticles' => $topArticles,
            ];
            $this->assign($viewData);
            return view('index');
        

    }
}
