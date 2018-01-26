<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    //登录验证
	public function login_do(){
		header("Content-type: text/html; charset=utf-8");
		Vendor('Card.class_weixin_adv');	
		//appid   wxec9f9ed5706a50a6
		$weixin=new \class_weixin_adv("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		if (isset($_GET['code'])){	
			$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx4ffb8db4b04b5bf7&secret=df7305324d2a3550bf6f21b804cd95bb&code=".$_GET['code']."&grant_type=authorization_code";
			$res = $weixin->https_request($url);
			$res=(json_decode($res, true));
			$access_token = $res['access_token'];//这个access_token是最新的一个
            $openid = $res['openid'];
			$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN'; 
      		$res = $weixin->https_request($get_user_info_url);//调用SDK方法获取到res 从中可以得到openid
			//解析json  
			$row = json_decode($res,true);
			//dump($row);
			//exit;
			if ($row['openid']) {
				$_SESSION['wx_user'] = $row;
				$openid = $row['openid'];
				$user = M("student")->where("openid='$openid'")->find();
				if($user){//查询到该用户并且时时更新头像和用户名
					$data1['wx_name']=$row['nickname'];
					$data1['wx_photo']=$row['headimgurl'];
					M("student")->where("openid='$openid'")->save($data1);
					$user1= M("student")->where("openid='$openid'")->find();
					$_SESSION['userinfo']=$user1;
					header('Location:'.__APP__.'/Index/index.html');
					
				}else{//未查询到用户openID
					$data['openid']=$row['openid'];
					$data['wx_name']=$row['nickname'];
					$data['wx_photo']=$row['headimgurl'];
					$data['add_time']=time();
					$d=date("d");
					if($d==1){
						$data['clear']=1;
					}else{
						$data['clear']=0;
					}
					$add_user=M("student")->add($data);
					//echo M()->getLastSql();exit;
					if(!$add_user){
						echo "<meta charset='utf-8' /><script>alert('no_add_user!');</script>";
						
					}else{
						$userinfo=M("student")->where("id=$add_user")->find();
						$_SESSION['userinfo']=$userinfo;
						header('Location:'.__APP__.'/Index/index.html');
					}
				}
				
			}else{
				echo "<meta charset='utf-8' /><script>alert('授权出错,请重新授权!');</script>";
				echo "<script>history.back();</script>";
			}
		}else{
			echo "<script>alert('NO CODE!');</script>";
			echo "<script>history.back();</script>";
		}
	}
	//登陆
	public function login(){
		
		//echo "13";exit;
		$appid = "wx4ffb8db4b04b5bf7";
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri=http://www.sddfkm.com/index.php/Login/login_do&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
	   header("Location:".$url);
	}

	//分享链接登录入口
	public function login_share($my_openId){//接收分享人的openID
		$appid = "wx4ffb8db4b04b5bf7";
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri=http://www.sddfkm.com/index.php/Login/login_share_do/my_openId/'.$my_openId.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
	   header("Location:".$url);
	}

	//分享链接登录验证
	public function login_share_do($my_openId){
		header("Content-type: text/html; charset=utf-8");
		Vendor('Card.class_weixin_adv');
		//appid   wxec9f9ed5706a50a6
		$weixin=new \class_weixin_adv("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		if (isset($_GET['code'])){
			$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx4ffb8db4b04b5bf7&secret=df7305324d2a3550bf6f21b804cd95bb&code=".$_GET['code']."&grant_type=authorization_code";
			$res = $weixin->https_request($url);
			$res=(json_decode($res, true));
			$access_token = $res['access_token'];
            $openid = $res['openid'];
			$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN'; 
      		$res = $weixin->https_request($get_user_info_url);//调用SDK方法获取到res 从中可以得到openid
			//解析json  
			$row = json_decode($res,true);
			//dump($row);
			//exit;
			if ($row['openid']) {
				$_SESSION['wx_user'] = $row;
				$openid = $row['openid'];
				$user = M("student")->where("openid='$openid'")->find();
				//判断受邀请的用户是否登录过此平台
				if($user){//查询到该用户并且时时更新头像和用户名
					$data1['wx_name']=$row['nickname'];
					$data1['wx_photo']=$row['headimgurl'];
					M("student")->where("openid='$openid'")->save($data1);
					$user1= M("student")->where("openid='$openid'")->find();
					$_SESSION['userinfo']=$user1;
					header('Location:'.__APP__.'/Share/share.html');
					
				}else{//未查询到用户openID
					$data['openid']=$row['openid'];
					$data['wx_name']=$row['nickname'];
					$data['wx_photo']=$row['headimgurl'];
					$data['add_time']=time();
					$d=date("d");
					if($d==1){
						$data['clear']=1;
					}else{
						$data['clear']=0;
					}
					$data['invitation']=$my_openId;//添加邀请人的openID
					$add_user=M("student")->add($data);
					if(!$add_user){
						echo "<meta charset='utf-8' /><script>alert('no_add_user!');</script>";
						
					}else{
						$userinfo=M("student")->where("id=$add_user")->find();
						$_SESSION['userinfo']=$userinfo;
						header('Location:'.__APP__.'/Share/share.html');
					}
				}
				
			}else{
				echo "<meta charset='utf-8' /><script>alert('授权出错,请重新授权!');</script>";
				echo "<script>history.back();</script>";
			}
		}else{
			echo "<script>alert('NO CODE!');</script>";
			echo "<script>history.back();</script>";
		}
	}
}