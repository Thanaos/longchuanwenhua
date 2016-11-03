<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
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
    <script type="text/javascript" src="/Public/Admin/js/jquery.form.js"></script>
 

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
.demo p{line-height:32px}
.image_btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
.image_btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
.progress { position:relative; margin-left:100px; margin-top:-24px; width:200px;padding: 1px; border-radius:3px; display:none}
.bar {background-color: green; display:block; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; height:20px; display:inline-block; top:3px; left:2%; color:#fff }
.files{height:30px; line-height:22px; margin:10px 0}
.delimg{margin-left:20px; color:#090; cursor:pointer}

    </style>
</head>
<body>
    <form action="/index.php?s=/admin/package/save.html" id="registerform">
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">种类名称<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["package_name"]); ?>" name="package_name" class="inputxt" datatype="*" nullmsg="请输入种类名称！" errormsg="请输入种类名称！" style="width:500px;" /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">20-29岁年费<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["package_price1"]); ?>" name="package_price1" class="inputxt" datatype="*" nullmsg="请输入价格！" errormsg="请输入价格！" style="width:500px;" /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">30-39岁年费<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["package_price2"]); ?>" name="package_price2" class="inputxt" datatype="*" nullmsg="请输入价格！" errormsg="请输入价格！" style="width:500px;" /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">40-49岁年费<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["package_price3"]); ?>" name="package_price3" class="inputxt" datatype="*" nullmsg="请输入价格！" errormsg="请输入价格！" style="width:500px;" /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">50-59岁年费<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["package_price4"]); ?>" name="package_price4" class="inputxt" datatype="*" nullmsg="请输入价格！" errormsg="请输入价格！" style="width:500px;" /></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">60岁就以上年费<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["package_price5"]); ?>" name="package_price5" class="inputxt" datatype="*" nullmsg="请输入价格！" errormsg="请输入价格！" style="width:500px;" /></td>
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
<script type="text/javascript">
$(function () {
	$(".delimg").click(function(){
        var pic = $(this).attr("rel");
        alert(pic);
		$.post("/index.php?s=/admin/index/uploadFile/act/delimg.html",{imagename:pic},function(msg){
			if(msg==1){
                alert('删除成功');
				showimg.empty();
				progress.hide();
                files.hide();
			}else{
				alert(msg);
			}
		},'json');
	});
    $('#backid').click(function(){
        window.location.href="/index.php?s=/admin/package/list.html";
    })
});
</script>
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
                    <?php if(!empty($data)): ?>window.location.href="/index.php?s=/admin/package/list.html";
                    <?php else: ?>
                        window.location.href="/index.php?s=/admin/package/edit/"+data.id+".html";<?php endif; ?>
            }else{
                alert(data.msg);
            }
        return false;
        }
	});

});
</script>