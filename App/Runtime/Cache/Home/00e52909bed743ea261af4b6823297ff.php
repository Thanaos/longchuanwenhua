<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<!-- <meta name="format-detection" content="telephone=no"/> -->
	<meta name="format-detection" content="email=no"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
	<link rel="stylesheet" href="/Public/Home/css/style.css">
	<link rel="stylesheet" href="/Public/Home/js/swiper/css/swiper.min.css">

</head>
<body>

<footer>
    <menu>
        <a href="<?php echo U('index/index');?>" <?php if(empty($action)): ?>class="active"<?php endif; ?>>
            <span class="glyphicon glyphicon-home"></span>
            <small>首页</small>
        </a>
        <a href="<?php echo U('index/order');?>" <?php if($action == 'order'): ?>class="active"<?php endif; ?>>
            <span class="glyphicon glyphicon-list"></span>
            <small>订单详情</small>
        </a>
        <a href="">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            <small>缴费结算</small>
        </a>
        <a href="">
            <span class="glyphicon glyphicon-user"></span>
            <small>会员信息</small>
        </a>
    </menu>
</footer>

	<section class="page">
		<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
            <a href="http://<?php echo ($vo["url"]); ?>"><img src="/<?php echo ($vo["image"]); ?>" alt=""></a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- 启用下标 -->
    <div class="swiper-pagination"></div>
    <!-- 启用左右箭头 -->
    <!--
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    -->
</div>
		<div class="admin-info clearfix">
			<div class="photo">
				<img src="<?php echo ($user_info["headimg"]); ?>" alt="">
				<!-- 
					如果需要图片上传
					这个地方就用a触发微信的图片上传接口吧...
					开个队列在下载到服务器就成..file的兼容太渣
				 -->
				<a href="javascript:void(0);"></a>
			</div>
			<span>姓名：<?php echo ($user_info["name"]); ?></span>
			<?php if($user_info["vip"] == 0): ?><span><a href="<?php echo U('index/getVip');?>" style="display: block; color: #ffffff; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; margin: 0 auto; background-color: #31619d; width: 4rem; border-width: 0;">购买会员</a></span>
			<?php else: ?>
				<?php if($time > $user_info['vip_time']): ?><span><a href="<?php echo U('index/getVip');?>" style="display: block; color: #ffffff; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; margin: 0 auto; background-color: #31619d; width: 4rem; border-width: 0;">立即续费</a></span>
				<?php else: ?>
					<span><?php echo ($package["package_name"]); ?>：<?php echo (date('Y年m月d日',$user_info["vip_time"])); ?> 到期</span><?php endif; endif; ?>
		</div>

		<div class="admin-box">
			<div class="admin-title">
				活动专区
			</div>
			<div class="admin-nav">
				<a href="<?php echo U('index/subsidies');?>" class="type-1">
					补贴申请
					<small>详细说明</small>
				</a>
				<a href="<?php echo U('index/getVIp');?>" class="type-2">
					会员资格
					<small>会员升级/降级/注销</small>
				</a>
			</div>
		</div>

		<div class="admin-box">
			<div class="admin-title">
				功能专区
			</div>
			<div class="admin-nav">
				<a href="" class="type-3">
					诊疗挂号
					<small>尚未就诊</small>
				</a>
				<a href="" class="type-4">
					预约专家
					<small>尚未预约</small>
				</a>
				<a href="http://tezunyiliao.bama555.com/detail?id=57c821b04e5de054" class="type-5">
					会员必读
					<small>请阅读此信息</small>
				</a>
				<a href="<?php echo U('index/goods');?>" class="type-6">
					诊疗套餐
					<small>套餐购买</small>
				</a>
				<a href="http://tezunyiliao.bama555.com/detail?id=57f31108888f9066" class="type-7">
					会费价格	
					<small>费用介绍</small>
				</a>
				<a href="http://tezunyiliao.bama555.com/detail?id=57c833a7c2a6a027" class="type-8">
					补贴标准	
					<small>补贴介绍</small>
				</a>
			</div>
		</div>

	</section>
	<script src="/Public/Home/js/jquery.min.js"></script>
	<script src="/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			pagination: '.swiper-pagination',
			paginationClickable: true
			// 启用箭头
			// nextButton: '.swiper-button-next',
			// prevButton: '.swiper-button-prev'
		});
	</script>
</body>
</html>