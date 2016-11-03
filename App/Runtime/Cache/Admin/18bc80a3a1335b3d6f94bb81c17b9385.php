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
<form class="form-inline definewidth m20" action="<?php echo U('member/list');?>" method="post">
    姓名：
    <input type="text" name="name" id="name" class="abc input-default" placeholder="请输入用户姓名" value="<?php echo ($where["name"]); ?>">&nbsp;&nbsp;
    手机：
    <input type="text" name="mobile" id="mobile" class="abc input-default" placeholder="请输入手机号" value="<?php echo ($where["mobile"]); ?>">&nbsp;&nbsp;
    身份证：
    <input type="text" name="idCard" id="idCard" class="abc input-default" placeholder="请输入身份证号" value="<?php echo ($where["idCard"]); ?>">&nbsp;&nbsp;
    年龄：
    <input type="text" name="start_age" id="start_age" class="abc input-default" placeholder="请输入开始年龄" value="<?php echo ($where["start_age"]); ?>">&nbsp;&nbsp;
    <input type="text" name="end_age" id="end_age" class="abc input-default" placeholder="请输入结束年龄" value="<?php echo ($where["end_age"]); ?>">&nbsp;&nbsp;
    患病时长：
    <select name="illness_time" id="" class="form-control">
        <option>请选择</option>
        <option value="1" <?php if($where["illness_time"] == 1): ?>selected<?php endif; ?>>1年</option>
        <option value="2" <?php if($where["illness_time"] == 2): ?>selected<?php endif; ?>>2年</option>
        <option value="3" <?php if($where["illness_time"] == 3): ?>selected<?php endif; ?>>3年</option>
        <option value="4" <?php if($where["illness_time"] == 4): ?>selected<?php endif; ?>>4年</option>
        <option value="5" <?php if($where["illness_time"] == 5): ?>selected<?php endif; ?>>5年</option>
        <option value="6" <?php if($where["illness_time"] == 6): ?>selected<?php endif; ?>>5年以上</option>
    </select>&nbsp;&nbsp;<br />
    临床诊断：
    <select name="diagnose" id="diagnose" class="form-control">
        <option>请选择</option>
        <?php if(is_array($sickid)): $i = 0; $__LIST__ = $sickid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($i); ?>" <?php if($vo['diagnose'] == $i): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
    长期居住地：
    <input type="text" name="cq_domicile" id="cq_domicile" class="abc input-default" placeholder="请输入长期居住地" value="<?php echo ($where["cq_domicile"]); ?>">&nbsp;&nbsp;
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
            <th>年龄</th>
            <th>性别</th>
            <th>身份证</th>
            <th>手机</th>
            <th>患病时长</th>
            <th>受托人</th>
            <th>受托人电话</th>
            <th>与本人关系</th>
            <th>居住地</th>
            <th>注册时间</th>
            <th>会员级别</th>
            <th>到期时间</th>
            <th>余额</th>
            <th>操作</th>
        </tr><?php endif; ?>
    </thead>
    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["age"]); ?></td>
            <td><?php if($vo["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
            <td><?php echo ($vo["idcard"]); ?></td>
            <td><?php echo ($vo["mobile"]); ?></td>
            <td><?php if($vo["illness_time"] == 1): ?>1年<?php elseif($vo["illness_time"] == 2): ?>2年<?php elseif($vo["illness_time"] == 3): ?>3年<?php elseif($vo["illness_time"] == 4): ?>4年<?php elseif($vo["illness_time"] == 5): ?>5年<?php elseif($vo["illness_time"] == 6): ?>5年以上<?php endif; ?></td>
            <td><?php echo ($vo["bailor"]); ?></td>
            <td><?php echo ($vo["bailor_mobile"]); ?></td>
            <td><?php echo ($vo["relation"]); ?></td>
            <td><?php echo ($vo["domicile"]); ?></td>
            <td style="text-align:left"><?php echo (date('Y-m-d H:i:s',$vo["createtime"])); ?></td>
            <td><?php if($vo["vip_type"] == 1): ?>特尊卡会员<?php elseif($vo["vip_type"] == 2): ?>银卡会员<?php elseif($vo["vip_type"] == 3): ?>金卡会员<?php else: ?>普通用户<?php endif; ?></td>
            <td><?php if($vo["vip_type"] > 0): echo (date("Y-m-d",$vo["vip_time"])); endif; ?></td>
            <td><?php echo ($vo["money"]); ?> 元</td>
            <td style="width:120px;">
                <a href="javascript:;" class="show" data-toggle="modal" data-target="#myModal_<?php echo ($vo["id"]); ?>">查询详情</a>
            </td>
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
                        <td><?php echo ($sickid[$vo['diagnose']-1]); ?></td>
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
                    <tr>
                        <td colspan="2">病史图片</td>
                    </tr>
                    <?php if(is_array($vo["bl_img_arr"])): $i = 0; $__LIST__ = $vo["bl_img_arr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                            <td colspan="2"><img src="<?php echo ($val["path"]); ?>" /></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

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