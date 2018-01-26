<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>过期打卡</title>
<link rel="stylesheet" type="text/css" href="/pub/home/css/kaola.css">
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
    // 在这里调用 API
      //分享给朋友  
    wx.onMenuShareAppMessage({ 
  //alert(5);
        title: '我正在参加中考压轴每日一题，很有收获，推荐给你！',   
        //desc: '',  
          
        link: 'http://www.sddfkm.com/index.php/Login/login_share/my_openId/<?php echo ($_SESSION['userinfo']['openid']); ?>', // 分享链接   
        imgUrl: 'http://www.sddfkm.com/share.jpg', // 分享图标   
        success: function() {   
            // 用户确认分享后执行的回调函数 
            alert("分享成功");  
			$.post("/index.php/Index/share_success",function(){
				
			})
        },   
        cancel: function() {   
            // 用户取消分享后执行的回调函数   
            //alert("分享失败");
        }   
    }); 
  });
</script>

    <div class="width100 bCover height100 hidden" id="colok_su" >
        <div class="width100 hidden relative center width85" style="margin-top:-20px">
            <img src="/pub/home/img/gq.png" class="width100 center">
            <p class="absolute tcenter block width100 su_p jiachu">本次为过期打卡，获得0积分</p>
        </div>
		
		<div class="center tcenter hidden" style="margin-top:-70px;margin-bottom:30px; ">                         
			<p class="sudasu lan_f " style="color:#646464;margin-bottom:-5px;font-size:10px">您还可以通过这个方式获取积分：</p>
			<p class="sudasu lan_f " style="color:#646464;margin-bottom:-5px;font-size:10px">分享活动至朋友圈可获5积分，每天限一次</p>
			<p class="sudasu lan_f " style="color:#646464;margin-bottom:-5px;font-size:10px">成功邀请好友打卡一次获5积分，最多邀请100人</p>
        </div>
		
        <div class="center hidden sudada huangborder boxSizing sp"> 
            <img src="/pub/home/img/bf.png" class="fl width20">
            <font class="sudasu huang jiachu">查看视频解析</font>
        </div>
        <div class="center hidden sudada lan_b boxSizing zp" style="margin-top:20px;"> 
            <img src="/pub/home/img/dz.png" class="fl width20">
            <font class="sudasu lan_f jiachu">查看电子版解析</font>
        </div>
		<div class="center tcenter hidden sudada lan_b boxSizing ewm join" style="margin-top:20px; border:2px solid #e24f22"> 
            
            <font class="sudasu lan_f jiachu" style="color:#e24f22">点击加入答疑群</font>
        </div>
    </div>
    <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="zp_y" >
        <div class="page width85 center relative" style="padding-top:5%;max-height:70%">
            <div class="pinch-zoom width100 absolute" style="top:10%;left:1%;" >
                <img src="/pub/upload/<?php echo ($problem["result"]); ?>" class="center width90">
            </div>
        </div>
        </div> 
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="show_i">
        <div class="bj_fff width75 center relative radius10 boxSizing" style="margin-top:100px; padding:35px;">
            <img src="/pub/home/img/close.png" class="absolute width16 close" style="top:-10px;right:-10px;">
            <p class="font15 center tcenter width100">欢迎加入中考每日一题答疑群</p>
            <img src="/pub/home/img/dyq.jpg" class="center width100" style="margin-top:20px;">
			<p class="font15 center tcenter width100">（长按二维码入群）</p>
        </div>
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="sp_y">
        <iframe frameborder="0" src="<?php echo ($problem["video_result"]); ?>" width="100%" height="30%"class="block" style="margin-top:40%"></iframe>
        
   </div>
   <script src="/pub/home/js/jquery-3.1.1.js"></script>
   <script src="/pub/home/js/jquery-1.7.2.min.js"></script>
   <script src="/pub/home/js/pinchzoom.js"></script>
   <script>
        $(".zp").click(function(){
            $("#zp_y").css({display:"block"});
            })
        $(".sp").click(function(){
            $("#sp_y").css({display:"block"});
            })
        $("#zp_y").click(function(){
            $("#zp_y").css({display:"none"});
            })  
        $("#sp_y").click(function(){
            //$("#sp_y").css({display:"none"});
			window.location.reload();
            })
		$(".close").click(function(){
            $("#show_i").css({display:"none"});
            })
		$(".join").click(function(){
            $("#show_i").css({display:"block"});
            }) 
		$(".ewm").click(function(){
            $("#ewm").css({display:"block"});
            })
		$("#ewm").click(function(){
            $("#ewm").css({display:"none"});
            })  				
        $(function () {
            $('div.pinch-zoom').each(function () {
                new RTP.PinchZoom($(this), {});
            });
        })

		/**  * 使用 HTML5 的 History 新 API pushState 来曲线监听 Android 设备的返回按钮  * XBack.listen(function(){     alert('oh! you press the back button');   });  */

pushHistory();

window.addEventListener("popstate",
function(e) {
    window.location = '/index.php/Index/answer1';
},
false);

function pushHistory() {
    var state = {
        title: "title",
        url: "#"
    };
    window.history.pushState(state, "title", "#");
}
   </script>
</body>
</html>