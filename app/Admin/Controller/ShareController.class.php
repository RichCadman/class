<?php
namespace Admin\Controller;
class ShareController extends BaseController {
	//分享页面
    public function index(){
    	$share=M("share")->find();

    	$this->assign("share",$share);
    	$this->display();
    }

    //添加分享
	public function add_do(){
		$info = M("share")->select();
		if($info){
			echo "<script type='text/javascript'>alert('数据已存在,重复添加');window.location='/admin.php/Share/index';</script>";
		}else{
			$data['content']=$_POST['content1'];
			$data['time']=time();
			$res = M("share")->add($data);
			if($res){
				echo "<script type='text/javascript'>alert('添加成功');window.location='/admin.php/Share/index';</script>";
			}else{
				echo "<script type='text/javascript'>alert('添加失败');window.history.back();</script>";
			}
		}
		
	}
	//修改分享内容
	public function mod_do(){
		$id=$_GET['id'];
		if(!$id){
			echo "<script type='text/javascript'>alert('请先添加内容');window.location='/admin.php/Share/add';</script>";
		}else{
			$data['content']=$_POST['content1'];
			$data['time']=time();
			$res = M("share")->where("id=$id")->save($data);
			if($res){
				echo "<script type='text/javascript'>alert('修改成功');window.history.go(-1);</script>";
			}else{
				echo "<script type='text/javascript'>alert('修改失败');window.history.back();</script>";
			}
		}
	}
}























