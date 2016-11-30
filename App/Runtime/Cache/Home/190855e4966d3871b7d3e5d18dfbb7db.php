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
	<script language="javascript">
		function jsApiCall(appId,timeStamp,nonceStr,package,signType,paySign)
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest', {
					"appId" : appId,     //公众号名称，由商户传入
					"timeStamp": timeStamp,         //时间戳，自1970年以来的秒数
					"nonceStr" : nonceStr, //随机串
					"package" : package,
					"signType" : signType,         //微信签名方式:
					"paySign" : paySign //微信签名
				},
				function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg == "get_brand_wcpay_request:ok" ) {
						window.location.href = "http://"+window.location.host;
					}else if(res.err_msg == "get_brand_wcpay_request:cancel"){
						layer.open({
							btn: ['确定'],content:'您取消了支付！',shade:true,shadeClose:false})
					}else if(res.err_msg == "get_brand_wcpay_request:fail"){
						layer.open({btn: ['确定'],content:'支付失败',shade:true,shadeClose:false})
					}
				}
			);
		}

		function callpay(appId,timeStamp,nonceStr,package,signType,paySign)
		{
			if (typeof WeixinJSBridge == "undefined"){
				if( document.addEventListener ){
					document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
				}else if (document.attachEvent){
					document.attachEvent('WeixinJSBridgeReady', jsApiCall);
					document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
				}
			}else{
				jsApiCall(appId,timeStamp,nonceStr,package,signType,paySign);
			}
		}
	</script>
</head>
<body>
	
	<header>
		<h1>订单</h1>
		<a href="" class="glyphicon glyphicon-chevron-left"></a>
	</header>

	<footer>
    <menu>
        <a href="<?php echo U('index/index');?>" <?php if(empty($action)): ?>class="active"<?php endif; ?>>
            <span class="glyphicon glyphicon-home"></span>
            <small>首页</small>
        </a>
        <a href="<?php echo U('index/goods');?>" <?php if($action == 'info'): ?>class="goods"<?php endif; ?>>
            <span class="glyphicon glyphicon-shopping-cart"></span>
            <small>购买服务</small>
        </a>
        <a href="<?php echo U('index/order');?>" <?php if($action == 'order'): ?>class="active"<?php endif; ?>>
            <span class="glyphicon glyphicon-list"></span>
            <small>订单详情</small>
        </a>

        <a href="<?php echo U('index/info');?>" <?php if($action == 'info'): ?>class="active"<?php endif; ?>>
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

	    <!--&lt;!&ndash; userinfo &ndash;&gt;-->
	    <!--<div class="user-info clearfix">-->
	    	<!--<div class="photo">-->
	    		<!--<img src="img/cdl.jpg" alt="">-->
	    	<!--</div>-->
	    	<!--<div class="detail">-->
				<!--<span>账号：530000063851</span>-->
				<!--<span>金卡会员：2016年9月9日 到期</span>-->
	    	<!--</div>-->
	    <!--</div>-->

		<div class="user-type">
			<span>姓名：<?php echo ($user_info["name"]); ?></span>
			<span>身份证号：<?php echo ($user_info["idcard"]); ?></span>
		</div>
		
	<!-- order-detail start -->

		<!-- userinfo -->
	    <div class="user-info clearfix">
	    	<div class="photo">
	    		<img src="/<?php echo ($data["image"]); ?>" alt="">
	    	</div>
	    	<div class="detail orders">
	    		<div class="clearfix">
					<?php if($data["order_status"] == 0): ?><a href="" class="float-right ">未付款</a>
					<?php elseif($data["order_status"] == 2): ?>
						<a href="" class="float-right ">已付款</a>
					<?php elseif($data["order_status"] == 3): ?>
                        <a href="" class="float-right ">退款中</a>
                    <?php elseif($data["order_status"] == 4): ?>
                        <a href="" class="float-right ">已完成</a>
                    <?php elseif($data["order_status"] == 5): ?>
                        <a href="" class="float-right ">已退款</a><?php endif; ?>
	    			<!-- <a href="" class="float-right status-red">未付款</a> -->
	    			<!-- <a href="" class="float-right status-blue">已付款</a> -->
	    			<h4><?php echo ($data["goods_name"]); ?></h4>
	    		</div>
	    		<small>订单编号：<?php echo ($data["order_sn"]); ?></small>
	    		<small>创建时间：<?php echo (date('Y-m-d H:i:s',$data["addtime"])); ?></small>
	    	</div>
	    </div>

		<div class="order-detail">
			
			<strong>订单简介</strong>

			<article>
				<?php echo ($data["good_detail"]); ?>
			</article>

			<div class="clearfix">
				<div class="float-right">
					<span>价格：￥<?php echo ($data["money"]); ?></span>
					<?php if($data["order_status"] == 0): ?><a id="wechar_pay">付款</a>
                    <?php elseif($data["order_status"] == 2): ?>
						<a href="<?php echo U('index/refund', array('id'=>$data['id']));?>" class="float-right ">退款</a><?php endif; ?>
				</div>
			</div>

		</div>
	
	<!-- order-detail end -->

	</section>
	
	<script src="/Public/Home/js/jquery.min.js"></script>
	<script src="/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
	<script src="/Public/Home/js/layer/layer.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			autoplay : 3000,    //可选选项，自动滑动
			pagination: '.swiper-pagination',
			paginationClickable: true
			// 启用箭头
			// nextButton: '.swiper-button-next',
			// prevButton: '.swiper-button-prev'

			//提交订单
		});
		$('#wechar_pay').click(function(){
			layer.open({type: 2});
			var id = <?php echo ($data["id"]); ?>;
			if( id <= 0 ) return false;
			//获取钱数
			$.post("<?php echo U('index/submit_order');?>", {id:id}, function(data){
				if(data.status == 'y'){
					layer.closeAll();
					callpay(data.appId,data.timeStamp,data.nonceStr,data.package,data.signType,data.paySign);
				}else{
					layer.closeAll();
					alert(data.msg);
				}
			},'json');
		})

	</script>

</body>
</html>