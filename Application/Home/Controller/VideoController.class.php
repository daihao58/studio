<?php

namespace Home\Controller;

use Think\Controller;

class VideoController extends Controller{
    public function index(){
        $model=M('Video');
        $count  = $model->count();// 查询满足要求的总记录数
        $Page = new \Extend\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $data = $model->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('data', $data);
        $this->assign('page',$show);
        $this->display();
    }

    public function single($id){
        $model=M('Video');
        $data=$model->where("id= '$id' ")->find();
        $this->assign('url',$data['url']);
        $this->assign('data',$data);
        $this->display();
    }
}
