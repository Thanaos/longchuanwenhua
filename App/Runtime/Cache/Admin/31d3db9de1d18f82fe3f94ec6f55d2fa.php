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
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/jquery-ui.css" />
    <script src="/Public/Admin/js/jquery.page.js"></script>
    <script src="/Public/Admin/js/layer/layer.js"></script>
    <script src="/Public/Admin/js/laydate/laydate.js"></script>


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
<form class="form-inline definewidth m20" action="<?php echo U('income/list');?>" method="post">
    开始时间：
    <input type="text" name="start_time" id="start_time" class="abc input-default" placeholder="请选择时间" value="<?php echo ($where["start"]); ?>" onclick="laydate()">&nbsp;&nbsp;
    结束时间：
    <input type="text" name="end_time" id="end_time" class="abc input-default" placeholder="请选择时间" value="<?php echo ($where["end"]); ?>" onclick="laydate()">&nbsp;&nbsp;
    医生编号：
    <input type="text" name="bh" id="bh" class="abc input-default" placeholder="请输入医生编号" value="<?php echo ($where["bh"]); ?>">&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<div style="margin-top:10px;margin-left:30px"><span>平台总收益：<?php echo ($count_money); ?> 元&nbsp;&nbsp;年费会员数：<?php echo ($count_member); ?> 人</span></div>
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
            <th>身份证</th>
            <th>手机</th>
            <th>会员等级</th>
            <th>支付金额</th>
            <th>支付时间</th>
            <th>支付状态</th>
        </tr><?php endif; ?>
    </thead>
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["idcard"]); ?></td>
            <td><?php echo ($vo["mobile"]); ?></td>
            <td><?php if($vo["type"] == 1): ?>特尊会员 <?php elseif($vo["type"] == 2): ?>银牌会员<?php elseif($vo["type"] == 3): ?>金牌会员<?php endif; ?></td>
            <td><?php echo ($vo["money"]); ?> 元</td>
            <td style="text-align:left"><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
            <td>支付成功</td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="tcdPageCode"></div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- 弹出层 -->
<div class="modal fade" id="myModal_<?php echo ($vo["id"]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    病情明细
                </h4>
            </div>

            <div class="modal-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>临床诊断</td>
                        <td><?php echo ($sickid[$vo['diagnose']]); ?></td>
                    </tr>
                    <tr>
                        <td>患病时长</td>
                        <td><?php if($vo["illness_time"] < 6): echo ($vo["illness_time"]); ?> 年<?php else: ?>5年以上<?php endif; ?></td>
                    </tr>

                    <tr>
                        <td>既往病史</td>
                        <td><?php echo ($vo["illness_history"]); ?></td>
                    </tr>

                    <tr>
                        <td>过敏史</td>
                        <td><?php echo ($vo["gm_history"]); ?></td>
                    </tr>

                    <tr>
                        <td>家族史</td>
                        <td><?php echo ($vo["jz_history"]); ?></td>
                    </tr>

                    <tr>
                        <td>长期居住地</td>
                        <td><?php echo ($vo["cq_domicile"]); ?></td>
                    </tr>

                    <tr>
                        <td>个人简史</td>
                        <td><?php echo ($vo["description"]); ?></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>
<script>
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