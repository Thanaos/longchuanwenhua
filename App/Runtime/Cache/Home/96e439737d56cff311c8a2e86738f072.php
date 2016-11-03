<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>特尊医疗</title>
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
	
	<header>
		<h1>我的订单</h1>
		<a href="" class="glyphicon glyphicon-chevron-left"></a>
	</header>


	<footer>
    <menu>
        <a href="<?php echo U('index/index');?>" <?php if(empty($action)): ?>class="active"<?php endif; ?>>
            <span class="glyphicon glyphicon-home"></span>
            <small>首页</small>
        </a>
        <a href="<?php echo U('index/goods');?>">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            <small>购买服务</small>
        </a>
        <a href="<?php echo U('index/order');?>" <?php if($action == 'order'): ?>class="active"<?php endif; ?>>
            <span class="glyphicon glyphicon-list"></span>
            <small>订单详情</small>
        </a>

        <a href="<?php echo U('index/info');?>">
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
           <img src="/<?php echo ($vo["image"]); ?>" alt="">
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


		<div class="user-type">
			<span>姓名：<?php echo ($user_info["name"]); ?></span>
			<span>身份证号：<?php echo ($user_info["idcard"]); ?></span>
		</div>

		<div class="user-tab">
			<menu>
				<button <?php if($status == 1): ?>class="active"<?php endif; ?>><a href="<?php echo U('index/order', array('status'=>1));?>">全部</a></button>
				<button <?php if($status == 2): ?>class="active"<?php endif; ?>><a href="<?php echo U('index/order', array('status'=>2));?>">未付款</a></button>
				<button <?php if($status == 3): ?>class="active"<?php endif; ?>><a href="<?php echo U('index/order', array('status'=>3));?>">已付款</a></button>
			</menu>

			<div class="user-item">
				<ul style="display: block">
                    <?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<a href="<?php echo U('index/order_detail', array('id'=>$vo['id']));?>">
							<span class="time"><?php echo (date('Y-m-d',$vo["addtime"])); ?></span>
							<strong><?php echo ($vo["goods_name"]); ?></strong>
							<small>&gt;</small>
							<span class="status"><?php if($vo["order_status"] == 0): ?>未付款<?php elseif($vo["order_status"] == 2): ?>已付款<?php elseif($vo["order_status"] == 3): ?>退款中<?php elseif($vo["order_status"] == 4): ?>已完成<?php elseif($vo["order_status"] == 5): ?>已退款<?php endif; ?></span>
						</a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>

		</div>

	</section>
	
	<script src="/Public/Home/js/jquery.min.js"></script>
	<script src="/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			autoplay : 3000,    //可选选项，自动滑动
	        pagination: '.swiper-pagination',
	        paginationClickable: true
	        // 启用箭头
	        // nextButton: '.swiper-button-next',
	        // prevButton: '.swiper-button-prev'
	    });

		$(function(){

		})

	</script>	

</body>
</html>