<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<title>认证手机号</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection"content="telephone=no, email=no" />
    <link rel="stylesheet" href="/Public/Home/css/neat.css">
    <link rel="stylesheet" href="/Public/Home/css/common.css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/layer/layer.js"></script>
</head>
<body>
	
	<!--phone begin-->

	<section class="register">

		<section class="signin">
			

        <form action="#" id="registerform">
			<div class="signin-group flex">
				<span class="signin-phone"></span>
				<input class="flex-item" type="text" name="mobile" datatype="m" nullmsg="请输入手机号" error="请输入正确的手机号" placeholder="请输入您的手机号" autofocus>
			</div>

			<small>已阅读和同意珍爱网的<a href="">服务条款</a>和<a href="">隐私政策</a></small>
		
			<input type="submit" value="下一步">
            </form>
		</section>
		
	</section>
		
	<!--phone end-->
<script type="text/javascript" src="/Public/Admin/js/Validform_v5.3.2/Validform_v5.3.2_min.js"></script>
<script>
$(function () {  

	$.Tipmsg.r=null;
    var showmsg=function(msg){
        layer.open({
            content: msg,
            time: 1
        });
	}
	$("#registerform").Validform({
		tiptype:function(msg){
			showmsg(msg);
		},
        ajaxPost:true,
        tipSweep:true,
        btnSubmit:"#btn",
        callback:function(data){
            if(data.status == 'y'){
                showmsg(data.msg);
                window.location.reload();
            }else{
                showmsg(data.msg);
            }
        return false;
        },
	});

});
</script>
</body>
</html>