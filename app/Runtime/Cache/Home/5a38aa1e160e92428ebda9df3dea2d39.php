<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>开始训练</title>
<link rel="stylesheet" type="text/css" href="/pub/home/css/kaola.css">
<link rel="stylesheet" href="https://at.alicdn.com/t/font_234130_nem7eskcrkpdgqfr.css">
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

    <div class=" width100 height100 fixed bCover" style="left:0;top:0; background:url(/pub/home/img/wdjf-bg.png) no-repeat center;z-index:-1;">
    </div>
    <div class="width85 center hidden" style="margin-top:20px;" id="top_fo">
        <div class="fl width50 hidden">
            <img src="<?php echo ($userinfo["wx_photo"]); ?>" class="width33 fl radius50">
            <p class="block fr width65 top_i"><?php echo (msubstr($userinfo['wx_name'],0,20)); ?></p>
        </div>
        <div class="fr width25 center tcenter hidden">
            <h4 class="font100">累计积分</h4>
            <span class="block baise te_s"><?php echo ($userinfo["point"]); ?></span>
            <p class="baise width100 ji_f tcenter boxSizing"id="gui">积分规则</p>
        </div>
    </div>
    <img src="/pub/home/img/jifen.png" class="width20 center my_im">
    <div class="width90 center bj_fff hidden center" id="my_ra">
        <div class="block width100" id="show_i_b">
        <img src="/pub/home/img/dkcg-1.png" class="width5" style="margin-left:92%; margin-top:10px;">
        </div>
       <h3 class="width100 tcenter">今天还未打卡，赶快完成题目吧</h3>  
       <a href="/index.php/Index/join" class="block center tcenter lvborder width45 a_t" style="margin-bottom:30px;">
            <h2 class="lvse font100">开始训练</h2>
       </a>
   </div>
   <div class="width100 bj_fff" style="margin-top:30px;">
        <div class="width90 center hidden">
            <div class="tcenter width33 fl on" style="padding-bottom:2%;margin-left:12%;" id="add_b">
                积分排名
            </div>
            <div class="width33 lan_bo tcenter fr lan_bo" style="margin-right:12%;padding-bottom:2%;"id="time_b">
                时间排名
            </div>
        </div>
        <div class="width100 pai_hang" style="margin-top:25px;">
          <div class="width100 bj_fff" style="margin-top:30px;">
            <div class="width100" style="margin-top:25px;">
                <div class="hidden" id="ji_f">

                     <div class="width100 hidden">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 boxSizing" style="padding:14%;"></span>
                            <img src="<?php echo ($userinfo["wx_photo"]); ?>" class="fl width20" style="border-radius:50%; margin-top:10px;">
                            <a href="/index.php/Point/detail/id/<?php echo ($userinfo["id"]); ?>"><div class="fl boxSizing my_pai_o"  style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100" style="color:#000">我的排名</h4>
                                <p class="huise ming">第<?php echo ($num); ?>名</p>
                            </div></a>
                        </div>
                        <div class="fr width16 fr_f"><?php echo ($userinfo["point"]); ?>分</div>
                    </div>

                    <?php if(is_array($point)): foreach($point as $k=>$v): ?><div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:9%;">
                                <?php if($k==0): ?><img src="/pub/home/img/one.png" class="width100">
                                <?php elseif($k==1): ?>
                                <img src="/pub/home/img/two.png" class="width100">
                                <?php elseif($k==2): ?>
                                <img src="/pub/home/img/three.png" class="width100">
                                <?php else: ?>
								<span class="block fl width10 tcenter boxSizing" style="margin-left:5px;line-height:8px;"><?php echo ($k+1); ?></span><?php endif; ?>
                            </span>
                            <img src="<?php echo ($v["wx_photo"]); ?>" class="fl width20" style="border-radius:50%;">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100"><?php echo (msubstr($v['wx_name'],0,4)); ?></h4>
                            </div>
                        </div>
                        <div class="fr width16 fr_f"><?php echo ($v["point"]); ?>分</div>
                    </div><?php endforeach; endif; ?>
                </div>
                <div class="hidden" id="time" style="display:none;">

                    <div class="width100 hidden">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 boxSizing" style="padding:14%;"></span>
                            <img src="<?php echo ($userinfo["wx_photo"]); ?>" class="fl width20" style="border-radius:50%;margin-top:12px;" >
                            <a href="/index.php/Point/detail/id/<?php echo ($userinfo["id"]); ?>"><div class="fl boxSizing my_pai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100" style="color:#000">我的排名</h4>
                                <?php if($time_num==null): ?><p class="huise ming">暂无</p>
								<?php else: ?>
								<p class="huise ming">第<?php echo ($time_num); ?>名</p><?php endif; ?>
                            </div></a>
                        </div>
                       <div class="fr fr_f" style="margin-right:20px;">
                            <p><?php echo date("Y-m-d",$userinfo['last_punch_time']);?></p>
                            <font style="color:#999;"><?php echo date("H:i:s",$userinfo['last_punch_time']);?></font>
                        </div>
                    </div>

                    <?php if(is_array($times)): foreach($times as $k=>$v): ?><div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:9%;">
                                <?php if($k==0): ?><img src="/pub/home/img/one.png" class="width100">
                                <?php elseif($k==1): ?>
                                <img src="/pub/home/img/two.png" class="width100">
                                <?php elseif($k==2): ?>
                                <img src="/pub/home/img/three.png" class="width100">
								<?php else: ?>
								<span class="block fl width10 tcenter boxSizing" style="margin-left:5px;line-height:8px;"><?php echo ($k+1); ?></span><?php endif; ?>
								
                            </span>
                            <img src="<?php echo ($v["wx_photo"]); ?>" class="fl width20" style="border-radius:50%;">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100"><?php echo (msubstr($v['wx_name'],0,4)); ?></h4>
                            </div>
                        </div>
                       <div class="fr fr_f" style="margin-right:20px;">
                            <p><?php echo date("Y-m-d",$v['last_punch_time']);?></p>
                            <font style="color:#999;"><?php echo date("H:i:s",$v['last_punch_time']);?></font>
                       </div>
                    </div><?php endforeach; endif; ?>
                </div>
            </div>
          </div>
        </div>
       <div class="fixed width100 hidden fix" style="height:60px;left:0;">
        <a href="javascript:void(0)" class="block width33 fl tcenter" style="height:60px;line-height:85px; margin-left:10%" id="send">
            <img src="/pub/home/img/fx.png" class="in_block width100">
        </a>
        <a href="/index.php/Point/index" class="block width33 fr tcenter" style="height:60px;line-height:85px; margin-right:10%">
            <img src="/pub/home/img/jf.png" class="in_block width100">
        </a>
    </div>
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="send_show">
        <img src="/pub/home/img/you.png" class="width85 center">
        <div class="width33 radius10 lanse_bg center tcenter" id="dis_n">
            知道了
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
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="show_gui">
        <div class="bj_fff width85 center relative radius10 boxSizing" style="margin-top:30px; padding:15px;">
            <img src="/pub/home/img/close.png" class="absolute width16 close" style="top:-10px;right:-10px;">
            <h3 class="tcenter lan_f" style="margin-bottom:15px;">积分规则</h3>
			<p class="font12 width90">12:00-23:00为正常打卡时间，全额奖励当天积分</p>
			<p class="font12 width90">23:00-24:00为迟到打卡时间，当天打卡积分减半</p>
			<p class="font12 width90">其它时间打卡会记入打卡次数但不会获得积分。</p>
            <p class="font12 width90">积分五天为一周期，前四天每天10分，连续坚持四天，第五天50分</p>
				<p class="font14 width90">例如：</p>	
					<p class="font12" style="color:#909090">连续第1天23:00点前打卡，当天奖励10分，累计10分。</P>
					<p class="font12" style="color:#909090">连续第2天23:00点前打卡，当天奖励10分，累计20分。</p>
					<p class="font12" style="color:#909090">连续第3天23:00点前打卡，当天奖励10分，累计30分。</p>
					<p class="font12" style="color:#909090">连续第4天23:00点前打卡，当天奖励10分，累计40分。</p>
					<p class="font12" style="color:#909090">连续第5天23:00点前打卡，当天奖励50分，累计90分。</p>
					<p class="font12" style="color:#909090">连续第6天23:00点前打卡，当天奖励10分，累计100分。</p>
					<p class="font12" style="color:#909090">......</p>
					<p class="font12">中断打卡后，累积天数从1开始算，总积分累计。</p>
					<p class="font12">分享活动到朋友圈可获得5积分，每天限一次；成功邀请好友打卡一次获5积分，最多邀请100人。</p>
					<p class="font12">每月月底零点前进行积分排名，零点后积分清零。</p>
        </div>
   </div>
   <div id="bott"></div>
   <script>
        $("#send").click(function(){
            $("#send_show").css({display:"block"});
            })
        $("#dis_n").click(function(){
            $("#send_show").css({display:"none"});
            })
        $("#show_i_b").click(function(){
            $("#show_i").css({display:"block"});
            })
         $("#gui").click(function(){
            $("#show_gui").css({display:"block"});
            })  
            
        $(".close").click(function(){
            $("#show_i").css({display:"none"});
            $("#show_gui").css({display:"none"});   
            })
            
        $("#add_b").click(function(){
            $("#ji_f").css({display:"block"});
            $("#time").css({display:"none"});
            $("#add_b").addClass("on");
            $("#time_b").removeClass("on");
            $("#time_b").addClass("lan_bo");
            })
        $("#time_b").click(function(){
            $("#ji_f").css({display:"none"});
            $("#time").css({display:"block"});
            $("#time_b").addClass("on");
            $("#add_b").removeClass("on");
            $("#add_b").addClass("lan_bo")
            }) 
			var length=document.documentElement.clientHeight-60;
			$(".fix").css({top:length});
   </script>
</body>
</html>