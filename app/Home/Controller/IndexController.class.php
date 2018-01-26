<?php
namespace Home\Controller;
class IndexController extends BaseController {
	//报名页面
    public function index(){
		 $uid=$_SESSION['userinfo']['id'];
		 $userinfo=M("student")->field("clear")->where("id=$uid")->find();
		 $clear=$userinfo['clear'];
		 $d=date("d");
		 if($clear==0){//未清理
			 if($d==1){
				$person=M("student")->field("id")->select();
				for($i=0;$i<count($person);$i++){
					$da1['point']=0;
					$da1['clear']=1;
					$id=$person[$i]['id'];
					M("student")->where("id=$id")->save($da1);
				}
				M()->execute($sql = 'TRUNCATE table `class_detail`');
			 }
		 }else{
			 if($d==2){
				$person=M("student")->select();
				for($i=0;$i<count($person);$i++){
					$da1['clear']=0;
					$id=$person[$i]['id'];
					M("student")->where("id=$id")->save($da1);
				} 
			 }  
		 }
		 
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
		//var_dump($signPackage);exit;
    	//查表显示
    	$info=M('join')->field('id,user_id,add_time,photo,nick_name')->order('add_time desc')->limit(9)->select();
    	//统计人数
    	$count=M('join')->count();
    	$this->assign('info',$info);
    	$this->assign('count',$count);
		$this->assign("signPackage",$signPackage);
    	$this->display();
    }

