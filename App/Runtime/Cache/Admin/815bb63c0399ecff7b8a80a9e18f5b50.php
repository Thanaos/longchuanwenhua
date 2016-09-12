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
    <form action="/index.php/admin/config/save.html" id="registerform">
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">积分标准<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["point"]); ?>" name="point" class="inputxt" datatype="*" nullmsg="请输入积分标准！" errormsg="请输入积分标准！"  /></td>
        <tr><th colspan="2" style="text-align:center">月卡用户</th></tr>
        <tr>
            <td width="10%" class="tableleft">一级分成<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["point_1"]); ?>" name="point_1" class="inputxt" datatype="*" nullmsg="请输入一级会员积分分成！" errormsg="请输入一级会员积分分成！"  /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">二级分成<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["point_2"]); ?>" name="point_2" class="inputxt" datatype="*" nullmsg="请输入二级会员积分分成！" errormsg="请输入二级会员积分分成！"  /></td>
        </tr>
        <tr><th colspan="2" style="text-align:center">年卡用户</th></tr>
        <tr>
            <td width="10%" class="tableleft">一级分成<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["point_4"]); ?>" name="point_4" class="inputxt" datatype="*" nullmsg="请输入一级会员积分分成！" errormsg="请输入一级会员积分分成！"  /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">二级分成<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["point_5"]); ?>" name="point_5" class="inputxt" datatype="*" nullmsg="请输入二级会员积分分成！" errormsg="请输入二级会员积分分成！"  /></td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button id="btn" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;
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
            if(data.status == 'y'){
                $.Hidemsg();
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