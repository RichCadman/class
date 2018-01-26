<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	//登录首页
    public function index(){
    	unset($_SESSION['admin']);
    	$this->display();
    }

    //登录验证
    public function login_do(){
    	$admin=$_POST['admin'];
    	$password=md5($_POST['password']);
    	$res=M("admin")->where("admin='$admin' and password='$password'")->find();
    	if($res){
    		$_SESSION['admin']=$res;
    		echo "<script type='text/javascript'>window.location='/admin.php/Index/index'; </script>";
    	}else{
    		echo "<script type='text/javascript'>alert('密码或用户名错误');window.history.back(); </script>";
    	}
    }
}