     //点击参加入口
    public function join(){
    	//判断今日是否已经打完卡
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
			header('location:'.__APP__.'/Index/answer1');
		}else{
			//今日未打卡
	    	//查询用户是否已经存在表中
	    	$res=M("join")->where("user_id=$uid")->find();
	    	if($res){
	    		$data['add_time']=time();
				$data['photo']=$_SESSION['userinfo']['wx_photo'];
	    		M("join")->where("user_id=$uid")->save($data);
	    		header('location:'.__APP__.'/Index/answer');
	    	}else{
	    		$data['user_id']=$uid;
	    		$data['photo']=$_SESSION['userinfo']['wx_photo'];
	    		$data['add_time']=time();
	    		$data['nick_name']=$_SESSION['userinfo']['wx_name'];
	    		M("join")->add($data);
	    		header('location:'.__APP__.'/Index/answer');
	    	}
		}
    	

    }
    //答题页面
    public function answer(){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
		//var_dump($signPackage);
		//exit;
    	//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	//查询当天题目
    	$info=M("problem")->where("add_time between $now_start_time and $now_end_time")->limit(1)->find();
    	//查询用户信息
    	//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		
		$userinfo=M("student")->where("id=$uid")->find();
		$this->assign("userinfo",$userinfo);
		$this->assign("signPackage",$signPackage);
    	$this->assign('info',$info);
    	$this->display();
    }

    //异步获取所点击的题目
    public function get_answer($date){
		$id=$_SESSION['userinfo']['id'];
		$array=explode("-",$date);
    	$last=array_pop($array);
    	$len=strlen($last);
    	if($len==1){
    		$now="0".$last;
    		$array[]=$now;
    		$date=implode("-", $array);
    	}else{
    		$date=$date;
    	}
    	//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$get_time=strtotime($date);
    	//大于当前日期
    	if($get_time>$now_time){
    		$this->ajaxReturn(1);
    	}else{
			
    		//查询题目
	    	$problem=M("problem")->field("id,content,result")->where("datetime='$date'")->find();
	    	$problem_id=$problem['id'];
	    	//题目不存在
	    	if(!$problem_id){
	    		$this->ajaxReturn(1);//提示不存在
	    	}else{
				
	    		//判断这个题目是否答过
		    	$res=M("submit")->field("sub_content1")->where("user_id=$id and problem_id=$problem_id")->find();
		    	//提交过
		    	if($res){
		    		$this->ajaxReturn(0);//跳转页面answer1
		    	}else{
					
		    		//查询题目
			    	$get_answer=M("problem")->field("id,content")->where("datetime='$date'")->find();
			    	$this->ajaxReturn($get_answer);
		    	}	
	    	}
    	}
    }


     //答题完成页面
    public function answer1(){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();	
    	//学员id
    	$uid=$_SESSION['userinfo']['id'];
    	//查询用户信息
    	$userinfo=M("student")->where("id=$uid")->find();
    	//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
		//判断当前时间
		$time = intval (date("Hi"));
		
		//查询当天题目
		$infos=M("problem")->field("id,content,result")->where("add_time between $now_start_time and $now_end_time")->limit(1)->find();
		$problem_id=$infos['id'];
		//当天有题目时进行
		if($problem_id){
			$submits=M("submit")->field("id,sub_content1")->where("user_id=$uid and problem_id=$problem_id")->find();
			//判断是否已经答过这道题目   	
			if($submits){
				$submit=$submits;
				$info=$infos;
			}
		}
		
    	
		$this->assign("signPackage",$signPackage);
		$this->assign("userinfo",$userinfo);
    	$this->assign('info',$info);
		$this->assign('submit',$submit);
    	$this->display();
    }

    //异步获取所点击的题目
    public function get_answer1($date){
		$id=$_SESSION['userinfo']['id'];
		$array=explode("-",$date);
    	$last=array_pop($array);
    	$len=strlen($last);
    	if($len==1){
    		$now="0".$last;
    		$array[]=$now;
    		$date=implode("-", $array);
    	}else{
    		$date=$date;
    	}
		//$this->ajaxReturn(322);exit;
		$id=$_SESSION['userinfo']['id'];
    	//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$get_time=strtotime($date);
		//超过当前时间
    	if($get_time>$now_time){
    		$this->ajaxReturn(1);
    	}else{
    		//查询题目
	    	$get_answer=M("problem")->field("id,content,result")->where("datetime='$date'")->find();
			if(!$get_answer){
				$this->ajaxReturn(1);
			}else{
				//判断这道题目有没有提交过
				$problem_id=$get_answer['id'];
				$res=M("submit")->field("sub_content1")->where("user_id=$id and problem_id=$problem_id")->find();
				//$this->ajaxReturn(get_answer);exit;
				if($res){//今天已经打卡
					$get_answer['my_daan']=$res['sub_content1'];
					$this->ajaxReturn($get_answer);
				}else{
					$this->ajaxReturn(0);//跳转答题页面
				}
			}
    	}
    }

    //打卡加积分(提交答案之后记为打卡成功)
    /*public function punch_card($pid){//此id为题目id
		
    }*/

	//跳转成功页面中转站
	public function success_zz(){
		$problem_id=$_GET['problem_id'];
		if(!$problem_id){
			echo "<script type='text/javascript'>alert('当前日期无题目！');window.history.go(-1);</script>";
		}else{
			$uid=$_SESSION['userinfo']['id'];
			$info=M("submit")->where("user_id=$uid and problem_id=$problem_id")->find();
			if($info['old']==1){
				header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
			}else{
				$time=$info['add_time'];
				$time = intval (date("Hi",$time));
				if($time >= "1200" && $time < "2300"){
					header('location:'.__APP__.'/Index/success/problem_id/'.$problem_id);
				}else if($time >= "2300" && $time < "2400"){//迟到打卡积分加5,记录打卡次数
					header('location:'.__APP__.'/Index/success1/problem_id/'.$problem_id);
				}else{
					header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
				}
			}
			//首先判断这道题目是否是今天的
			//当前时间戳
			/*$t = time();
			//今日时间戳范围
			$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
			$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
			$pro=M("problem")->where("id=$problem_id")->find();//查询出这道题目的信息
			if($now_start_time<$pro['add_time']&&$pro['add_time']<$now_end_time){//如果这道题的添加时间在今天则进行
				//echo $problem_id;exit;
				//学员id
				$uid=$_SESSION['userinfo']['id'];
				$info=M("submit")->where("user_id=$uid and problem_id=$problem_id")->find();
				$time=$info['add_time'];
				$time = intval (date("Hi",$time));
				if($time >= "1200" && $time < "2300"){
					header('location:'.__APP__.'/Index/success/problem_id/'.$problem_id);
				}else if($time >= "2300" && $time < "2400"){//迟到打卡积分加5,记录打卡次数
					header('location:'.__APP__.'/Index/success1/problem_id/'.$problem_id);
				}else{
					header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
				}
			}else{
				$uid=$_SESSION['userinfo']['id'];
				$info=M("submit")->where("user_id=$uid and problem_id=$problem_id")->find();
				$time=$info['add_time'];
				$time = intval (date("Hi",$time));
				if($time >= "1200" && $time < "2300"){
					header('location:'.__APP__.'/Index/success/problem_id/'.$problem_id);
				}else if($time >= "2300" && $time < "2400"){//迟到打卡积分加5,记录打卡次数
					header('location:'.__APP__.'/Index/success1/problem_id/'.$problem_id);
				}else{
					header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
				}
			}*/
		}
		
		
	}
    //正常打卡成功页面
    public function success($problem_id){
		
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
    	//echo $problem_id;exit;
    	//查询当天题目
    	$problem=M("problem")->where("id=$problem_id")->find();
    	//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		$info=M("student")->where("id=$uid")->find();
		$this->assign('problem',$problem);
		$this->assign("info",$info);
		$this->assign("signPackage",$signPackage);
    	$this->display();
    }

	//迟到打卡页面
    public function success1($problem_id){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
    	//echo $problem_id;exit;
    	//查询当天题目
    	$problem=M("problem")->where("id=$problem_id")->find();
    	//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		$info=M("student")->where("id=$uid")->find();
		$this->assign('problem',$problem);
		$this->assign("info",$info);
		$this->assign("signPackage",$signPackage);
    	$this->display();
    }
	//过期打卡页面
    public function success2($problem_id){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
    	//echo $problem_id;exit;
    	//查询当天题目
    	$problem=M("problem")->where("id=$problem_id")->find();
    	//学员id
    	$uid=$_SESSION['userinfo']['id'];
		//测试id
		//$uid=1;
		$info=M("student")->where("id=$uid")->find();
		$this->assign('problem',$problem);
		$this->assign("info",$info);
		$this->assign("signPackage",$signPackage);
    	$this->display();
    }
    //分享成功添加积分5
    public function share_success(){
    	//当前时间戳
		$t = time();
		//今日时间戳范围
		$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
    	$id=$_SESSION['userinfo']['id'];
    	$res=M("student")->where("id='$id'")->find();
    	//判断今天是否已经分享过
    	if($now_start_time<$res['share_time']&&$res['share_time']<$now_end_time){
    		echo "<script type='text/javascript'>alert('分享成功');window.history.go(-1);</script>";
    	}else{//未分享
			$data['point']=$res['point']+5;
			$data['share_time']=time();
			$data['share_date_time']=date("Y-m-d H:i:s",time());
			M("student")->where("id='$id'")->save($data);
			//添加积分日志
			$da3['user_id']=$id;
			$da3['time']=time();
			$da3['point']=5;
			$da3['type']="朋友圈分享积分";
			M("detail")->add($da3);
			echo "<script type='text/javascript'>alert('分享成功');window.history.go(-1);</script>";
    	}
    }
	//异步获取自己所有提交过的答案（在日历处显示出来）
	public function getJSON(){
    	$uid=$_SESSION['userinfo']['id'];
    	//查询所有提交的答案信息
		$submit=M("submit")->where("user_id=$uid")->select();
		$this->ajaxReturn($submit);

    }
	
}


























