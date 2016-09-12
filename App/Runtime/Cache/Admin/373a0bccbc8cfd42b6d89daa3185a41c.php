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
    <link rel="stylesheet" href="/Public/Admin/js/layer/skin/layer.css">
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
.tcdPageCode{padding: 15px 20px;text-align: left;color: #ccc;text-align:center;}
.tcdPageCode a{display: inline-block;color: #428bca;display: inline-block;height: 25px;	line-height: 25px;	padding: 0 10px;border: 1px solid #ddd;	margin: 0 2px;border-radius: 4px;vertical-align: middle;}
.tcdPageCode a:hover{text-decoration: none;border: 1px solid #428bca;}
.tcdPageCode span.current{display: inline-block;height: 25px;line-height: 25px;padding: 0 10px;margin: 0 2px;color: #fff;background-color: #428bca;	border: 1px solid #428bca;border-radius: 4px;vertical-align: middle;}
.tcdPageCode span.disabled{	display: inline-block;height: 25px;line-height: 25px;padding: 0 10px;margin: 0 2px;	color: #bfbfbf;background: #f2f2f2;border: 1px solid #bfbfbf;border-radius: 4px;vertical-align: middle;}
#div_addpoint{margin-top: 20px;margin-left: 20px;}
</style>
</head>
<body>
    <div class="form-inline definewidth m20">
    <form action="#" method="post">
        <input type="text" name="name" style="width:100px;" <?php if(!empty($s["0"])): ?>value="<?php echo ($s["0"]); ?>"<?php endif; ?>>(会员名称)&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" class="btn btn-success" id="search">搜索</button>
    </form>
</div>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <?php if(empty($list)): ?><tr>
        <th style="text-align:center">
            管理员太懒了！什么都没有留下！
        </th>
    </tr>
    <?php else: ?>
    
        <th>会员名称</th>
        <th>会员编号</th>
        <th>会员积分</th>
        <th>操作</th>
    </tr><?php endif; ?>
    </thead>
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
             <td><?php echo ($vo["name"]); ?></td>
             <td><?php echo ($vo["number"]); ?></td>
             <td class="point_<?php echo ($vo["id"]); ?>"><?php echo ($vo["points"]); ?></td>
            <td style="width:300px;">
                <a href="javascript:;" id = "<?php echo ($vo["id"]); ?>"class="addponit">积分充值</a>
                <a href="javascript:;" id="<?php echo ($vo["id"]); ?>" class="delpoint">消费积分</a>
                <a href="/index.php/admin/member/tree/<?php echo ($vo["id"]); ?>.html">查看会员关系</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="tcdPageCode"></div>
<div id="div_addpoint" style="display:none">
    <form>
        <div><span>积分：</span><span><input type="text" value="" name="point" class="inputxt"></span></div>
        <input type="hidden" name="id" value="">
        <input type="hidden" name="act" value="">
        <div style="width:100%;"><button id="pointbtn" class="btn btn-primary" type="button" style="margin-left: 100px;">保存</button></div>
    </form>
</div>
</body>
</html>
<script>
    $(".tcdPageCode").createPage({
        pageCount:<?php echo ($show["pageCount"]); ?>,
        current:<?php echo ($show["current"]); ?>,
        backFn:function(p){
            window.location.href='/index.php/admin/member/points/'+p+'.html';
        }
    });
    $(function () {
        /*****增加积分*****/
        $('.delpoint').click(function(){
            layer.open({
                    type: 1,
                    title:'消费积分',
                    area: ['300px', '150px'],
                    shade: 0.6, //遮罩透明度
                    shift: 1, //0-6的动画形式，-1不开启
                    content: $('#div_addpoint')
            });
            $('input[name="id"]').val($(this).attr('id'));
            $('input[name="act"]').val('del');
        })
        /*****消费积分*****/
        $('.addponit').click(function(){
            layer.open({
                    type: 1,
                    title:'积分充值',
                    area: ['300px', '150px'],
                    shade: 0.6, //遮罩透明度
                    shift: 1, //0-6的动画形式，-1不开启
                    content: $('#div_addpoint')
            });
            $('input[name="id"]').val($(this).attr('id'));
            $('input[name="act"]').val('add');
        })

        $('#pointbtn').click(function(){
            var point = $('input[name="point"]').val();
            var id = $('input[name="id"]').val();
            var act = $('input[name="act"]').val();
            if(point == 0){
                layer.alert('积分能为空');
            }
            $.post('/index.php/admin/member/addpoint',{point:point,id:id,act:act},function(data){
                if(data.status == 'y'){
                    layer.alert(data.msg,function(){   
                        layer.closeAll();
                    });
                    $('.point_'+id).html(data.point);
                }else{
                    layer.alert(data.msg, function(){   
                        layer.closeAll();
                    });
                }
            },'json')
        })
    });

</script>