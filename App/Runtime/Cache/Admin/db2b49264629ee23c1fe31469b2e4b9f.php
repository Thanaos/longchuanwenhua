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
    <form action="/index.php/admin/member/save.html" id="registerform">
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">会员姓名<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["name"]); ?>" name="name" class="inputxt" datatype="*" nullmsg="请输入会员姓名！" errormsg="请输入会员姓名！"  /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">会员编号<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["number"]); ?>" name="number" class="inputxt" datatype="*" nullmsg="请输入会员编号！" errormsg="请输入会员编号！" /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">结课时间</td>
            <td><input type="text" value="<?php echo ($data["endtime"]); ?>" name="endtime" id="endtime" class="inputxt" readonly  /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">剩余课时</td>
            <td><input type="text" value="<?php echo ($data["sy_num"]); ?>" name="sy_num" class="inputxt"/></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">上级会员</td>
            <td><a href="/index.php/admin/member/tree/<?php echo ($parent_2["id"]); ?>.html"><?php echo ($parent_2["name"]); ?></a></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">上二级会员</td>
            <td><a href="/index.php/admin/member/tree/<?php echo ($parent_3["id"]); ?>.html"><?php echo ($parent_3["name"]); ?></a></td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button id="btn" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script type="text/javascript" src="/Public/Admin/js/Validform_v5.3.2/Validform_v5.3.2_min.js"></script>
<script>
    $(function () {  
        $("#endtime").datepicker({changeMonth: true,changeYear: true,yearRange:"1970:2030"},{dateFormat:'yy-mm-dd'});
        $('#backid').click(function(){
            history.back(-1);
        })
    $.Tipmsg.r='';
	$("#registerform").Validform({
	    tiptype:3,
        ajaxPost:true,
        btnSubmit:"#btn",
        callback:function(data){
            $.Hidemsg();
            if(data.status == 'y'){
                alert(data.msg);
                    <?php if(!empty($data)): ?>document.location.reload(); 
                    <?php else: ?>
                        window.location.href="/index.php/admin/member/edit/"+data.id+".html";<?php endif; ?>
            }else{
                alert(data.msg);
            }
        return false;
        },
	});

    });
</script>