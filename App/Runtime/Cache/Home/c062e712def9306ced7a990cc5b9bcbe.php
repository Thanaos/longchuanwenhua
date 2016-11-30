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
	<style>
		fieldset input[type="submit"] {
			display: inline;
		}
	</style>
</head>
<body>
	
	<header>
		<h1>会员卡协议</h1>
		<a href="" class="glyphicon glyphicon-chevron-left"></a>
	</header>

	<section class="page">

		<article><?php echo ($data["content"]); ?></article>

		<fieldset>
			<form action="<?php echo U('index/s_check');?>" method="post">
				<input type="submit" name="no" style="border-radius: 4px; background-color: #c3c3c3; width: 5rem; height: 1.5rem; border-width: 0;margin-left:1.5rem" value="不同意">
				<input type="submit" name="yes" style="border-radius: 4px; background-color: #31619d; width: 5rem; height: 1.5rem; border-width: 0;margin-left:1.5rem" value="同意">
			</form>
		</fieldset>

	</section>
	
	<script src="/Public/Home/js/jquery.min.js"></script>

</body>
</html>