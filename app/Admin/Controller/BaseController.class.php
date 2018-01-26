<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        if(!isset($_SESSION['admin'])){
            echo "<script type='text/javascript'>alert('请先登录');window.location=\"/admin.php/Login/index\";</script>";
    	}
    }
}