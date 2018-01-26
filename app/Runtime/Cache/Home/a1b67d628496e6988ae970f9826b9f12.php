<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,user-scalable=no">
<title>开始训练</title>
<link rel="stylesheet" type="text/css" href="/pub/home/css/kaola.css">
<script src="/pub/home/js/jquery-3.1.1.js"></script>
<script type="text/javascript">
        $(function(){
            $.getJSON("/index.php/Index/getJSON",function(json){
			
                $.each(json,function(i,n){
                    $('.current-month').each(function(){
                        var time=$(this).find('span').attr("title");
						//alert(n.time);
						var myDate = new Date;
						//alert(myDate);
						var year = myDate.getFullYear();//获取当前年
						var yue = myDate.getMonth()+1;//获取当前月
						var date = myDate.getDate();//获取当前日
						var d=year+'-'+yue+'-'+date;
						//alert(d);
                        if(n.time==time){
							if(n.time!=d){
								$(this).find('span').css("background-color","#fedd45");
							}
                        }
                     }) 
                })
            })
        })
      </script> 
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

    <div class="center radius50 clodaka" style="margin-top:10px;margin-bottom:-15px;">
        <img src="<?php echo ($userinfo["wx_photo"]); ?>" class="width100 center radius50">
    </div>
    <div class="width90 center bgColor boxSizing hidden huiz">
        <ul class="hidden center ul_w">
            <li class="width33 fl boxSizing borderd8 tcenter center">
                <h3 class="huise font100 center">已经打卡</h3>
                <p>
                    <span class="lv tcenter"><?php echo ($userinfo["total_count"]); ?></span>
                    <font class="huise tcenter">天</font>
                </p>
            </li>
            <li class="width33 fl boxSizing borderd8 center tcenter">
                <h3 class="huise font100">最长连续</h3>
                <p>
                    <span class="lv"><?php echo ($userinfo["max_count"]); ?></span>
                    <font class="huise tcenter">天</font>
                </p>
            </li>
            <li class="width33 fl boxSizing borderd8 center borderno tcenter">
                <h3 class="huise font100">累计积分</h3>
                <p>
                    <span class="lv"><?php echo ($userinfo["point"]); ?></span>
                    <font class="huise">分</font>
                </p>
            </li>
        </ul>
    </div>
    <div id='schedule-box' class="boxshaw center boxSizing width90">
        
    </div>
	<div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="show_ti">
        <div class="bj_fff width75 center relative radius10 boxSizing" style="margin-top:150px; padding:35px;">
           
            <p class="font16 center tcenter">当前日期暂无题目</p>
          
        </div>
   </div>
    <div class="yinc">
        <h3 id='h3Ele'></h3>
    </div>
    <script src="/pub/home/js/schedule.js"></script>
    <script>
        var mySchedule = new Schedule({
        el: '#schedule-box',
        //date: '2018-9-20',
        clickCb: function (y,m,d) {
			$.getJSON("/index.php/Index/getJSON",function(json){
			
                $.each(json,function(i,n){
                    $('.current-month').each(function(){
                        var time=$(this).find('span').attr("title");
						//alert(n.time);
						var myDate = new Date;
						//alert(myDate);
						var year = myDate.getFullYear();//获取当前年
						var yue = myDate.getMonth()+1;//获取当前月
						var date = myDate.getDate();//获取当前日
						var d=year+'-'+yue+'-'+date;
						//alert(d);
                        if(n.time==time){
							if(n.time!=d){
								$(this).find('span').css("background-color","#fedd45");
							}
                        }
                     }) 
                })
            })
            document.querySelector('#h3Ele').innerHTML = y+'-'+m+'-'+d;
			$('#change_img').empty();
            $('#change_img1').empty();
            var date = $('#h3Ele').text();
            var url = '/index.php/Index/get_answer';
           $.getJSON(url,{date:date},function(json){
                if(json==null){
                      //window.location.reload();
					$(".today_dk").css({display:"none"});
					$("#show_ti").css({display:"block"})
					$("#colok_di").css({display:"none"});
					 $("#show_ti").click(function(){
						$("#show_ti").css({display:"none"});
					}) 
                }else if(json==1){
					$(".today_dk").css({display:"none"});
					$("#show_ti").css({display:"block"});
					$("#colok_di").css({display:"none"});
					 $("#show_ti").click(function(){
						$("#show_ti").css({display:"none"});
					})  
				}else if(json==0){
                    window.location='/index.php/Index/answer1'; 
                }else if(json==2){
                    window.location='/index.php/Index/answer'; 
                }else{
                    //alert(json);
                    //alert(json.content);
                    //result+="<option value='"+n.id+"'>"+n.employee_name+"</option>";
					$(".today_dk").css({display:"block"});
					$("#colok_di").css({display:"none"});
                    img="<img src='/pub/upload/"+json.content+"' class='center block width100'>";
                   $('#change_img').append(img); 
                   $('#change_img1').append(img);
                   $('form').attr('action','/index.php/Submit/submit/problem_id/'+json.id); 
                }
            });  
            //alert(date);   
        },
        nextMonthCb: function (y,m,d) {
            document.querySelector('#h3Ele').innerHTML = y+'-'+m+'-'+d
        },
        nextYeayCb: function (y,m,d) {
            document.querySelector('#h3Ele').innerHTML =y+'-'+m+'-'+d
        },
        prevMonthCb: function (y,m,d) {
            document.querySelector('#h3Ele').innerHTML = y+'-'+m+'-'+d  
        },
        prevYearCb: function (y,m,d) {
            document.querySelector('#h3Ele').innerHTML =y+'-'+m+'-'+d
        }
    });
    </script>
    <div class="width90 tcenter center" id="todaymain">
        <span></span>
        <font class="font20">今日题目</font>
        <span></span>
    </div>
    <div class="width85 center hidden ti_pic" id="change_img" style="margin-top:20px;">
					<?php if($info['content']): ?><img src="/pub/upload/<?php echo ($info["content"]); ?>" class="center  block width100"><?php endif; ?>
    </div>
	
    <div class="center width50 relative today_dk" style="margin-top:10px;margin-bottom:70px;" id="pic">
        <img src="/pub/home/img/pzsc.png" class="center" style="width:40%;">
        <h3 class="font16 font100 width100 tcenter" style="color:#3ee67a">点击拍照上传</h3>
        <form action="/index.php/Submit/submit/problem_id/<?php echo ($info["id"]); ?>" method="post" enctype="multipart/form-data" >
        <input type="file" name="img" class="block absolute" style="width:100%;height:100%;top:0;left:0;opacity:0;"id="file_upload" accept="image/*" >
        </form>
    </div>
	
	<script type="text/javascript">
	$(function(){
		var plateform = Zepto.device.os;
		if(plateform == "android"){
		 $("selector").find("input[type='file']").attr("capture","camera");
		}else if(plateform=="ios"){         
		  $("selector").find("input[type='file']").removeAttr("capture");
		}
	})
		
	</script>
	
    <div id="colok_di" class="yinc hidden" style=" margin-bottom:80px;">
        <div class=" center hidden" style="margin-top:30px;"> 
            <div class="page width100 center ">
            <div class="width100">
                <div class="pinch-zoom width50 hidden" >
                    <img src="img/pzsc.png" class="center  block width85" id="preview">
                </div>
            </div>
        </div>
        </div>
        <div style="margin-top:20px; margin-bottom:30px;" class="width50 center hidden boxSizing">
         <a href="javascript:void(0)" class="block width45 fl radius6 center hidden boxSizing ap" style="border:1px solid #f9807d;" id="delete">
            <img src="/pub/home/img/sc.png" class="fl width33">
            <font class="block fl madfont boxSizing" style="color:#f9807d;">删除</font>
         </a>
         <a href="javascript:void(0)" onclick="return ajaxFileUpload();" class="block width45 fr radius6 center hidden boxSizing ap" style="border:1px solid #6cd8b6;" id="submit">
            <img src="/pub/home/img/tj.png" class="fl width33">
            <font class="block fl madfont boxSizing"style="color:#6cd8b6;">提交</font>
         </a>
        </div>
    </div>
	<!--发送邀请，我的积分-->
    <div class="fixed width100 hidden" style="height:60px;bottom:0;left:0;">
        <a href="javascript:void(0)" class="block width33 fl tcenter" style="height:60px;line-height:85px; margin-left:10%" id="send">
            <img src="/pub/home/img/fx.png" class="in_block width100">
        </a>
        <a href="/index.php/Point/index" class="block width33 fr tcenter" style="height:60px;line-height:85px; margin-right:10%">
            <img src="/pub/home/img/jf.png" class="in_block width100">
        </a>
    </div>
	
    <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none;   background:rgba(0,0,0,0.7);" id="send_show">
        <img src="/pub/home/img/you.png" class="width85 center">
        <div class="width33 radius10 lanse_bg center tcenter" id="dis_n">
            知道了
        </div>
   </div>

   <div class=" width100 height100 fixed bContain center ti_zp" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);">
        <div class="page width85 center relative" style="padding-top:10%;">
            <div class="pinch-zoom width100 absolute" id="change_img1" style="top:10%;left:1%;" >
                <?php if($info['content']): ?><img src="/pub/upload/<?php echo ($info["content"]); ?>" class="center width90"><?php endif; ?>
            </div>
        </div>
   </div>
   
   <div id="bott"></div>
    <script src="/pub/home/js/jquery-1.7.2.min.js"></script>
   <script src="/pub/home/js/pinchzoom.js"></script>
    <script type="text/javascript">
        $(function ab() {
            $("#file_upload").change(function () {
                var $file = $(this);
                var fileObj = $file[0];
                var windowURL = window.URL || window.webkitURL;
                var dataURL;
                var $img = $("#preview");

                if (fileObj && fileObj.files && fileObj.files[0]) {
                    dataURL = windowURL.createObjectURL(fileObj.files[0]);
                    $img.attr('src', dataURL);
                } else {
                    dataURL = $file.val();
                    var imgObj = document.getElementById("preview");
                    imgObj.style.filter ="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                    imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;
                }
            $("#colok_di").css({display:"block"});
            $("#pic").css({display:"none"});
            $("#delete").click(function(){
                $("#preview").src="";
                $("#pic").css({display:"block"});
                $("#colok_di").css({display:"none"});
                })
            });
    
        });
    $("#send").click(function(){
            $("#send_show").css({display:"block"});
            })
    $("#dis_n").click(function(){
            $("#send_show").css({display:"none"});
            })
	$(".ti_pic").click(function(){
            $(".ti_zp").css({display:"block"});
            })
    $(".ti_zp").click(function(){
            $(".ti_zp").css({display:"none"});
            })
     $(function () {
            $('div.pinch-zoom').each(function () {
                new RTP.PinchZoom($(this), {});
            });
        })             
    </script>
      <script type="text/javascript">
        $(function(){
            $("#submit").click(function(){
                $("form").submit();
            })
        })
      </script> 
</body>
</html>