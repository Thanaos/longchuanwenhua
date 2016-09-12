<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>    
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/Validform_v5.3.2.css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/jquery-ui.css" /> 
    <script type="text/javascript" src="/Public/Admin/js/jquery-ui.js"></script> 
    <script type="text/javascript" src="/Public/Admin/js/jquery-ui-slide.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery-ui-timepicker-addon.js"></script> 
 

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
        .red{color:red;font-size:18px;margin-left:2px;}
    </style>
</head>
<body>
    <form action="/index.php/admin/option/save.html" id="registerform">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">订单最大数</td>
            <td><input type="text" value="<?php echo ($config["config_val"]); ?>" name="max_order" class="inputxt" datatype="n" nullmsg="请输入一个数字！" errormsg="请输入一个有效的数字！"  /></td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button id="btn" class="btn btn-primary" type="button">保存</button> 
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script type="text/javascript" src="/Public/Admin/js/Validform_v5.3.2/Validform_v5.3.2_min.js"></script>
<script>
$(function () {  
    $.Tipmsg.r='';
	$("#registerform").Validform({
	    tiptype:3,
        ajaxPost:true,
        btnSubmit:"#btn",
        callback:function(data){
            $.Hidemsg();
            if(data.status == 'y'){
                alert(data.msg);
                document.location.reload(); 
            }else{
                alert(data.msg);
            }
        return false;
        },
	});

});
</script>