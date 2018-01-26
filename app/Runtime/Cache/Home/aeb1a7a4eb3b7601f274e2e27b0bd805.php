<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>积分详情</title>
<link rel="stylesheet" type="text/css" href="/pub/home/css/kaola.css">
</head>
<body>
<div>
<?php if(is_array($info)): foreach($info as $key=>$v): ?><div class="width92 center hidden radius6" style="margin-top:20px; margin-bottom:25px; background:#f7f7f7;  padding:10px;">
    	<div class="fl">
        	<h4 style="font-size:18px;"><?php echo ($v["type"]); ?></h4>
            <span class="other-month font12"><?php echo date("Y-m-d H:s:i",$v['time']);?></span>
        </div>
        <div class="fr" style="line-height:40px; color:#1FAED7">+<?php echo ($v["point"]); ?>分</div>
    </div><?php endforeach; endif; ?>	
    
</div>	
</body>
</html>