<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>会员管理后台登陆</title>
		<meta name="weishangbao" content="ASUS" />
		<link rel="stylesheet" type="text/css" href="/zzyl/Public/Admin/css/common.css">
        <link rel="stylesheet" type="text/css" href="/zzyl/Public/Admin/css/zhucedenglu.css">
        <script type="text/javascript" src="/zzyl/Public/Admin/js/jquery.js"></script>
        <script>
            $(function(){
                $('#verify').click(function(){
                    $('#img').attr('src','/zzyl/index.php/admin/user/verify.html');
                })
                $('#but').click(function(){
                    var name = $('input[name="name"]').val();
                    var pwd  = $('input[name="pwd"]').val();
                    if(!name || !pwd){
                        alert('用户名或密码不能为空');
                        return false;
                    }
                    $('form').submit();
                })
            })
        </script>
		<!-- Date: 2015-03-19 -->
	</head>
	<body class="login">
		<div class="ce-contain" style="background:#42417E;">
			<div class="conter">
				<div class="conter-head clear">
				</div> 
				<div class="login-one" style="background-color:rgba(82,81,157,0.8);border:1px solid #8281c7; height:400px;">
                    <form method="post" action="/zzyl/index.php/admin/user/login.html">
					<table>
						<tr>
							<td  class="one">登录</td>
							<td>
							<input type="text" name="name" style="font-size: 12px;">
							</td>
						</tr>
						<tr>
							<td class="one">密码</td>
							<td>
							<input type="password" name="pwd" style="font-size: 12px;"/>
							</td>
						</tr>
						<tr>
						<tr>
							<td class="one">验证码</td>
							<td style="height:30px;line-height:30px;">
							<input type="text" name="code"  style="width:90px;font-size: 12px;height:30px;">
							<img src="/zzyl/index.php/admin/user/verify.html" id="img" style="width:88px;height:29px;vertical-align: middle"\><span style="font-size: 12px;color:white;margin-left:18px;cursor:pointer" id="verify">换一张</span></td>
							<td></td>
						</tr>
					</table>
					<div class="button" style="margin-top:30px;">
						<input type="button" id="but" value=" 立即登录">
					</div>
                    </form>
				</div>
			</div>
		</div>
	</body>
</html>