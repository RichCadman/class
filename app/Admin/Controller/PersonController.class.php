<?php
namespace Admin\Controller;
class PersonController extends BaseController {
	//用户
    public function index(){
    	$admin=M("admin")->select();

    	$this->assign("admin",$admin);
    	$this->display();
    }

    //添加页面
    public function add(){

    	$this->display();
    }

    //添加
    public function add_do(){
    	$data['admin']=$_POST['username'];
    	$data['password']=md5($_POST['password']);
    	$res=M("admin")->add($data);
    	if($res){
    		echo "<script type='text/javascript'>alert('添加成功');window.location='/admin.php/Person/add'; </script>";
    	}else{
    		echo "<script type='text/javascript'>alert('失败,服务器繁忙,请稍后再试');window.history.back(); </script>";
    	}
    }

    //修改用户页面
    public function mod($id){
    	$person=M("admin")->where("id='$id'")->find();

    	$this->assign("person",$person);
    	$this->display();
    }

    //修改
    public function mod_do($id){
    	$data['admin']=$_POST['username'];
    	$data['password']=md5($_POST['password']);
    	$res=M("admin")->where("id='$id'")->save($data);
    	if($res){
    		echo "<script type='text/javascript'>alert('修改成功');window.location='/admin.php/Person/index'; </script>";
    	}else{
    		echo "<script type='text/javascript'>alert('失败,服务器繁忙,请稍后再试');window.history.back(); </script>";
    	}
    }

    //删除用户
    public function del($id){
    	$res=M("admin")->where("id='$id'")->delete();
    	if($res){
    		echo "<script type='text/javascript'>alert('删除成功');window.location='/admin.php/Person/index'; </script>";
    	}else{
    		echo "<script type='text/javascript'>alert('失败,服务器繁忙,请稍后再试');window.history.back(); </script>";
    	}
    }
}