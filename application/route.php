<?php
use think\Route;

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//前台路由
    Route::rule('index/cate/:id','index/index/index','get');
    Route::rule('','index/index/index','get|post');
    Route::rule('article/detail/:id','index/article/detail','get');
    Route::rule('article/comm','index/article/comm','post');
    Route::rule('index/register','index/index/register','get|post');
    Route::rule('index/login','index/index/login','get|post');
    Route::rule('index/loginout','index/index/loginout','get|post');
    Route::rule('index/search','index/index/search','get|post');
  

//后台路由
Route::group('admin',function (){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('index/login','admin/index/login','get|post');
    Route::rule('index/register','admin/index/register','get|post');
    Route::rule('index/index','admin/index/index','get|post');
    Route::rule('home/index','admin/home/index','get|post');
    Route::rule('loginout','admin/home/loginout','get|post');
    Route::rule('cate/ls','admin/cate/ls','get');
    Route::rule('cate/add','admin/cate/add','get|post');
    Route::rule('cate/sort','admin/cate/sort','get|post');
    Route::rule('cate/edit/[:id]','admin/cate/edit','get|post');
    Route::rule('cate/delete/:id','admin/cate/delete','get');
    Route::rule('article/ls','admin/article/ls','get|post');
    Route::rule('article/add','admin/article/add','get|post');
    Route::rule('article/top/:id','admin/article/top','get|post');
    Route::rule('article/edit/[:id]','admin/article/edit','get|post');
    Route::rule('article/del/[:id]','admin/article/del','get|post');
    Route::rule('member/ls','admin/member/ls','get|post');
    Route::rule('member/add','admin/member/add','get|post');
    Route::rule('member/edit/[:id]','admin/member/edit','get|post');
    Route::rule('member/del/[:id]','admin/member/del','get|post');
    Route::rule('admin/ls','admin/admin/ls','get|post');
    Route::rule('admin/add','admin/admin/add','get|post');
    Route::rule('admin/status/:id','admin/admin/status','get|post');
    Route::rule('admin/edit/[:id]','admin/admin/edit','get|post');
    Route::rule('admin/del/:id','admin/admin/del','get|post');
    Route::rule('comment/ls','admin/comment/ls','get|post');
    Route::rule('comment/del/:id','admin/comment/del','get|post');
    Route::rule('system/edit','admin/system/edit','get|post');
});