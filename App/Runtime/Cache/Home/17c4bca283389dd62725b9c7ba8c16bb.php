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
	<link rel="stylesheet" href="/longhcuanwenhua/Public/Home/css/style.css">
	<link rel="stylesheet" href="/longhcuanwenhua/Public/Home/js/swiper/css/swiper.min.css">
</head>
<body>
	
	<header>
		<h1>诊疗套餐</h1>
		<a href="" class="glyphicon glyphicon-chevron-left"></a>
	</header>

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
            <a href="http://<?php echo ($vo["url"]); ?>"><img src="/longhcuanwenhua/<?php echo ($vo["image"]); ?>" alt=""></a>
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


	    <!-- shop-list -->
	    <div class="shop-list">
	    	<?php if(is_array($goods_list)): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
		    	<a href="<?php echo U('index/goods_detail', array('id'=>$vo['id']));?>">
		    		<div class="name"><?php echo ($vo["good_name"]); ?></div>
		    		<span class="now-price">价格：￥<?php echo ($vo["good_price"]); ?></span>
		    	</a>
	    	</div><?php endforeach; endif; else: echo "" ;endif; ?>
	    </div>


	</section>
	
	<script src="/longhcuanwenhua/Public/Home/js/jquery.min.js"></script>
	<script src="/longhcuanwenhua/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
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