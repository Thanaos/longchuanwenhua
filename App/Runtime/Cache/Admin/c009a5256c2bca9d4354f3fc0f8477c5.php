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
    <script src="/Public/Admin/js/jquery.page.js"></script>

 

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
.btn a{text-decoration:none;color:#fff;}
</style>
</head>
<body>
<form class="form-inline definewidth m20" action="/index.php?s=/admin/package/save_type/<?php echo ($id); ?>.html" method="post">
    补贴项目：
    <input type="text" name="type_name" class="abc input-default" placeholder="请输入补贴项目" value="<?php echo ($where["name"]); ?>">&nbsp;&nbsp;
    项目费用：
    <input type="text" name="type_price" class="abc input-default" placeholder="请输入项目费用" value="<?php echo ($where["mobile"]); ?>">&nbsp;&nbsp;
    补贴比例：
    <input type="text" name="type_scale" class="abc input-default" placeholder="请输入补贴比例" value="<?php echo ($where["idCard"]); ?>">%&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">提交</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <?php if(empty($list)): ?><tr>
        <th style="text-align:center">
            管理员太懒了！什么都没有留下！
        </th>
    </tr>
    <?php else: ?>
    <tr>
        <th>补贴项目</th>
        <th>项目费用</th>
        <th>补贴比例</th>
        <th>操作</th>
    </tr><?php endif; ?>
    </thead>
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
             <td><?php echo ($vo["type_name"]); ?></td>
             <td><?php echo ($vo["type_price"]); ?></td>
             <td><?php echo ($vo["type_scale"]); ?>%</td>
             <td style="width:70px;">
                <a href="javascript:;" class="del" name="<?php echo ($vo["id"]); ?>">删除</a>
             </td>
        </tr><?php endforeach; endif; ?>
</table>

</body>
</html>
<script>
    $(function () {

         $('.del').click(function(){
                var r=confirm("确定要删除该数据？");
                var newsId = $(this).attr("name");
                if (r==true)
                {
                    $.post("/index.php?s=/admin/model/del.html",{id:newsId,model:'package_type'},function(data){
                        if(data.status == 'y'){
                            alert(data.msg);
                            document.location.reload(); 
                        }else{
                            alert(data.msg);
                        }
                    },'json');
                }
         });
    });

</script>