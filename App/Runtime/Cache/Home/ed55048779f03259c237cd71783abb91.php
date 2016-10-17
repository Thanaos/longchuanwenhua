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
	<link rel="stylesheet" href="/longhcuanwenhua/PUblic/Home/css/style.css">
	<link rel="stylesheet" href="/longhcuanwenhua/PUblic/Home/js/swiper/css/swiper.min.css">
    <script src="/longhcuanwenhua/Public/Home/js/jquery.min.js?v=20160924"></script>
    <script  src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
    <script type="text/javascript" src="/longhcuanwenhua/Public/Home/js/layer/layer.js"></script>
</head>
<body>

	<header>
		<h1>申请会员</h1>
		<a href="" class="glyphicon glyphicon-chevron-left"></a>
	</header>

	<footer>
    <menu>
        <a href="" class="active">
            <span class="glyphicon glyphicon-home"></span>
            <small>首页</small>
        </a>
        <a href="">
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



	    <!-- form start -->
		<form action="<?php echo U('index/save_sub');?>" method="post">
			<fieldset>

				<h3>诊断信息</h3>

				<div class="row">
					<label for="">诊断</label>
					<div class="form-group">
						<input type="text" id="zd" name="zd" class="form-control" placeholder="请输入诊断结果">
					</div>
				</div>

				<div class="row">
					<label for="">诊断医师</label>
					<div class="form-group">
						<input type="text" id="zd_doctor" name="zd_doctor" class="form-control" placeholder="请输入诊断医师">
					</div>
				</div>
                <h3>病例图片</h3>
                <div class="img-list">

                    <ul class="clearfix">

                        <li class="img-add" id="bl_btn">
                            <i class="glyphicon glyphicon-plus" id="bl_img"></i>
                        </li>
                    </ul>
                    <input type="hidden" name="bl_img" id="bl_image">
                </div>

				<input type="submit" id="submit" value="提交">

			</fieldset>
		</form>
	    <!-- form end -->

	</section>

	<script src="/longhcuanwenhua/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>

	<script src="/longhcuanwenhua/Public/Home/js/citys/distpicker.data.js"></script>
	<script src="/longhcuanwenhua/Public/Home/js/citys/distpicker.js"></script>
    <script src="/longhcuanwenhua/Public/Home/js/sub_form.js"></script>

	<script>
		var swiper = new Swiper('.swiper-container', {
	        pagination: '.swiper-pagination',
	        paginationClickable: true
	        // 启用箭头
	        // nextButton: '.swiper-button-next',
	        // prevButton: '.swiper-button-prev'
	    });

		$(function(){

			// user-tab
			$('.user-tab menu button').on('touchend',function(){
				var	self =	$(this),
					nums =  self.index();

				self.addClass('active').siblings('button').removeClass('active');
				$('.user-item ul').eq(nums).show().siblings('ul').hide();
			})


            $(document).on('click', '.glyphicon-remove',function(){
                var id = $(this).attr('data-id');
                var id = '8goWbOLxoP9dpyHFfooVksKVtTocbBOB-M2ji0tA4oTJS5miLkmNz3FmVWnzpHZr';
                var img_str = $('#bl_image').val();
                var img_str = '8goWbOLxoP9dpyHFfooVksKVtTocbBOB-M2ji0tA4oTJS5miLkmNz3FmVWnzpHZr,QLXIQRqC0YuIq3sqwAkqoXHj8Z-s5IIsoz950uZPEK2vVFVx4bmXU0ZO4PwLliTQ';
                var img_arr = img_str.split(',');
                for(var v in img_arr){
                    if( img_arr[v] == id ){
                        img_arr.splice(v,1);
                    }
                }
                var new_img_str = img_arr.join(',');
                $('#bl_image').val(new_img_str);
                $(this).parent().remove();
            })
            $('#bl_img').click(function(){
                $('#bl_btn').before('<li> <img src="/longhcuanwenhua/uploads/BL/57e621088e216.jpg" alt=""> <span class="glyphicon glyphicon-remove" data-id="BRQ3Eip6wnpIwyyfgzPwSdKxgA8rSXWhADw82LUkgHLBO9hPy4d"></span> </li>');
            });

		})

	</script>
    <!-- 微信SDK -->
    <script>
        wx.config({
                appId: '<?php echo ($signPackage["appId"]); ?>', // 必填，公众号的唯一标识
                timestamp: <?php echo ($signPackage["timestamp"]); ?>, // 必填，生成签名的时间戳
            nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>', // 必填，生成签名的随机串
            signature: '<?php echo ($signPackage["signature"]); ?>',// 必填，签名，见附录1
            jsApiList: ['chooseImage','previewImage','uploadImage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function(){
            document.querySelector('#bl_img').onclick = function () {
                var images = {
                    localId: [],
                    serverId: []
                };
                function upload(i, length, serverId) {
                    wx.uploadImage({
                        localId: images.localId[i],
                        success: function (res) {
                            i++;
                            serverId.push(res.serverId);
                            if (i < length) {
                                upload(i, length, serverId);
                            }
                            if(i >= length){
                                layer.open({type: 2});
                                $.post("<?php echo U('Index/uploadImg');?>", {serverIds:'"'+serverId+'"'},function(data){
                                    if( data.status == 'y' ){
                                        var server_img = data.server.server_img;
                                        var server_str = '';
                                        $('#bl_image').val(data.server.server_id);
                                        for( var i =0;i < server_img.length;i++ ){
                                           $('#bl_btn').before('<li> <img src="/longhcuanwenhua'+server_img[i]['path']+'" alt=""> <span class="glyphicon glyphicon-remove" data-id="'+server_img[i]['id']+'"></span> </li>');
                                            layer.closeAll();
                                        }
                                    }else{
                                        alert(data.msg);
                                        layer.closeAll();
                                    }
                                },'json')
                            }
                        },
                        fail: function (res) {
                            alert(JSON.stringify(res));
                        }
                    });
                }
                wx.chooseImage({
                    count: 9,
                    success: function (res) {
                        images.localId = res.localIds;
                        var i = 0, length = images.localId.length;
                        serverId = [];
                        setTimeout(function(){
                            upload(i, length, serverId)
                        },100)
                    }
                });
            };
            /*
            document.querySelector('.item').onclick = function () {
                wx.previewImage({
                    urls: [
                    <?php if(is_array($photo)): $i = 0; $__LIST__ = $photo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>'http://'+window.location.host+'<?php echo ($vo["path"]); ?>',<?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            });
            };
           */
        });
    </script>
</body>
</html>