<?php
namespace app\admin\controller;

class System extends Base
{
    //系统设置
    public function edit(){
       
        if(request()->isPost()){
            $data = [
                'id' => input('post.id'),
                'webname' => input('post.webname'),
                'copyright' => input('post.copyright')
            ];
            //dump($data);die;
            $result = model('System')->edit($data);
            if($result==1){
                $this->success("设置成功",url('admin/system/edit'));
            }else {
                $this->error($result);
            }
        }
       
        $system = model('System')->order('id','asc')->find();
        //dump($system['webname']);die;
        $this->assign('system',$system);
        return view();
    }
}