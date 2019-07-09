<?php
namespace app\admin\controller;

use think\Controller;
use app\common\model\Admin;

class Index extends Controller
{
    //重复登录过滤
    public function _initialize(){
        if(session('admin.id')){
            $this->redirect('admin/home/index');
        }
    }
    
    //后台登录
    public function login(){
        if(request()->isPost()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->login($data);
            if($result == 1){
                $this->success("登录成功",url('admin/home/index'));
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //用户注册
    public function register(){
        if(request()->isPost()){
            $data = [
                'username' => input('username'),
                'password' => input('password'),
                'conpass' => input('conpass'),
                'nickname' => input('nickname'),
                'email' => input('email'),
            ];
            $result = model('Admin')->register($data);
            if($result == 1){
                $this->success("注册成功",url('admin/index/login'));
            }else{
                $this->error($result);
            }
        }
        return view();
    }
    
    public function index(){
        return view();
    }
}