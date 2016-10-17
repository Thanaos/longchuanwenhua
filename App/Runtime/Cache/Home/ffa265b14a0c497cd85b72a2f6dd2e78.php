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
		<h1>申请会员</h1>
		<a href="" class="glyphicon glyphicon-chevron-left"></a>
	</header>

	<footer>
		<menu>
			<a href="">
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
	   <!-- <div class="user-info clearfix">
	    	<div class="photo">
	    		<img src="/longhcuanwenhua/Public/Home/img/cdl.jpg" alt="">
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

				<h3>患者信息</h3>

				<div class="row">
					<label for="">姓名</label>
					<div class="form-group">
						<input type="text" name="name" class="form-control" id="name" placeholder="请输入姓名">
					</div>
				</div>

				<div class="row">
					<label for="">性别</label>
					<div class="form-group">
						<label for=""><input type="radio" class="radio" name="sex" value="1" checked>男</label>
						<label for=""><input type="radio" class="radio" name="sex" value="0">女</label>
					</div>
				</div>

				<div class="row">
					<label for="">年龄</label>
					<div class="form-group">
						<input type="text" name="age" id="age" class="form-control"  placeholder="请输入年龄">
					</div>
				</div>

				<div class="row">
					<label for="">身份证号</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="idCard" id="idCard" placeholder="请输入身份证号">
					</div>
				</div>

				<div class="row">
					<label for="">生日</label>
					<div class="form-group">
						<input type="text" class="form-control" id="birthday" name="birthday" placeholder="请输入出生日期">
					</div>
				</div>

				<div class="row">
					<label for="">电话</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="mobile" id="mobile" placeholder="请输入电话">
					</div>
				</div>

				<div class="row">
					<label for="">邮箱</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="email" id="email" placeholder="请输入邮箱">
					</div>
				</div>

				<div class="row">
					<label for="">委托人</label>
					<div class="form-group">
						<input type="text" class="form-control" name="bailor" id="bailor" placeholder="请输入委托人姓名">
					</div>
				</div>

				<div class="row">
					<label for="">委托人身份证</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="bailor_idcard" id="bailor_idcard" placeholder="请输入委托人身份证">
					</div>
				</div>

				<div class="row">
					<label for="">与本人关系</label>
					<div class="form-group">
						<input type="text" class="form-control" name="relation" id="relation" placeholder="请输入委托人关系">
					</div>
				</div>



				<div class="row">
					<label for="">委托人电话</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="bailor_mobile" id="bailor_mobile" placeholder="请输入委托人电话">
					</div>
				</div>


				<div class="row">
					<label for="">委托人邮箱</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="bailor_email" id="bailor_email" placeholder="请输入委托人邮箱">
					</div>
				</div>

				<div class="row">
					<label for="">委托人</label>
					<div class="form-group">
						<input type="tel" class="form-control" name="bailor_email" id="bailor_email" placeholder="请输入委托人电话">
					</div>
				</div>



				<br>
				<h3>居住地</h3>
                <div id="address1">
                    <div class="row">
                        <div class="form-group">
                            <select name="d_s" data-province="" class="form-control" id=""></select>
                        </div>
                    </div>

                    <div class="row">
                        <label for=""></label>
                        <div class="form-group">
                            <select name="d_c" data-city="" class="form-control" id=""></select>
                        </div>
                    </div>

                    <div class="row">
                        <label for=""></label>
                        <div class="form-group">
                            <select name="d_d" data-district="" class="form-control" id=""></select>
                        </div>
                    </div>
                </div>


				<br>
				<h3>住址</h3>
                <div id="address2">
                    <div class="row">
                        <div class="form-group">
                            <select name="c_s" class="form-control" id=""></select>
                        </div>
                    </div>

                    <div class="row">
                        <label for=""></label>
                        <div class="form-group">
                            <select name="c_c" class="form-control" id=""></select>
                        </div>
                    </div>

                    <div class="row">
                        <label for=""></label>
                        <div class="form-group">
                            <select name="c_d" class="form-control" id=""></select>
                        </div>
                    </div>
				</div>

				<div class="row">
					<label for="">街道</label>
					<div class="form-group">
						<input type="text" class="form-control" name="address" placeholder="请输入街道">
					</div>
				</div>

				<br>
				<h3>病史</h3>

                <div class="row">
                    <label for="">临床诊断</label>
                    <div class="form-group">
                        <select name="diagnose" id="" class="form-control">
                            <option>请选择</option>
                            <?php if(is_array($sickid)): $i = 0; $__LIST__ = $sickid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
				<div class="row">
					<label for="">患病时间</label>
					<div class="form-group">
                        <select name="illness_time" id="" class="form-control">
                            <option>请选择</option>
                            <option value="1">1年</option>
                            <option value="2">2年</option>
                            <option value="3">3年</option>
                            <option value="4">4年</option>
                            <option value="5">5年</option>
                            <option value="6">5年以上</option>
                        </select>
					</div>
				</div>
				<div class="row">
					<label for="">既往病史</label>
					<div class="form-group">
						<input type="text" class="form-control" name="illness_history" placeholder="请输入既往病史">
					</div>
				</div>

				<div class="row">
					<label for="">过敏史</label>
					<div class="form-group">
						<input type="text" class="form-control" name="gm_history" placeholder="请输入过敏史">
					</div>
				</div>

				<div class="row">
					<label for="">家族病史</label>
					<div class="form-group">
						<input type="text" class="form-control" name="jz_history" placeholder="请输入家族病史">
					</div>
				</div>

				<div class="row">
					<label for="">个人简历</label>
					<div class="form-group">
						<textarea name="description" placeholder="如：禁止吸烟喝酒"></textarea>
					</div>
				</div>

				<h3>病史诊断</h3>
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
	
	<script src="/longhcuanwenhua/Public/Home/js/jquery.min.js"></script>
	<script src="/longhcuanwenhua/Public/Home/js/swiper/js/swiper.jquery.min.js"></script>
    <script src="/longhcuanwenhua/Public/Home/js/form.js"></script>
    <script src="/longhcuanwenhua/Public/Home/js/citys/distpicker.data.js"></script>
    <script src="/longhcuanwenhua/Public/Home/js/citys/distpicker.js"></script>
	<script  src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
	<script type="text/javascript" src="/longhcuanwenhua/Public/Home/js/layer/layer.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
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