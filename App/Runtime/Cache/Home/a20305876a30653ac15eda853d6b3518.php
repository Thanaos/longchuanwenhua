<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="stylesheet" type="text/css" href="./login.php_files/style1.3.8.1.3.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="http://exc.vjifen118.com/css/login/appReset.css">
<link rel="stylesheet" href="http://exc.vjifen118.com/css/login/master.css">
<link rel="stylesheet" href="http://exc.vjifen118.com/css/hy/dialog.css">
<title>绑定手机号</title>
</head>
<body>
<div class="home-header">
<div class="homo-tel bor-bom tel-icon">
<input type="tel" name="" id="input_phone" placeholder="请输入手机号">
</div>

</div>

<div class="home-btn"><a href="javascript:;" id="a_login" class="activeBtn">绑定手机</a></div>

<input type="hidden" name="fvid" id="fvid" value="">
<input type="hidden" name="ftype" id="ftype" value="">
<input type="hidden" name="form_submit" id="form_submit" value="true">
<input type="hidden" name="formhash" id="formhash" value="beed8e1b">

<script type="text/javascript" src="/Public/Home/js/jQuery.js"></script>
<script type="text/javascript" src="/Public/Home/js/dialog_min.js"></script>
<script type="text/javascript" src="/Public/Home/js/amap.js"></script>
<script type="text/javascript" src="/Public/Home/js/main.js"></script>
<script type="text/javascript" src="/Public/Home/js/alert.js"></script>
<script>
$(function(){
    $('#a_login').click(function(){
        var telephone = $.trim($("#input_phone").val());
        if(!/^\d{11}$/.test(telephone)){
            alertNew("请输入正确的手机号", 1500);
            return;
        }
        $.post('#',{mobile:telephone},function(data){
            if(data.status == 'y'){
                window.location.href="/index.php/Home/index/index.html";
            }else{
                alertNew(data.msg, 1550);
            } 
        },'json')
    })
})
</script>
</body></html>