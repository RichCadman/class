<?php
namespace Admin\Controller;
class IndexController extends BaseController {
	//学生首页
    public function index(){
    	$student=M("student")->order("last_punch_time desc")->select();

    	$this->assign("student",$student);
    	$this->display();
    }

    //
}