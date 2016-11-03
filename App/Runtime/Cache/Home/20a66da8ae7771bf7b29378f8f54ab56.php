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
	<h1>会员信息</h1>
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
	<!-- <div class="user-info clearfix">
         <div class="photo">
             <img src="/Public/Home/img/cdl.jpg" alt="">
         </div>
         <div class="detail">
             <span>账号：530000063851</span>
             <span><a href="" class="block text-right" style="padding-right: 15px">修改密码</a></span>
         </div>
     </div>
-->
	<!-- form start -->
	<form action="<?php echo U('member/ajax_register');?>" method="post" id="register">
		<fieldset>

			<h3 style="font-size:1rem">申请人信息</h3>

			<div class="row">
				<label for="">姓　　名</label>
				<div class="form-group">
					<!--<input type="text" name="name" class="form-control" id="name" placeholder="请输入姓名">-->
                    <span class="form-control-span"><?php echo ($user["name"]); ?></span>
				</div>
			</div>

			<div class="row">
				<label for="">性　　别</label>
				<div class="form-group">
					<!--<label for=""><input type="radio" class="radio" name="sex" value="1" checked>男</label>-->
					<!--<label for=""><input type="radio" class="radio" name="sex" value="0">女</label>-->
                    <span class="form-control-span"><?php if($user["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></span>
				</div>
			</div>

			<div class="row">
				<label for="">年　　龄</label>
				<div class="form-group">
					<!--<input type="tel" name="age" id="age" class="form-control"  placeholder="请输入年龄">-->
                    <span class="form-control-span"><?php echo ($user["age"]); ?></span>
				</div>
			</div>

			<div class="row">
				<label for="">身份证号</label>
				<div class="form-group">
					<!--<input type="text" class="form-control" name="idCard" id="idCard" placeholder="请输入身份证号">-->
					<span class="form-control-span"><?php echo ($user["idcard"]); ?></span>
				</div>
			</div>

			<div class="row">
				<label for="">手机号码</label>
				<div class="form-group">
					<input type="tel" class="form-control" name="mobile" id="mobile" value="<?php echo ($user["mobile"]); ?>" placeholder="请输入电话">
				</div>
			</div>

			<div class="row">
				<label for="">微 信 号</label>
				<div class="form-group">
					<input type="text" class="form-control" name="wxid" id="wxid" value="<?php echo ($user["wxid"]); ?>" placeholder="请输入微信号">
				</div>
			</div>

			<div class="row">
				<label for="">生　　日</label>
				<div class="form-group">
					<!--<input type="text" class="form-control" id="birthday" name="birthday" placeholder="请输入出生日期">-->
					<span class="form-control-span"><?php echo (date($user["birthday"],'Y-m-d')); ?></span>
				</div>
			</div>


			<div class="row">
				<label for="">邮　　箱</label>
				<div class="form-group">
					<input type="text" class="form-control" name="email" id="email" value="<?php echo ($user["email"]); ?>" placeholder="请输入邮箱">
				</div>
			</div>


			<div id="address1">
				<label for="" style="position: absolute; font-size: 0.6rem; width: 5em; line-height: 1.4rem;">住　　址</label>
				<div class="row">
					<div class="form-group">
						<!--<select name="d_s" data-province="" class="form-control" id=""></select>-->
						<span class="form-control-span"><?php echo ($user["domicile"]); ?></span>
					</div>
				</div>

			</div>


			<h3 style="font-size:1rem">申请人病史</h3>


			<div class="row">
				<label for="">临床诊断</label>
				<div class="form-group">
					<select name="diagnose" id="" class="form-control">
						<option>请选择</option>
						<?php if(is_array($sickid)): $i = 0; $__LIST__ = $sickid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i); ?>" <?php if($user['diagnose'] == $i): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>
			<div class="row">
				<label for="">患病时间</label>
				<div class="form-group">
					<select name="illness_time" id="" class="form-control">
						<option>请选择</option>
						<option value="1" <?php if($user['illness_time'] == 1): ?>selected<?php endif; ?>>1年</option>
						<option value="2" <?php if($user['illness_time'] == 2): ?>selected<?php endif; ?>>2年</option>
						<option value="3" <?php if($user['illness_time'] == 3): ?>selected<?php endif; ?>>3年</option>
						<option value="4" <?php if($user['illness_time'] == 4): ?>selected<?php endif; ?>>4年</option>
						<option value="5" <?php if($user['illness_time'] == 5): ?>selected<?php endif; ?>>5年</option>
						<option value="6" <?php if($user['illness_time'] == 6): ?>selected<?php endif; ?>>5年以上</option>
					</select>
				</div>
			</div>
			<div class="row">
				<label for="">既往病史</label>
				<div class="form-group">
					<input type="text" class="form-control" name="illness_history" value="<?php echo ($user["illness_history"]); ?>" placeholder="请输入既往病史">
				</div>
			</div>

			<div class="row">
				<label for="">过敏史</label>
				<div class="form-group">
					<input type="text" class="form-control" name="gm_history" value="<?php echo ($user["gm_history"]); ?>" placeholder="请输入过敏史">
				</div>
			</div>

			<div class="row">
				<label for="">家族病史</label>
				<div class="form-group">
					<input type="text" class="form-control" name="jz_history" value="<?php echo ($user["jz_history"]); ?>" placeholder="请输入家族病史">
				</div>
			</div>

			<div class="row">
				<label for="">个人简历</label>
				<div class="form-group">
					<input name="description" class="form-control" type="text" value="<?php echo ($user["description"]); ?>" placeholder="如：禁止吸烟喝酒" />
				</div>
			</div>
			<div id="address2">
				<div class="row">
					<label for="" style="position: absolute; font-size: 0.6rem; width: 5em; line-height: 1.4rem;">长期居住地</label>
					<div class="form-group">
                        <span class="form-control-span"><?php echo ($user["cq_domicile"]); ?></span>
					</div>
				</div>
			</div>


			<h3 style="font-size:1rem">受托人信息</h3>

			<div class="row">
				<label for="">申请人关系</label>
				<div class="form-group">
					<input type="text" class="form-control" name="relation" id="relation" value="<?php echo ($user["relation"]); ?>" placeholder="请输入受托人关系">
                    <!--<span class="form-control-span"><?php echo ($user["relation"]); ?></span>-->
				</div>
			</div>


			<div class="row">
				<label for="">姓　　名</label>
				<div class="form-group">
					<input type="text" class="form-control" name="bailor" id="bailor" value="<?php echo ($user["bailor"]); ?>" placeholder="请输入受托人姓名">
					<!--<span class="form-control-span"><?php echo ($user["bailor"]); ?></span>-->
				</div>
			</div>



			<div class="row">
				<label for="">电　　话</label>
				<div class="form-group">
					<input type="tel" class="form-control" name="bailor_mobile" id="bailor_mobile" value="<?php echo ($user["bailor_mobile"]); ?>" placeholder="请输入受托人电话">
				</div>
			</div>

			<div class="row">
				<label for="">微 信 号</label>
				<div class="form-group">
					<input type="text" class="form-control" name="s_wxid" id="s_wxid" value="<?php echo ($user["s_wxid"]); ?>" placeholder="请输入受托人微信号">
				</div>
			</div>

			<div class="row">
				<label for="">邮　　箱</label>
				<div class="form-group">
					<input type="text" class="form-control" name="bailor_email" id="bailor_email" value="<?php echo ($user["bailor_email"]); ?>" placeholder="请输入受托人邮箱">
				</div>
			</div>


			<div class="row">
				<label for="">身份证号</label>
				<div class="form-group">
					<input type="text" class="form-control" name="bailor_idcard" id="bailor_idcard" value="<?php echo ($user["bailor_idcard"]); ?>" placeholder="请输入受托人身份证">
				</div>
			</div>


			<div id="address2">
				<div class="row">
					<label for="">住　　址</label>
					<div class="form-group">
						<!--<select name="s_s" class="form-control" id=""></select>-->
						<span class="form-control-span"><?php echo ($user["s_domicile"]); ?></span>
					</div>
				</div>
			</div>



			<!--<input type="submit" id="submit" value="提交">-->
		</fieldset>
	</form>
	<!-- form end -->

</section>

<script src="/Public/Home/js/jquery.min.js"></script>
<script src="/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
<script src="/Public/Home/js/form.js"></script>
<script src="/Public/Home/js/citys/distpicker.data.js"></script>
<script src="/Public/Home/js/citys/distpicker.js"></script>
<script  src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script type="text/javascript" src="/Public/Home/js/layer/layer.js"></script>
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
		$("#address2 , #address1").distpicker({
			autoSelect: false,
			province: "请选择省",
			city: "请选择市",
			district: "请选择区"
		});
		$('#birthday').focus(function(){
			$(this).attr('type', 'date');
			$(this).focus();
		});
		$('#birthday').blur(function (){
			$(this).attr('type', 'text');
		});
		// user-tab
		$('.user-tab menu button').on('touchend',function(){
			var	self =	$(this),
				nums =  self.index();

			self.addClass('active').siblings('button').removeClass('active');
			$('.user-item ul').eq(nums).show().siblings('ul').hide();
		})


	})

	$('.page').on('click','.img-list .glyphicon-remove',function(){
		var id = $(this).attr('data-id');
		var img_str = $('#bl_image').val();
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


</script>
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
							$.post("<?php echo U('member/uploadImg');?>", {serverIds:'"'+serverId+'"'},function(data){
								if( data.status == 'y' ){
									var server_img = data.server.server_img;
									var server_str = '';
									$('#bl_image').val(data.server.server_id);
									for( var i =0;i < server_img.length;i++ ){
										$('#bl_btn').before('<li> <img src="'+server_img[i]['path']+'" alt=""> <span class="glyphicon glyphicon-remove" data-id="'+server_img[i]['id']+'"></span> </li>');
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