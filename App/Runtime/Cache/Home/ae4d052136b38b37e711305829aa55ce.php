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

	<empty class="vip-buys">

		<div class="radio-list">
			<?php if(is_array($package_list)): $k = 0; $__LIST__ = $package_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><label for="type1">
				<input type="radio" id="type1" <?php if($k == 1): ?>checked<?php endif; ?> value="<?php echo ($vo["id"]); ?>" name="radio">
				<span><?php echo ($vo["package_name"]); ?></span>
			</label><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>

		<div class="radio-tab">
			<?php if(is_array($package_list)): $k1 = 0; $__LIST__ = $package_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k1 % 2 );++$k1;?><div style="<?php if($k1 == 1): ?>display: block<?php else: ?>display: none<?php endif; ?>">
                <?php if(!empty($vo["type_list"])): ?><h3><?php echo ($vo["package_name"]); ?>(<?php echo ($vo["package_price"]); ?>)元</h3>
				<strong>一次性补贴：</strong>
				<ul>
                    <?php if(is_array($vo["type_list"])): foreach($vo["type_list"] as $k=>$vo1): ?><li><?php echo ($k+1); ?>. <?php echo ($vo1["type_name"]); ?> <?php echo ($vo1["type_scale"]); ?>%</li><?php endforeach; endif; ?>
				</ul><?php endif; ?>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>

		</div>

		<input type="submit" id="wechar_pay" value="去支付">

	</div>

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
	});

	$(function(){

		$('.radio-list label').on('click',function(){
			var _this = $(this),
				_index = _this.index();

			$('.radio-tab > div').eq(_index).show().siblings().hide();
		})

		//提交订单
		$('#wechar_pay').click(function(){
			layer.open({type: 2});
			var type = $('input[name="radio"]:checked').val();
			if( type < 0 ) return false;
			//获取钱数
			$.post("<?php echo U('index/getMoney');?>", {type:type}, function(data){
				if(data.status == 'y'){
					layer.closeAll();
					callpay(data.appId,data.timeStamp,data.nonceStr,data.package,data.signType,data.paySign);
				}else{
					layer.closeAll();
					alert(data.msg);
				}
			},'json');
		})

	})

</script>

</body>
</html>