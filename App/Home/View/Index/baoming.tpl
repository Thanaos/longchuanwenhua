<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>新阳光体育</title>
<link rel="stylesheet"  href="__ROOT__/Public/Home/css/yl.home.min.css" />
<script src="__ROOT__/Public/Home/js/jquery-1.4.2.min.js"></script>
</head>
<body> 
<div class="type-index">
	<div class="headbar bg1">
		<h1 class="title">活动报名</h1>
		</div>
	<!--/ header-->
	
	
    <div class="hm_index_header">
    
    </div>
	<!--/ hm_index_header-->
	
	<div class="hm-zh">
		<form action="#" method="post">
			<ul class="mb30">
                <li class="mb15"><strong class="bt">项目：</strong>
                    <select name="act_id" id="act_id">
                        <foreach name="list" item="vo">
                        <option value="{$vo.id}">{$vo.title}</option>
                        </foreach>
                    </select>
                </li>
                <li class="mb15" style="height:120px"><strong class="bt">说明：</strong><div id="act_content" style="height: 120px;float:left;font-size: 14px;width: 70%;">{$list.0.content}</div></li>
				<li class="mb15"><strong class="bt">姓名：</strong><input type="text" class="sr" value="" name="name"/></li>
                <li class="mb15"><strong class="bt">课程：</strong><input type="text" class="sr" value="" name="kecheng" placeholder="" /> </li>
				<li class="mb15"><strong class="bt">性别：</strong><label class="mr"><input name="a1" type="radio" value="">男</label><label><input name="a1" type="radio" value="">女</label></li>
				<li class="mb15"><strong class="bt">年龄：</strong><input type="text" class="sr" value="" name="age" /></li>
				<li><strong class="bt">手机：</strong><input type="text" class="sr" value="" name="tel" /></li>
			</ul>
			<div class="tc"><input type="submit" class="sub-btn w100" value="提交" name=""></div>
			
		</form>	
	</div>
	<!--/hm-zh-->
<script>	
$(function(){
        $('#act_id').change(function(){
            var id = $(this).val();
            $.post('/index.php//home/index/ajax/', {id:id},function(data){
                if(data.status == 'y'){
                    $('#act_content').html(data.content);
                }                              

            },'json')
        })   

})
</script>	

</div>
<!--/ type-index-->
</body>
</html>
