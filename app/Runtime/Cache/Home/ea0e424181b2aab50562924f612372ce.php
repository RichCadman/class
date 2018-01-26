<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,user-scalable=no">
<title>报名</title>
<link rel="stylesheet" type="text/css" href="/pub/home/css/kaola.css">
<script src="/pub/home/js/jquery-3.1.1.js"></script>
</head>

<body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script src="/pub/home/js/jquery-3.1.1.js"></script>
	<script type="text/javascript">
	
  wx.config({
    debug: false,//调试模式 
    appId: "<?php echo ($signPackage["appId"]); ?>",
    timestamp: "<?php echo ($signPackage["timestamp"]); ?>",//生成签名的时间戳 
    nonceStr: "<?php echo ($signPackage["nonceStr"]); ?>",//生成签名的随机串
    signature: "<?php echo ($signPackage["signature"]); ?>",
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      'onMenuShareTimeline',//分享给朋友圈
      'onMenuShareAppMessage',//分享给朋友
      'chooseImage',//拍照或从手机相册中选图接口
      'uploadImage',//上传图片接口
      "previewImage",//预览图片接口
      "downloadImage"//下载图片接口
      
    ]
  });
  wx.ready(function () {
      //分享到朋友圈  
    wx.onMenuShareTimeline({ 
        title: '我正在参加中考压轴每日一题，很有收获，推荐给你！',   
        //desc: '每日一题',  
          
        link: 'http://www.sddfkm.com/index.php/Login/login_share/my_openId/<?php echo ($_SESSION['userinfo']['openid']); ?>', // 分享链接   
        imgUrl: 'http://www.sddfkm.com/share.jpg', // 分享图标   
        success: function() {   
            // 用户确认分享后执行的回调函数 
            alert("分享成功");
			$.post("/index.php/Index/share_success",function(){
				
			})
            //处理逻辑增加积分  
        },   
        cancel: function() {   
            // 用户取消分享后执行的回调函数   
             //alert("分享失败");
        }   
    }); 
  });
</script>

<div class="width100 height100 bCover hidden" style="background:url(/pub/home/img/bmbg.png) no-repeat center;">
	<img src="/pub/home/img/mryt.png" class="width85 center" style="margin-top:50px;" id="pic">
    
    <div id="picIn" class="hidden">
        <div class="center radius6 boxSizing apadd">
            <h3 class="font24 tcenter font100 juhuang mb">当前已有<font class="heise"><?php echo ($count); ?></font>人报名</h3>
            <ul class="width100 hidden">
                <?php if(is_array($info)): foreach($info as $key=>$v): ?><li class="width20 fl boxSizing" style="padding:6px">
						<div>
							<div class="radius50 hidden"><img src="<?php echo ($v['photo']); ?>" class="width100"></div>
							
                            <!--<p class="yihang font12 tcenter" style="height:16px;"><?php echo ($v['nick_name']); ?></p>-->
						</div>
                        
                    </li><?php endforeach; endif; ?>
                <li class="width20 fl boxSizing" style="padding:6px">
					<div class="radius50 hidden">
					 <img src="/pub/home/img/sl.png" class="width100">
					</div>
                   
                </li>
            </ul>
        </div> 
    	<div style="width:95%;" id="gui_z">
         <div style="overflow:auto; height:100%;">
    	 <h3 class="font24 tcenter font100 juhuang" style="margin-bottom:5px;">活动对象</h3>
         <div class="width100 boxSizing font12 padd">
            <p style="font-size:14px;" class="center tcenter">全市初二初三学生</p>
         </div>
         <h3 class="font24 tcenter font100 juhuang mb" style="margin-bottom:2px;margin-top:5px;">活动奖品</h3>
         <div class="width100 boxSizing font12 padd">
           
            <p style="margin-bottom:5px;" class="center">特等奖 1人 ：积分第1名     kindle 一台</p>
            <p style="margin-bottom:5px;" class="center">一等奖10人：积分第2-11名  定制钢笔</p>
            <p style="margin-bottom:5px;" class="center">二等奖20人：积分第12-31名  定制水杯</p>
            <p style="margin-bottom:5px;" class="center">三等奖20人：积分第32-51名  王者荣耀手办</p>
            <p style="margin-bottom:5px;" class="center">连续坚持两个月，可获得“持之以恒”达人证书一份</p>
            <p style="margin-bottom:5px;" class="center">奖品兑换规则：按照积分排名，若积分相同，最后一天打卡时间靠前者获得。</p>
        </div>
        <h3 class="font24 tcenter font100 juhuang" style="margin-bottom:5px;">打卡时间</h3>
         <div class="width100 boxSizing font12 padd">
            <p style="margin-bottom:5px;" class="center">
                12：00-23:00为正常打卡时间，全额奖励当天积分</p>
                <p style="margin-bottom:5px;" class="center">23:00-24:00为迟到打卡时间，当天打卡积分减半</p>
                <p style="margin-bottom:5px;" class="center">其它时间打卡会记入打卡次数但不会获得积分。</p>
         </div>
         </div>   
      </div>
       
       
        <a href="/index.php/Index/join.html" class="width50 center block" style="margin-top:15px;">
        	<img src="/pub/home/img/join.png" class="center width100">
        </a>
    </div>
</div>
<script>
window.onload=function(){
var w=$("#pic").width();
var h=$("#pic").height()-80;
var t=$("#pic").offset().top+40;
var l=$("#pic").offset().left;
$("#picIn").css({width:w+'px',height:h+'px',top:t+'px',left:l+'px',});
var w  = $('#picIn').find('li img').width();
$('#picIn').find('li img').css('height',w);
}


//if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
// alert(navigator.userAgent);  
    //window.location.href ="iPhone.html";
//} else if (/(Android)/i.test(navigator.userAgent)) {
    //alert(navigator.userAgent); 
   // window.location.href ="Android.html";
//} else {
   // window.location.href ="pc.html";
//};

</script>
</body>
</html>