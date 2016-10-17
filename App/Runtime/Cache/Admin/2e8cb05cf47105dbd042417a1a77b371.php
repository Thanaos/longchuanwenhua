<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="/longhcuanwenhua/favicon.ico" type="image/x-icon"/>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/longhcuanwenhua/Public/Admin/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/longhcuanwenhua/Public/Admin/css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/longhcuanwenhua/Public/Admin/css/style.css"/>
    <script type="text/javascript" src="/longhcuanwenhua/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/longhcuanwenhua/Public/Admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="/longhcuanwenhua/Public/Admin/js/ckform.js"></script>
    <script type="text/javascript" src="/longhcuanwenhua/Public/Admin/js/common.js"></script>
    <script src="/longhcuanwenhua/Public/Admin/js/jquery.page.js"></script>
    <script src="/longhcuanwenhua/Public/Admin/js/layer/layer.js"></script>


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
        <td colspan="4"><h5>会员信息</h5></td>
    </tr>
    <tr>
        <td>会员姓名</td><td><?php echo ($data["name"]); ?></td>
        <td>病变诊断</td><td><?php echo ($data["bbzd"]); ?></td>
    </tr>
    <tr>
        <td>申请时间</td><td><?php echo (date('Y-m-d',$data["addtime"])); ?></td>
        <td>会员注册手机</td><td><?php echo ($data["mobile"]); ?></td>
    </tr>
    <tr>
        <td>委托人姓名</td><td><?php echo ($data["bailor"]); ?></td>
        <td>委托人电话</td><td><?php echo ($data["bailor_mobile"]); ?></td>
    </tr>
    <tr>
        <td>现住址</td>
        <td colspan="3"><?php echo ($data["cq_domicile"]); ?></td>
    </tr>
    <tr>
        <td colspan="4"><h5>补贴内容</h5></td>
    </tr>
    <tr><th>补贴项目</th><th>价格（元）</th><th>补贴比例</th><th>补贴金额（元）</th></tr>
    <?php if(is_array($package)): $i = 0; $__LIST__ = $package;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo["type_name"]); ?></td><td><?php echo ($vo["type_price"]); ?></td><td><?php echo ($vo["type_scale1"]); ?></td><td><?php echo $vo['type_scale1'] * $vo['type_price']/100; ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr><td>合计</td><td><?php echo ($count_price); ?></td><td>&nbsp;</td><td><?php echo ($count_yh); ?></td></tr>
    <tr>
        <td colspan="4"><h5>诊断信息</h5></td>
    </tr>
    <tr>
        <td>诊断</td>
        <td colspan="3"><?php echo ($data["bbzd"]); ?></td>
    </tr>
    <tr>
        <td>诊断医生</td>
        <td colspan="3"><?php echo ($data["zd_doctor"]); ?></td>
    </tr>
    <tr>
        <td colspan="4"><h5>病例图片</h5></td>
    </tr>
    <?php if(is_array($data_img)): $i = 0; $__LIST__ = $data_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td colspan="4"><img src="/longhcuanwenhua<?php echo ($vo["path"]); ?>"></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</body>
</html>
<script>


</script>
</table>
</body>
</html>
<script>


</script>