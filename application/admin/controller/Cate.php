<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Db;

class Cate extends Base
{
    //栏目列表
    public function ls(){
        $cates = model('cate')->order('sort','asc')->paginate(10);
        $this->assign('cates',$cates);
        return $this->fetch();
    }
    
    //栏目添加
    public function add(){
        if(request()->isPost()){
            $data = [
                'catename' => input('catename'),
                'sort' => input('sort')
            ];
            
            $result = model('Cate')->add($data);
            if($result == 1){
                $this->success("添加成功",url('admin/cate/ls'));
            }
        }
        return view();
    }
    
    //栏目排序
    public function sort(){
      $data = [
          'id' => input('post.id'),
          'sort' => input('post.sort'),
      ];
        $result = model('Cate')->sort($data);
        if($result == 1){
            //$this->success("排序成功",url('admin/cate/ls'));
            $this->redirect('admin/cate/ls');
        }
    }
    
    //栏目编辑
    public function edit(){
        if(request()->post()){
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
   
        $result = model('Cate')->edit($data);
        if($result ==1 ){
            $this->success("修改成功",url('admin/cate/ls'));
        }else{
            $this->error($result);
            }
        }
        $cateInfo = Db::name('cate')->where('id',input('id'))->select();
        $viewData = [
            'cateInfo' => $cateInfo,
        ];
        $this->assign($viewData);
        return view();
    }
    
    //删除栏目
    public function delete(){
        $id = input('id');
        $result = model('Cate')->del($id);
        if($result == 1){
            $this->success("删除成功",url('admin/cate/ls'));
        }else {
            $this->error($result);
        }
    }
}