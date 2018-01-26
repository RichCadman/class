<?php
namespace Home\Controller;
class PointController extends BaseController{
	//积分界面
	public function index(){
		//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		//先判断该学员今日是否已经打卡成功
		$userinfo=M("student")->where("id=$uid")->find();
		//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
		if($now_start_time<$userinfo['last_punch_time']&&$userinfo['last_punch_time']<$now_end_time){
			//今日已打卡
			header('location:'.__APP__.'/Point/punch_success');
		}else{
			//今日未打卡
			header('location:'.__APP__.'/Point/punch_fail');
		}
	}
	
	//积分详情页
	public function detail($id){
		$info=M("detail")->where("user_id=$id")->order("time desc")->select();
		
		
		$this->assign("info",$info);
		$this->display();
	}
		
	//今日已打卡页面
	public function punch_success(){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
		//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
		//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		//查询信息
		$userinfo=M("student")->where("id=$uid")->find();
		//统计个人今日积分
		$today_point_info=M("detail")->field("point")->where("user_id=$uid and time between $now_start_time and $now_end_time")->select();
		$today_point='';
		foreach ($today_point_info as $k => $v) {
			$today_point+=$v['point'];
		}
		//查询积分排行
		$point=M("student")->order("point desc,last_punch_time asc")->limit(100)->select();
		//查询积分自己第几名
		$my=M("student")->order("point desc,last_punch_time asc")->select();
		foreach ($my as $k => $v) {
			if($v['id']==$uid){
				$num=$k+1;
			}
		}
		//查询时间排行
		$times=M("student")->where("last_punch_time between $now_start_time and $now_end_time")->order("last_punch_time asc")->limit(100)->select();
		//查询时间自己第几名
		$my_time=M("student")->where("last_punch_time between $now_start_time and $now_end_time")->order("last_punch_time asc")->select();
		foreach ($my_time as $k => $v) {
			if($v['id']==$uid){
				$time_num=$k+1;
			}
		}
		//查看当天视频答案
		//var_dump($time_num);exit;
		$problem=M("problem")->where("add_time between $now_start_time and $now_end_time")->limit(1)->find();
		$this->assign('problem',$problem);
		$this->assign("time_num",$time_num);
		$this->assign("num",$num);
		$this->assign("times",$times);
		$this->assign("point",$point);
		$this->assign("today_point",$today_point);
		$this->assign('userinfo',$userinfo);
		$this->assign("signPackage",$signPackage);
		$this->display();
	}

	//今日未打卡页面
	public function punch_fail(){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
		//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
		//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		//查询信息
		$userinfo=M("student")->where("id=$uid")->find();
		//$this->assign('userinfo',$userinfo);
		//查询积分排行
		$point=M("student")->order("point desc,last_punch_time asc")->limit(100)->select();
		//查询积分自己第几名
		$my=M("student")->order("point desc,last_punch_time asc")->select();
		foreach ($my as $k => $v) {
			if($v['id']==$uid){
				$num=$k+1;
			}
		}
		//查询时间排行
		$times=M("student")->where("last_punch_time between $now_start_time and $now_end_time")->order("last_punch_time asc")->limit(100)->select();
		//查询时间自己第几名
		$my_time=M("student")->where("last_punch_time between $now_start_time and $now_end_time")->order("last_punch_time asc")->select();
		foreach ($my_time as $k => $v) {
			if($v['id']==$uid){
				$time_num=$k+1;
			}
		}
		//查看当天视频答案
		
		$problem=M("problem")->where("add_time between $now_start_time and $now_end_time")->limit(1)->find();
		$this->assign('problem',$problem);
		$this->assign("time_num",$time_num);
		$this->assign("num",$num);
		$this->assign("times",$times);
		$this->assign("point",$point);
		$this->assign('userinfo',$userinfo);
		$this->assign("signPackage",$signPackage);
		$this->display();
	}
}
