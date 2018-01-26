<?php
namespace Home\Controller;
class SubmitController extends BaseController{
	//提交答案
	public function submit(){
		date_default_timezone_set("Asia/Shanghai");
		//判断提交的题目id是否存在
		$problem_id=$_GET['problem_id'];
		if(!$problem_id){
			echo "<script type='text/javascript'>alert('提交失败，当前日期无题目！');window.history.go(-1);</script>";
		}else{//存在
			//用户id
			$uid=$_SESSION['userinfo']['id'];
			//判断题目是否是今天的
			//当前时间戳
			$t = time();
			//今日时间戳范围
			$now_start_time = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
			$now_end_time = mktime(24,0,0,date("m",$t),date("d",$t),date("Y",$t));
			//查询出这道题目的信息
			$pro=M("problem")->field("add_time")->where("id=$problem_id")->find();
			//如果这道题的添加时间在今天则进行
			if($now_start_time<$pro['add_time']&&$pro['add_time']<$now_end_time){
				$time = intval (date("Hi"));
				//判断当前时间,小于12点不能提交
				if($time < "1200"){
					echo "<script type='text/javascript'>alert('请于12点后提交！');window.history.go(-1);</script>";
				}else{
					//正常提交题目
					//判断今日是已经提交过
					$res11=M("submit")->field("id")->where("user_id=$uid and problem_id=$problem_id")->find();
					if($res11){
						echo "<script type='text/javascript'>alert('重复提交');window.location='/index.php/Index/answer1';</script>'";
					}else{
						//echo "jinlai ";exit;
						$upload=new \Think\Upload();
						$upload->maxSize=209715200;//设置上传大小为20M
						$upload->exts=array('jpg','jpeg','png','gif');//设置附件上传类型
						$upload->rootPath='./pub/upload/';//设置附件上传目录,文件上传保存的根路径
						$upload->savePath='image/';//设置附件上传目录,文件上传的保存路径(相对于根路径)
						$info=$upload->upload();
						//var_dump($info);exit;
						if($info){
							foreach($info as $k=>$v){
								$img=$v['savepath'].$v['savename'];//遍历得到路径
							}
							$image = new \Think\Image(); 
							$img1="./pub/upload/".$img;//拼接上传后路径
							//var_dump($img);exit;
							$image->open($img1);//打开图片
							//$imgs = "./pub/upload/".$info['img']['savepath'].$info['img']['savename'];//处理后的路径
							$image->thumb(1500, 1500)->save($img1);//转换为1500*1500的图片
							//查询题目标题
							$info1=M("problem")->field("title,datetime")->where("id=$problem_id")->find();
							$title=$info1['title'];
							//print_r($img);exit;
							$da['user_id']=$uid;
							$da['problem_id']=$problem_id;
							$da['sub_title']=$title;
							$da['sub_content1']=$img;
							$da['time']=$info1['datetime'];
							$da['add_time']=time();
							$res=M("submit")->add($da);
							//添加图片成功
							if($res){
								$submit_id=$res;
								//查询用户信息
								$userinfo = M('student')->field("invitation,last_punch_time,count,total_count,point,max_count")->where("id=$uid")->find();
								//判断用户是否是第一次打卡
								if($userinfo['last_punch_time']==''){//第一次打卡
									//查询邀请人并且为邀请人添加积分
									$invitation=$userinfo['invitation'];
									$res=M("student")->field("share_num,id,point")->where("openid='$invitation'")->find();
									if($res && $res['share_num']<=100){
										$yid=$res['id'];
										$da1['point']=$res['point']+5;
										$da1['share_num']=$res['share_num']+1;
										M("student")->where("id='$yid'")->save($da1);
										//添加积分日志
										$da2['user_id']=$yid;
										$da2['time']=time();
										$da2['point']=5;
										$da2['type']="邀请积分";
										M("detail")->add($da2);
									}
								}
								$time = intval (date("Hi"));
								//昨日时间戳范围
								$last_start_time = mktime(0,0,0,date("m",$t),date("d",$t)-1,date("Y",$t));
								$last_end_time = mktime(24,0,0,date("m",$t),date("d",$t)-1,date("Y",$t));
								//正常打卡时间积分加10,记录打卡次数
								if($time >= "1200" && $time < "2300"){
									//判断昨日是否打卡
									if($last_start_time<$userinfo['last_punch_time']&&$userinfo['last_punch_time']<$last_end_time){
										$da['last_punch_time'] = time();
										$da['count'] = $count = $userinfo['count']+1;
										$da['total_count']=$userinfo['total_count']+1;//总共打卡多少天
										if($count%5==0){//连续5天打卡奖励积分50
											$da['point']=$userinfo['point']+50;
											$da['today_point']=50;
										}else{
											$da['point']=$userinfo['point']+10;
											$da['today_point']=10;
										}
										$max_count=$userinfo['max_count'];//获取最长连续打卡次数
										if($count>$max_count){//本次连续打卡次数大于最长连续打卡次数时更新数据
											$da['max_count']=$count;
										}
										$res1=M('student')->where(array("id"=>$uid))->save($da);
										if($res1){
											//添加积分日志
											$da3['user_id']=$uid;
											$da3['time']=time();
											$da3['point']=$da['today_point'];
											$da3['type']="打卡积分";
											M("detail")->add($da3);
											header('location:'.__APP__.'/Index/success/problem_id/'.$problem_id);
										}
									}else{
										/**返回已经签到的操作*/
										$da['total_count']=$userinfo['total_count']+1;//总共打卡多少天
										$da['last_punch_time'] = time();
										$da['count']= $count = 1;
										$da['point']=$userinfo['point']+10;
										$da['today_point']=10;
										$max_count=$userinfo['max_count'];//获取最长连续打卡次数
										if($count>$max_count){//本次连续打卡次数大于最长连续打卡次数时更新数据
											$da['max_count']=$count;
										}
										$res1=M('student')->where(array("id"=>$uid))->save($da);
										if($res1){
											//添加积分日志
											$da3['user_id']=$uid;
											$da3['time']=time();
											$da3['point']=10;
											$da3['type']="打卡积分";
											M("detail")->add($da3);
											header('location:'.__APP__.'/Index/success/problem_id/'.$problem_id);
										}
									}
								//迟到打卡积分加5,记录打卡次数
								}else if($time >= "2300" && $time < "2400"){
									//判断昨日是否打卡
									if($last_start_time<$userinfo['last_punch_time']&&$userinfo['last_punch_time']<$last_end_time){
										$da['last_punch_time'] = time();
										$da['count'] = $count = $userinfo['count']+1;
										$da['total_count']=$userinfo['total_count']+1;//总共打卡多少天
										if($count%5==0){//连续5天打卡奖励积分50
											$da['point']=$userinfo['point']+50;
											$da['today_point']=50;
										}else{
											$da['point']=$userinfo['point']+5;
											$da['today_point']=5;
										}
										$max_count=$userinfo['max_count'];//获取最长连续打卡次数
										if($count>$max_count){//本次连续打卡次数大于最长连续打卡次数时更新数据
											$da['max_count']=$count;
										}
										$res1=M('student')->where(array("id"=>$uid))->save($da);
										if($res1){
											//添加积分日志
											$da3['user_id']=$uid;
											$da3['time']=time();
											$da3['point']=$da['today_point'];
											$da3['type']="打卡积分";
											M("detail")->add($da3);
											header('location:'.__APP__.'/Index/success1/problem_id/'.$problem_id);
										}
									}else{
										/**返回已经签到的操作*/
										$da['total_count']=$userinfo['total_count']+1;//总共打卡多少天
										$da['last_punch_time'] = time();
										$da['count']= $count = 1;
										$da['point']=$userinfo['point']+5;
										$da['today_point']=5;
										$max_count=$userinfo['max_count'];//获取最长连续打卡次数
										if($count>$max_count){//本次连续打卡次数大于最长连续打卡次数时更新数据
											$da['max_count']=$count;
										}
										$res1=M('student')->where(array("id"=>$uid))->save($da);
										if($res1){
											//添加积分日志
											$da3['user_id']=$uid;
											$da3['time']=time();
											$da3['point']=5;
											$da3['type']="打卡积分";
											M("detail")->add($da3);
											header('location:'.__APP__.'/Index/success1/problem_id/'.$problem_id);
										}
									}
								}else{//非正常打卡,不加积分,但记录打卡次数
									//判断昨日是否打卡
									if($last_start_time<$userinfo['last_punch_time']&&$userinfo['last_punch_time']<$last_end_time){
										$da['last_punch_time'] = time();
										$da['count'] = $count = $userinfo['count']+1;
										$da['total_count']=$userinfo['total_count']+1;//总共打卡多少天
										$da['today_point']=0;
										$max_count=$userinfo['max_count'];//获取最长连续打卡次数
										if($count>$max_count){//本次连续打卡次数大于最长连续打卡次数时更新数据
											$da['max_count']=$count;
										}
										$res1=M('student')->where(array("id"=>$uid))->save($da);
										if($res1){
											//过期打卡更改字段old变为1
											$old_data['old']=1;
											M("submit")->where("id=$submit_id")->save($old_data);
											header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
										}
									}else{
										/**返回已经签到的操作*/
										$da['total_count']=$userinfo['total_count']+1;//总共打卡多少天
										$da['last_punch_time'] = time();
										$da['count']= $count = 1;
										$da['point']=$userinfo['point'];
										$da['today_point']=0;
										$max_count=$userinfo['max_count'];//获取最长连续打卡次数
										if($count>$max_count){//本次连续打卡次数大于最长连续打卡次数时更新数据
											$da['max_count']=$count;
										}
										$res1=M('student')->where(array("id"=>$uid))->save($da);
										if($res1){
											//过期打卡更改字段old变为1
											$old_data['old']=1;
											M("submit")->where("id=$submit_id")->save($old_data);
											header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
										}
									}
								}
							}else{
								echo "<script type='text/javascript'>alert('请确保网络通畅！');window.history.go(-1);</script>";
							}
						}else{
							echo "<script type='text/javascript'>alert('错误的图片格式或者图片大小超出限制');window.history.go(-1);</script>";
						}
					}
				}
			}else{//该题目不是今天的题目(完成打卡什么动作都不做)
				$upload=new \Think\Upload();
				$upload->maxSize=209715200;//设置上传大小为20M
				$upload->exts=array('jpg','jpeg','png','gif');//设置附件上传类型
				$upload->rootPath='./pub/upload/';//设置附件上传目录,文件上传保存的根路径
				$upload->savePath='image/';//设置附件上传目录,文件上传的保存路径(相对于根路径)
				$info=$upload->upload();
				//var_dump($_FILES);exit;
				if($info){
					foreach($info as $k=>$v){
						$img=$v['savepath'].$v['savename'];//遍历得到路径
					}
					$image = new \Think\Image(); 
					$img1="./pub/upload/".$img;//拼接上传后路径
					//var_dump($img);exit;
					$image->open($img1);//打开图片
					//$imgs = "./pub/upload/".$info['img']['savepath'].$info['img']['savename'];//处理后的路径
					$image->thumb(1500, 1500)->save($img1);//转换为300*300的图片
					//查询题目标题
					$info1=M("problem")->field("title,datetime")->where("id=$problem_id")->find();
					$title=$info1['title'];
					//print_r($img);exit;
					$da['user_id']=$uid;
					$da['problem_id']=$problem_id;
					$da['sub_title']=$title;
					$da['sub_content1']=$img;
					$da['time']=$info1['datetime'];
					$da['add_time']=time();
					$res=M("submit")->add($da);
					//添加图片成功
					if($res){
						//过期打卡更改字段old变为1
						$submit_id=$res;
						$old_data['old']=1;
						M("submit")->where("id=$submit_id")->save($old_data);
						header('location:'.__APP__.'/Index/success2/problem_id/'.$problem_id);
					}else{
						echo "<script type='text/javascript'>alert('请确保网络通畅！');window.history.go(-1);</script>";
					}
				}else{
					echo "<script type='text/javascript'>alert('错误的图片格式或者图片大小超出限制');window.history.go(-1);</script>";
				}
			}
		}
	}
}
