<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <link rel="shortcut icon" href="/zzyl/favicon.ico" type="image/x-icon"/>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/zzyl/Public/Admin/css/dpl-min.css" rel="stylesheet" type="text/css"/>
    <link href="/zzyl/Public/Admin/css/bui-min.css" rel="stylesheet" type="text/css"/>
    <link href="/zzyl/Public/Admin/css/main-min.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="header">

    <div class="dl-title">
        <!--<img src="/chinapost/Public/assets/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($admin); ?></span><a href="/zzyl/index.php/admin/users/logout.html"
                                                                        title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform">
            <div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div>
        </div>
        <ul id="J_Nav" class="nav-list ks-clear">
            <li class="nav-item dl-selected">
                <div class="nav-item-inner nav-home">管理模块</div>
            </li>

        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<script type="text/javascript" src="/zzyl/Public/Admin/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/zzyl/Public/Admin/js/bui-min.js"></script>
<script type="text/javascript" src="/zzyl/Public/Admin/js/common/main-min.js"></script>
<script type="text/javascript" src="/zzyl/Public/Admin/js/config-min.js"></script>
<script>
    BUI.use('common/main', function (){
        var config = [{id:'1',homePage : '4',menu:[
            {text:'网站管理 ',items:[
                {id:'4',text:'轮播图',href:'/zzyl/index.php/admin/index/flash.html'}
            ]},
            <?php if($admin_role == 'all'): ?>{text:'权限管理',items:[
                {id:'2',text:'用户管理',href:'/zzyl/index.php/admin/power/user.html'}
            ]},<?php endif; ?>
            <?php if(($admin_role == 'all') or (strpos($admin_role, '1'))): ?>{text:'订单管理',items:[
                {id:'2',text:'未处理订单',href:'/zzyl/index.php/admin/order/untreated.html'},
                {id:'2',text:'订单查询',href:'/zzyl/index.php/admin/order/list.html'}
            ]},<?php endif; ?>

            ]}];
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>
</body>
</html>