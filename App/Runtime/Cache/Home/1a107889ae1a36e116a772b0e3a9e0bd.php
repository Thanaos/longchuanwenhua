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
		<h1>套餐详情</h1>
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
	    <div class="shop-detail">
	    	
	    	<h3><?php echo ($goods_data["good_name"]); ?></h3>
            <?php if(($scale_price == 'yuan') and ($scale_price != 0)): ?><span>价格：￥<?php echo ($goods_data["good_price"]); ?></span>
			<?php else: ?>
				<span class="old-price">原价：￥<?php echo ($goods_data["good_price"]); ?></span>
				<span class="new-price">现价：￥<?php echo ($scale_price); ?></span><?php endif; ?>

			<hr>

			<div>
                <?php echo ($goods_data['good_detail']); ?>
			</div>
			<input type="button" id="wechar_pay" value="去支付">
	    </div>


	</section>
	
	<script src="/longhcuanwenhua/Public/Home/js/jquery.min.js"></script>
	<script src="/longhcuanwenhua/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
	<script src="/longhcuanwenhua/Public/Home/js/layer/layer.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true
	        // 启用箭头
	        // nextButton: '.swiper-button-next',
	        // prevButton: '.swiper-button-prev'

			//提交订单
		});
		$('#wechar_pay').click(function(){
			layer.open({type: 2});
			var id = <?php echo ($goods_data["id"]); ?>;
			if( id <= 0 ) return false;
			//获取钱数
			$.post("<?php echo U('index/sub_goods');?>", {id:id}, function(data){
				if(data.status == 'y'){
				    layer.closeAll();
					if( data.money == 0 ){
						window.location.href = "<?php echo U('index/index');?>";
					}
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