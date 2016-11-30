<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/css/dpl-min.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/css/bui-min.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/css/main-min.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="header">

    <div class="dl-title">
        <!--<img src="/chinapost/Public/assets/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($admin["name"]); ?></span><a href="/index.php?s=/admin/users/logout.html"
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
<script type="text/javascript" src="/Public/Admin/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/bui-min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common/main-min.js"></script>
<script type="text/javascript" src="/Public/Admin/js/config-min.js"></script>
<script>
    BUI.use('common/main', function (){
        var config = [{id:'1',homePage : '5',menu:[
            <?php if($admin_role == 'all'): ?>{text:'网站管理 ',items:[
                {id:'4',text:'轮播图',href:'/index.php?s=/admin/index/flash.html'},
                {id:'8',text:'会员种类',href:'/index.php?s=/admin/package/list.html'},
                {id:'9',text:'诊疗项目',href:'/index.php?s=/admin/goods/list.html'},
                {id:'11',text:'协议管理',href:'/index.php?s=/admin/agreement/list.html'},
                {id:'15',text:'材料清单',href:'/index.php?s=/admin/index/clist.html'},
            ]},<?php endif; ?>
            {text:'会员管理 ',items:[
            <?php if(($admin_role == 2) or ($admin_role == 'all')): ?>{id:'12',text:'购买会员申请',href:'/index.php?s=/admin/subsidies/buy.html'},<?php endif; ?>
                {id:'5',text:'会员列表',href:'/index.php?s=/admin/member/list.html'},
                {id:'18',text:'订单列表',href:'/index.php?s=/admin/order/m_list.html'},
            <?php if(($admin_role == 3) or ($admin_role == 2) or ($admin_role == 'all')): ?>{id:'7',text:'补贴申请',href:'/index.php?s=/admin/subsidies/list.html'},<?php endif; ?>
            <?php if(($admin_role == 3) or ($admin_role == 2) or ($admin_role == 5) or ($admin_role == 'all')): ?>{id:'17',text:'退款申请',href:'/index.php?s=/admin/order/refund.html'},<?php endif; ?>
            ]},
            <?php if(($admin_role == 3) or ($admin_role == 'all')): ?>{text:'财务管理 ',items:[
                {id:'6',text:'年费收入详情',href:'/index.php?s=/admin/income/list.html'},
                {id:'10',text:'套餐收入详情',href:'/index.php?s=/admin/order/list.html'},
                {id:'16',text:'推荐医生管理',href:'/index.php?s=/admin/doctor_list/list.html'},
            ]},<?php endif; ?>
            <?php if($admin_role == 'all'): ?>{text:'权限管理',items:[
                {id:'2',text:'用户管理',href:'/index.php?s=/admin/power/user.html'}
            ]},<?php endif; ?>

            ]}];
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>
</body>
</html>