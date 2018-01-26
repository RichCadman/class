<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>开始训练</title>
<link rel="stylesheet" type="text/css" href="css/kaola.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-3.1.1.js"></script>
</head>
<body>
    <div class=" width100 height100 fixed bCover" style="left:0;top:0; background:url(img/wdjf-bg.png) no-repeat center;z-index:-1;">
    </div>
    <div class="width85 center hidden" style="margin-top:20px;" id="top_fo">
        <div class="fl width50 hidden">
            <img src="img/bzzx_pic1.png" class="width33 fl radius50">
            <p class="block fr width65 top_i">这个世界不太懂</p>
        </div>
        <div class="fr width25 center tcenter hidden">
            <h4 class="font100">累计积分</h4>
            <span class="block baise te_s">1562</span>
            <p class="baise width100 ji_f tcenter boxSizing"id="gui">积分规则</p>
        </div>
    </div>
    <img src="img/jifen.png" class="width20 center my_im">
    <div class="width90 center lvse_bg hidden center" id="my_ra">
        <div class="block width100" id="show_i_b">
        <img src="img/dkcg-1.png" class="width5" style="margin-left:92%; margin-top:10px;">
        </div>
       <h3 class="width100 tcenter shenl">今日打卡成功明日再接再厉</h3>  
       <p class="baise font12 center width33 tcenter">2017-05-01</p>
       <h3 class="tcenter shenl center font24" style="margin:0 auto">今日积分<span class="huangse">20</span>分</h3>
       <div class=" width75 center hidden" style="margin-bottom:30px; margin-top:20px;" id="cha_k">
           <div class="block center tcenter lvborder width45 fl lan_b lan_f boxSizing zp" style="padding:5px;">
                <font> 查看电子答案</font>
           </div>
          <div class="block center tcenter width45 fr huangse_b huangse boxSizing sp" style="padding:5px;">
                <font>查看视频答案</font>
          </div>
       </div>
      
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
        <div class="width100" style="margin-top:25px;">
          <div class="width100 bj_fff" style="margin-top:30px;">
            <div class="width100" style="margin-top:25px;">
                <div class="hidden" id="ji_f">
                    <div class="width100 hidden">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 boxSizing" style="padding:15%;"></span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o"  style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">我的排名</h4>
                                <p class="huise ming">第20名</p>
                            </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                    <div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:9%;">
                                <img src="img/one.png" class="width100">
                            </span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">我的排名</h4>
                            </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                    <div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:9%;">
                                <img src="img/two.png" class="width100">
                            </span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">我的排名</h4>
                           </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                    <div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:8%;">
                                <img src="img/three.png" class="width100">
                            </span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">这个世界</h4>
                            </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                </div>
                <div class="hidden" id="time" style="display:none;">
                    <div class="width100 hidden">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 boxSizing" style="padding:15%;"></span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">我的排名</h4>
                                <p class="huise ming">第21名</p>
                            </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                    <div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:9%;">
                                <img src="img/one.png" class="width100">
                            </span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">我的排名</h4>
                            </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                    <div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:9%;">
                                <img src="img/two.png" class="width100">
                            </span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">我的排名</h4>
                           </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                    <div class="width100 hidden" style="margin-top:20px;">
                        <div class="width45 fl hidden">
                            <span class="block fl width10 my_span" style="margin-left:8%;margin-right:8%;">
                                <img src="img/three.png" class="width100">
                            </span>
                            <img src="img/bzzx_pic1.png" class="fl width20">
                            <div class="fl boxSizing my_pai_o mypai_o" style="margin-left:5%;margin-top:6px;">
                                <h4 class="font100">这个世界</h4>
                            </div>
                        </div>
                        <div class="fr width16 fr_f">466分</div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="fixed bj_fff width100 hidden" style="height:60px;bottom:0;left:0;">
        <a href="javascript:void(0)" class="block width45 fl tcenter" style="height:60px;line-height:70px;" id="send">
            <img src="img/fx.png" class="in_block nav">
        </a>
        <a href="javascript:void(0)" class="block width45 fr tcenter" style="height:60px;line-height:70px;">
            <img src="img/jf.png" class="in_block nav">
        </a>
    </div>
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="send_show">
        <img src="img/组 1041.png" class="width85 center">
        <div class="width33 radius10 lanse_bg center tcenter" id="dis_n">
            知道了
        </div>
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="show_i">
        <div class="bj_fff width75 center relative radius10 boxSizing" style="margin-top:150px; padding:35px;">
            <img src="img/close.png" class="absolute width16 close" style="top:-10px;right:-10px;">
            <p class="font16 center tcenter">如果有疑问可以加群咨询</p>
            <h4 class="font20 center tcenter lan_f font100" style="margin-top:6px;">QQ群号：123456</h4>
        </div>
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="show_gui">
        <div class="bj_fff width75 center relative radius10 boxSizing" style="margin-top:150px; padding:35px;">
            <img src="img/close.png" class="absolute width16 close" style="top:-10px;right:-10px;">
            <h3 class="tcenter lan_f" style="margin-bottom:15px;">积分规则</h3>
            <p class="font14">中断打卡后，当天奖励积分重新从10分开始计算，总积分累计</p>
        </div>
   </div>
    <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="zp_y">
        <div class="page width100 center relative" style="margin-top:20%;">
            <div class="pinch-zoom width100 absolute" style="top:10%;left:1%;" >
                <img src="img/pzsc.png" class="center">
            </div>
        </div>
        <div id="kb" class="height100">
            
        </div> 
   </div>
   <div class=" width100 height100 fixed bContain center" style="left:0;top:0; z-index:9999; display:none; background:rgba(0,0,0,0.7);" id="sp_y">
        <iframe frameborder="0" width="640" height="30%"class="block" style="margin-top:40%"></iframe>
   </div>
   <script src="js/jquery-1.7.2.min.js"></script>
   <script src="js/pinchzoom.js"></script>
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
        $(".zp").click(function(){
            $("#zp_y").css({display:"block"});
            })
        $(".sp").click(function(){
            $("#sp_y").css({display:"block"});
            })
        $("#kb").click(function(){
            $("#zp_y").css({display:"none"});
            })  
        $(function () {
            $('div.pinch-zoom').each(function () {
                new RTP.PinchZoom($(this), {});
            });
        })                  
   </script>
</body>
</html>