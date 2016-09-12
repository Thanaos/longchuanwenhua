<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>

 

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

    </style>
<style>
.tcdPageCode{padding: 15px 20px;text-align: left;color: #ccc;text-align:center;}
.tcdPageCode a{display: inline-block;color: #428bca;display: inline-block;height: 25px;	line-height: 25px;	padding: 0 10px;border: 1px solid #ddd;	margin: 0 2px;border-radius: 4px;vertical-align: middle;}
.tcdPageCode a:hover{text-decoration: none;border: 1px solid #428bca;}
.tcdPageCode span.current{display: inline-block;height: 25px;line-height: 25px;padding: 0 10px;margin: 0 2px;color: #fff;background-color: #428bca;	border: 1px solid #428bca;border-radius: 4px;vertical-align: middle;}
.tcdPageCode span.disabled{	display: inline-block;height: 25px;line-height: 25px;padding: 0 10px;margin: 0 2px;	color: #bfbfbf;background: #f2f2f2;border: 1px solid #bfbfbf;border-radius: 4px;vertical-align: middle;}
</style>
</head>
<body>
    <div class="form-inline definewidth m20" action="index.html" method="get">
</div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <?php if(empty($list)): ?><tr>
        <th style="text-align:center">
            管理员太懒了！什么都没有留下！
        </th>
    </tr>
    <?php else: ?>
    <tr>
        <th>会员姓名</th>
        <th>会员编号</th>
        <th>监护人姓名</th>
        <th>监护人联系方式</th>
        <th>操作</th>
    </tr><?php endif; ?>
    </thead>
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr id="icon_0_<?php echo ($vo["id"]); ?>" class="0">
             <td><img src="/Public/Admin/image/menu_plus.gif" id="0_<?php echo ($vo["id"]); ?>" onclick="show(this)"  data="plus" width="9" height="9" border="0" style="margin-left:0em"><?php echo ($vo["name"]); ?></td>
             <td><?php echo ($vo["number"]); ?></td>
             <td><?php echo ($vo["jhr_name"]); ?></td>
             <td><?php echo ($vo["jhr_tel"]); ?></td>
             <td style="width:120px;">
                <a href="/index.php/admin/member/edit/<?php echo ($vo["id"]); ?>.html">编辑</a>                             
                <a href="javascript:;" onclick="del(<?php echo ($vo["id"]); ?>)">删除</a>                             
            </td>
        </tr><?php endforeach; endif; ?>
</table>
</body>
</html>
<script>
        function show(obj){
            var str = $(obj).attr('id');
            var arr = str.split('_');
            var data = $(obj).attr('data');
            var parent = $('#icon_'+str).attr('class');
            if(parent != 0){
                var parentstr = parent+' '+arr[1];
            }else{
                var parentstr = arr[1];
            }
            if(data == 'plus'){
                $.post('/index.php/admin/member/ajaxlist.html',{id:arr[1]},function(data){
                    if(!data.status){
                        var list = '';
                        var deep = parseInt(arr[0])+1;
                        var deepstr = '';
                        for (var i=0;i<=deep;i++)
                        {
                                deepstr += '&nbsp;&nbsp;&nbsp;';
                        }
                        for(var o in data){
                            list += '<tr id="icon_'+deep+'_'+data[o].id+'" class="'+parentstr+'"><td>'+deepstr+'<img src="/Public/Admin/image/menu_plus.gif" id="'+deep+'_'+data[o].id+'" onclick="show(this)" data="plus" width="9" height="9" border="0" style="margin-left:0em">'+data[o].name+'</td><td>'+data[o].number+'</td><td>'+data[o].jhr_name+'</td><td>'+data[o].jhr_tel+'</td><td style="width:120px;"><a href="/index.php/admin/member/edit/'+data[o].id+'.html">编辑</a><a href="javascript:;" onclick="del('+data[o].id+')">删除</a></td></tr>';
                        }
                        $('#icon_'+str).after(list);
                    }
                },'json')
                $('#'+str).attr('src','/Public/Admin/image/menu_minus.gif');
                $('#'+str).attr('data','minus');
            }else{
                $('.'+arr[1]).remove();
                $('#'+str).attr('src','/Public/Admin/image/menu_plus.gif');
                $('#'+str).attr('data','plus');
                
            }
        }
        function del(id){
                var r=confirm("确定要删除该数据？");
                var newsId = $(this).attr("name");
                if (r==true)
                {
                    $.post("/index.php/admin/Member/del.html",{id:id},function(data){
                        if(data.status == 'y'){
                            alert(data.msg);
                            document.location.reload(); 
                        }else{
                            alert(data.msg);
                        }
                    },'json');
                }
        }
</script>