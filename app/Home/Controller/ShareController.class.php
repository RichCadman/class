<?php
namespace Home\Controller;
class ShareController extends BaseController{
	//分享页面
	public function share(){
		Vendor('WXAPI.JSSDK');
		$jssdk = new \JSSDK("wx4ffb8db4b04b5bf7","df7305324d2a3550bf6f21b804cd95bb");
		$signPackage = $jssdk->GetSignPackage();
		$id=$_SESSION['userinfo']['id'];
		$info=M("student")->where("id=$id")->find();
		$content=M("share")->find();
		$this->assign("signPackage",$signPackage);
		$this->assign("content",$content);
		$this->assign("info",$info);
		$this->display();
	}
}