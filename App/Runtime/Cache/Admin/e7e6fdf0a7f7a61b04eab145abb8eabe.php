<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
 <head>    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> 
  <title>会员管理管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/Public/Admin/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/Public/Admin/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/Public/Admin/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
       <!--<img src="/chinapost/Public/assets/img/top.png">-->
      </div>

      <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($admin); ?></span><a href="/index.php/admin/user/logout.html" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
          <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">会员管理</div></li>       
          <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">活动管理</div></li>       

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
    BUI.use('common/main',function(){
        var config = [{id:'1',homePage : '3',menu:[{text:'会员管理',items:[{id:'2',text:'新增会员',href:'/index.php/admin/Member/edit.html'},{id:'3',text:'会员列表',href:'/index.php/admin/Member/list.html'},{id:'4',text:'会员管理',href:'/index.php/admin/Member/points.html'},{id:'5',text:'积分规则',href:'/index.php/admin/config/index.html'}]}]},{id:'7',homePage : '9',menu:[{text:'活动管理',items:[{id:'9',text:'活动管理',href:'/index.php/admin/activity/list.html'},{id:'10',text:'活动报名',href:'/index.php/admin/activity/baoming.html'}]}]}];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>