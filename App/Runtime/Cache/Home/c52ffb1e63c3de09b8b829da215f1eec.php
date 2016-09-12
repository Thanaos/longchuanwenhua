<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>新阳光体育</title>
<link rel="stylesheet"  href="/Public/Home/css/yl.home.min.css" />
</head>
<body>
    <div class="type-index">
        <div class="headbar bg1">
            <h1 class="title">我的账号信息</h1>
        </div>
	<!--/ header-->
	
	
    <div class="hm_index_header">
    
        <a href="#" class="my-head-photo"><img src="<?php echo ($userinfo["headimg"]); ?>" width="120" height="120"></a>
    </div>
	<!--/ hm_index_header-->
	
	<div class="hm-zh">
		<form action="#">
			<ul class="mb30">
                <?php if(!empty($userinfo["number"])): ?><li class="mb15"><strong class="bt">会员编号：</strong><?php echo ($userinfo["number"]); ?></li><?php endif; ?>
                <li class="mb15"><strong class="bt">姓名：</strong><?php echo ($userinfo["name"]); ?></li>
                <li class="mb15"><strong class="bt">生日：</strong><?php echo ($userinfo["birthday"]); ?></li>
                <?php if(!empty($userinfo["jhr_name"])): ?><li><strong class="bt">监护人姓名：</strong><?php echo ($userinfo["jhr_name"]); ?></li><?php endif; ?>
				<empty name="userinfo.jhr_tel"><li><strong class="bt">监护人手机：</strong><?php echo ($userinfo["jhr_tel"]); ?></li></notempty>
                <li><strong class="bt">会员状态：</strong><?php if($userinfo["status"] == 1): ?>在学<?php elseif($userinfo["status"] == 2): ?>停课<?php elseif($userinfo["status"] == 3): ?>终止<?php endif; ?></li>
                <?php if(!empty($userinfo["bm_time"])): ?><li><strong class="bt">报名时间：</strong><?php echo ($userinfo["bm_time"]); ?></li><?php endif; ?>
                <enotemptympty name="userinfo.endtime"><li><strong class="bt">结课时间：</strong><?php echo ($userinfo["endtime"]); ?></li></notempty>
                <li><strong class="bt">课时数：</strong><?php echo ($userinfo["sy_num"]); ?></li>
                <li><strong class="bt">积分：</strong><?php echo ($userinfo["points"]); ?></li>
			</ul>
            <!--<div class="tc"><input type="submit" class="sub-btn w100" value="保存修改" name=""></div>-->
			
		</form>	
	</div>
	<!--/hm-zh-->


	
</div>
<!--/ type-index-->
</body>
</html>