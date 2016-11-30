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
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td colspan="4"><h5>订单详情</h5></td>
    </tr>
    <tr>
        <td>订单编号</td><td><?php echo ($data["order_sn"]); ?></td>
        <td>套餐名称</td><td><?php echo ($data["goods_name"]); ?></td>
    </tr>
    <tr>
        <td>用户名</td><td><?php echo ($data["name"]); ?></td>
        <td>手机号</td><td><?php echo ($data["mobile"]); ?></td>
    </tr>
    <tr>
        <td>应付价格</td><td><?php echo ($data["yuan_money"]); ?></td>
        <td>实付价格</td><td><?php echo ($data["money"]); ?></td>
    </tr>
    <tr>
        <td>退款申请</td>
        <td colspan="3"><?php echo ($data["remark"]); ?></td>
    </tr>
    <tr>
        <td colspan="4"><h5>审核记录</h5></td>
    </tr>
    <tr>
        <td>管理员</td>
        <td>审核状态</td>
        <td>备注</td>
        <td>操作时间</td>
    </tr>
    <?php if(is_array($check_list)): $i = 0; $__LIST__ = $check_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["nam+e"]); if($vo["group_id"] == 1): ?>(超级管理员)<?php elseif($vo["group_id"] == 2): ?>(医事审核)<?php elseif($vo["group_id"] == 3): ?>(财务审核)<?php elseif($vo["group_id"] == 5): ?>(主管审核)<?php endif; ?></td>
            <td><?php if($vo["status"] == 1): ?><span style="color:red">不通过</span><?php else: ?><span style="color:green">通过</span><?php endif; ?></td>
            <td><?php echo ($vo["remark"]); ?></td>
            <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr>
        <td colspan="4"><h5>审核操作</h5></td>
    </tr>
    <tr>
        <td colspan="2">
            <select name="status" id="status">
                <option value="1">不通过</option>
                <option value="2">通过</option>
            </select>
        </td>
        <td colspan="2">审核意见：<input type="text" name="remark" value=""></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center">
            <button type="button" id="submit" class="btn btn-primary">提交</button>
        </td>
    </tr>
</table>
</body>
</html>
<script>
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    $(function(){
        $('#submit').click(function(){
            var id = <?php echo ($data["rid"]); ?>;
            var status = $('#status').val();
            var remark = $('input[name="remark"]').val();
            if( status == 1 ){
                if( remark.length < 0 ){
                    alert('请填写不通过原因！');
                    return false;
                }
            }
            $.post('<?php echo U("finance/order", array("act"=>"check_log"));?>',{id:id,status:status,remark:remark,type:3},function(data){
                if( data.status == 'y' ){
                    alert(data.msg);
                    parent.document.location.reload();
//                    parent.layer.close(index);
                }else{
                    alert(data.msg);
                }
            },'json')
        })
    })

</script>
</table>
</body>
</html>
<script>


</script>