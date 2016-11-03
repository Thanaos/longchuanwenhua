<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css"/>
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script src="/Public/Admin/js/jquery.page.js"></script>
    <script src="/Public/Admin/js/layer/layer.js"></script>


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
        .tcdPageCode{padding: 15px 20px;text-align: left;color: #ccc;text-align:center;} .tcdPageCode a{display: inline-block;color: #428bca;display: inline-block;height: 25px;	line-height: 25px;	padding: 0 10px;border: 1px solid #ddd;	margin: 0 2px;border-radius: 4px;vertical-align: middle;} .tcdPageCode a:hover{text-decoration: none;border: 1px solid #428bca;} .tcdPageCode span.current{display: inline-block;height: 25px;line-height: 25px;padding: 0 10px;margin: 0 2px;color: #fff;background-color: #428bca;	border: 1px solid #428bca;border-radius: 4px;vertical-align: middle;} .tcdPageCode span.disabled {
            display: inline-block;
            height: 25px;
            line-height: 25px;
            padding: 0 10px;
            margin: 0 2px;
            color: #bfbfbf;
            background: #f2f2f2;
            border: 1px solid #bfbfbf;
            border-radius: 4px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<form class="form-inline definewidth m20" action="<?php echo U('member/subsidies', array('act'=>'buy'));?>" method="post">
    审核状态：
    <select name="status" id="">
        <option value="4" <?php if($where['status'] == 4): ?>selected<?php endif; ?>>全部</option>
        <option value="0" <?php if($where['status'] == 0): ?>selected<?php endif; ?>>未审核</option>
        <option value="1" <?php if($where['status'] == 1): ?>selected<?php endif; ?>>未通过</option>
        <option value="2" <?php if($where['status'] == 2): ?>selected<?php endif; ?>>已通过</option>
    </select>
    <button type="submit" class="btn btn-primary">查询</button>
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
            <th>姓名</th>
            <th>出生日期</th>
            <th>性别</th>
            <th>身份证</th>
            <th>手机</th>
            <th>居住地</th>
            <th>申请日期</th>
            <th>状态</th>
            <th>操作</th>
        </tr><?php endif; ?>
    </thead>
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["birthday"]); ?></td>
            <td><?php if($vo["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
            <td><?php echo ($vo["idcard"]); ?></td>
            <td><?php echo ($vo["mobile"]); ?></td>
            <td><?php echo ($vo["domicile"]); ?></td>
            <td style="text-align:left"><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
            <td>
                <?php if($vo["times"] == -1): ?><span style="color:red">未通过</span>
                <?php elseif($vo["times"] >= 3): ?>
                    <span style="color:green">已通过</span>
                <?php else: ?>
                    未审核<?php endif; ?>
            </td>
            <td style="width:200px;">
                <a href="javascript:void(0);" onclick="get_sub_detail('<?php echo ($vo["name"]); ?>的会员购买申请', '<?php echo U("member/buy_detail", array("id"=>$vo['sid']));?>')" >查询详情</a>&nbsp;&nbsp;
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="tcdPageCode"></div>

</body>
</html>
<script>

    function get_sub_detail(title, content){
        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: 0.8,
            area: ['900px', '90%'],
            content: content
        });
    }
    $(".tcdPageCode").createPage({
        pageCount:<?php echo ($show["pageCount"]); ?>,
        current:<?php echo ($show["current"]); ?>,
        backFn: function ( p ){
            window.location.href = '/index.php?s=/admin/news/<?php echo ($type); ?>/' + p + '.html';
        }
    });
    $(function (){

        $('#addnew').click(function (){
            window.location.href = "/index.php?s=/admin/user/edit.html";
        });



        $('.del').click(function (){
            var r = confirm("确定要删除该数据？");
            var newsId = $(this).attr("name");
            if ( r == true ){
                $.post("/index.php?s=/admin/user/del.html",{id:newsId}, function ( data ){
                    if ( data.status == 'y' ){
                        alert(data.msg);
                        document.location.reload();
                    } else{
                        alert(data.msg);
                    }
                }, 'json');
            }
        });
    });

</script>