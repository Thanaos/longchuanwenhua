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
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/jquery-ui.css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery-ui-slide.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery-ui-timepicker-addon.js"></script>
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
    <link rel="stylesheet" href="/Public/Admin/kindeditor-4.1.10/themes/default/default.css" />
    <script charset="utf-8" src="/Public/Admin/kindeditor-4.1.10/kindeditor-all.js"></script>
    <script charset="utf-8" src="/Public/Admin/kindeditor-4.1.10/lang/zh_CN.js"></script>
    <script>
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                width:'700px',
                height:'400px',
                cssPath : '/Public/Admin/kindeditor-4.1.10/plugins/code/prettify.css',
                uploadJson : '/index.php?s=/admin/index/uploadImg.html',
                fileManagerJson : '/index.php?s=/admin/index/uploadManager.html',
                allowFileManager : true
            });
        });
    </script>
</head>
<body>
<form action="/index.php?s=/admin/user/save.html" id="registerform">
    <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
    <table class="table table-bordered table-hover definewidth m30" >
        <tr>
            <td width="10%" class="tableleft">用户组<span class="red">*</span></td>
            <td>
                <select name="group">
                    <?php if(is_array($user_group)): $i = 0; $__LIST__ = $user_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $data['group_id']): ?>selected<?php endif; ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        <tr>
            <td width="10%" class="tableleft">用户名<span class="red">*</span></td>
            <td><input type="text" value="<?php echo ($data["name"]); ?>" name="name" class="inputxt" datatype="*" nullmsg="请输入用户名" errormsg="请输入用户名" placeholder="请输入用户名" /></td>
        </tr>
        <if>
            <td width="10%" class="tableleft">登录密码<span class="red">*</span></td>
            <?php if($data["id"] > 0): ?><td><input type="password" value="" name="pwd" class="inputxt" placeholder="请输入登录密码" /><span style="color:#c0c0c0">（不更改密码，无需填写）</span></td>
            <?php else: ?>
                <td><input type="password" value="" name="pwd" class="inputxt"datatype="*" nullmsg="请输入登录密码！" errormsg="请输入登录密码！" placeholder="请输入登录密码" /></td><?php endif; ?>
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

        $.Tipmsg.r='';
        $("#registerform").Validform({
            tiptype:3,
            ajaxPost:true,
            btnSubmit:"#btn",
            callback:function(data){
                if(data.status == 'y'){
                    $.Hidemsg();
                    alert(data.msg);
                    window.location.href="/index.php?s=/admin/user/list.html";
                }else{
                    alert(data.msg);
                }
                return false;
            },
        });

        $('#backid').click(function(){
            history.back(-1);
        })

    });
</script>