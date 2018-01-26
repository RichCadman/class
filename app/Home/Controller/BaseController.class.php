<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        if(!isset($_SESSION['userinfo'])){
            echo "<script type='text/javascript'>window.location=\"/index.php/Login/login\";</script>";
    	}
    }
}