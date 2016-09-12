<!doctype html>
<html lang="en">
<head>
	<title>填写详细资料</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection"content="telephone=no, email=no" />
    <link rel="stylesheet" href="__ROOT__/Public/Home/css/neat.css">
    <link rel="stylesheet" href="__ROOT__/Public/Home/css/common.css" />
    <script type="text/javascript" src="__ROOT__/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="__ROOT__/Public/Home/js/layer/layer.js"></script>
    <script>
    	$(function(){

    		// select
    		var _select = $('.form-item select'),
    			_change = $('.form-item input');

    		_select.change(function(){
    			var _this = $(this),
    				_cval = _this.prev('input');
    			if(_cval){
    				_cval.val(_this.find("option:selected").text());
    			}else{
    				return false;
    			}
    		})

    	})
    </script>
</head>
<body>
	
	<!--register begin-->
	<header class="register-header">
		性别、生日、身高、学历、婚姻状况注册后将不能修改, 请认真填写。
	</header>
	
	<section class="register-main">
		<!--form-item-->
    <form action="#" id="registerform">
		<div class="register-form-box">
			<div class="form-item flex">
				<label for="">昵称</label>
                <input type="text" class="form-control flex-item" name="nickname" datatype="*" nullmsg="请输入昵称" errormsg="请输入昵称" value="{$userinfo.nickname}" placeholder="昵称" />
			</div>
			<div class="form-item flex">
				<label for="">性别</label>
				<input type="text" class="form-control flex-item"  datatype="*" nullmsg="必须选择性别" errormsg="必须选择性别"  placeholder="请选择" />
				<select name="sex" id="">
					<option value="1">男</option>
					<option value="0">女</option>
				</select>
			</div>
			<div class="form-item flex">
				<label for="">生日</label>
				<input type="date" name="date" datatype="*" nullmsg="请选择出生日期" errormsg="请选择出生日期" style="text-align: right !important;" class="form-control flex-item" placeholder="请选择" />
			</div>
			<div class="form-item flex">
				<label for="">身高</label>
				<input type="text" class="form-control flex-item"  datatype="*" nullmsg="请选择身高" errormsg="请选择身高" placeholder="请选择" />
				<select name="height" id="">
                    {$str|getOptionHeight}
				</select>
			</div>
			<div class="form-item flex">
				<label for="">学历</label>
				<input type="text" class="form-control flex-item" datatype="*" nullmsg="请选择学历" errormsg="请选择学历" placeholder="请选择" />
				<select name="education" id="">
                    {$str|getOptionEducation}
				</select>
			</div>
		</div>

		<div class="register-form-box">
			<div class="form-item flex">
				<label for="">婚姻状况</label>
				<input type="text" class="form-control flex-item"  datatype="*" nullmsg="请选择婚姻状况" errormsg="请选择婚姻状况" placeholder="请选择" />
				<select name="marriage" id="">
					<option value="1">未婚</option>
					<option value="2">离异</option>
					<option value="3">丧偶</option>
				</select>
			</div>
			<div class="form-item flex">
				<label for="">工作地区</label>
				<input type="text" class="form-control flex-item"  datatype="*" nullmsg="请选择工作地区" errormsg="请选择工作地区"  placeholder="请选择" />
				<select name="" id="">
					<option value="青岛市">青岛市</option>
					<option value="济南市">济南市</option>
				</select>
			</div>
			<div class="form-item flex">
				<label for="">月收入</label>
				<input type="text" class="form-control flex-item" datatype="*" nullmsg="请选择月收入情况" errormsg="请选择月收入情况" placeholder="请选择" />
				<select name="income" id="">
                    {$str|getOptionIncome}
				</select>
			</div>
        <div>
            <button id="btn">下一步</button>
        </div>
    </form>
	</section>
		
<script type="text/javascript" src="__ROOT__/Public/Admin/js/Validform_v5.3.2/Validform_v5.3.2_min.js"></script>
<script>
$(function () {  

	$.Tipmsg.r=null;
    var showmsg=function(msg){
        layer.open({
            content: msg,
            time: 1
        });
	}
	$("#registerform").Validform({
		tiptype:function(msg){
			showmsg(msg);
		},
        ajaxPost:true,
        tipSweep:true,
        btnSubmit:"#btn",
        callback:function(data){
            if(data.status == 'y'){
                showmsg(data.msg);
                window.location.reload();
            }else{
                showmsg(data.msg);
            }
        return false;
        },
	});

});
</script>
		
	<!--register end-->
	
</body>
</html>
