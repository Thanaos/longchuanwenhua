<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>车辆信息</title>
<script src="/Public/Home/js/mui.min.js"></script>
<link href="/Public/Home/css/mui.min.css" rel="stylesheet" />
<link href="/Public/Home/css/smxc_css.css" rel="stylesheet" />
<link href="/Public/Home/css/style.css" rel="stylesheet" />
</head>
<style>
#sfxz{
  display: block;
  width: 100%;
  position: absolute;
  top: 62px;
  left: 0;
  padding:0 10px;
}
#sfxz div{
width: 100%;
height:auto;
position:relative;
background: white;
}
#sfxz div a{
display:inline-block;
float:left;
width:25%;
height:25%;
padding:10px 0;
text-align: center;
}
html, body{height: 100%;position: relative;}

.bor-r{border-right: 1px solid #cfd2d6;}
.keyboard-main{height: auto;width: 100%;background-color: #cfd2d6;position: absolute;left: 0;bottom: 0;display: none;}
.keyboard-writing{height: 40px;border: 1px solid #cfd2d6;background-color: #f9fafa;}
.keyboard-writing span{width: 16.3%;height: 40px;line-height: 40px;display: inline-block;text-align: center;float: left;font-size: 16px;display: table-cell;vertical-align:middle;}
.keyboard-writing span img{width: 14px;height: 9px;vertical-align:middle;}


.keyboard-letter{width: 100%;height:auto;background-color: ;overflow: hidden;}

.keyboard-letter ul li{float: left;height: 39px;line-height: 39px;width: 8%;margin:1%;box-sizing: border-box;text-align: center;background-color: #f5f6f7;border-radius: 5px;box-shadow: 0px 1px 0px #65686b;font-size:16px;color: #000;font-weight: normal;display: table-cell;vertical-align:middle;}
.keyboard-letter ul li img{width: 21px;height: 15px;vertical-align:middle;}


#div_car_number{width: 50%;
border: 1px solid #F1ECEC;
    	height: 26px;
line-height: 26px;
    	padding: 0px 10px;
    	margin: 8px 0px 0px 15px;
    	font-size: 0.9em;
float: left;}
</style>
<body>
<div id="main">
<!--通出 默认 头部title-->
<!--<div class="header_nav">-->
<!--<a class="icon-return">返回</a>-->
<!--<a class="icon-doubt">疑问</a>-->
<!--<h1 class="mui-title">车辆信息</h1>-->
<!--</div>-->
<!--end  通出 默认 头部title-->
<!--车牌号 信息-->
<div class="clxx_layout">
<div class="clxx_cphxx">
<div class="mui-table-view-cell clxx_cphxx_cph">
<span>车牌号码:</span>
<div id="car_p" class="cphxx-icon-options">京<i></i></div>
<!--<input name="" type="text" placeholder="请输入车牌号码" maxlength="6">-->
<div id="div_car_number" ></div>
</div>
<div id="choosecar" class="mui-table-view-cell mui-media-body clxx_cphxx_cph">
<a class="mui-navigate-right" href="javascript:;">
<span>车辆品牌:</span><span id="carName" placeholder="">请选择车辆品牌</span>
</a>
</div>
<div class="mui-table-view-cell mui-media-body clxx_cphxx_cph">
<a class="mui-navigate-right" href="javascript:;">
<span>车辆颜色:</span>
<select name="">
  <option>黑色</option>
  <option>白色</option>
  <option>灰色</option>
  <option>红色</option>
  <option>蓝色</option>
  <option>紫色</option>
  <option>青色</option>
  <option>橙色</option>
  <option>粉色</option>
  <option>银灰色</option>
  <option>香槟色</option>
  <option>巧克力色</option>
  <option>其它色</option>
</select>
</a>
</div>
</div>
</div>
<!--end  车牌号 信息-->

<!--车辆信息  主体按钮-->
<div class="clxx-main-btn">
<a id="btnOK"  class="clxx-btn">确定</a>
</div>
</div>
<!--省份选择-->
<section id="sfxz" style="display:none ;">
<div>
<a href="#" class="sfxzbx_bottom sfxzbx_right">京</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">津</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">沪</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">渝</a>
<a href="#" class="sfxzbx_bottom ">冀</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">豫</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">云</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">辽</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">黑</a>
<a href="#" class="sfxzbx_bottom ">湘</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">皖</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">鲁</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">新</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">苏</a>
<a href="#" class="sfxzbx_bottom ">浙</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">赣</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">鄂</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">桂</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">甘</a>
<a href="#" class="sfxzbx_bottom">晋</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">蒙</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">陕</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">吉</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">闽</a>
<a href="#" class="sfxzbx_bottom ">粤</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">贵</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">青</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">藏</a>
<a href="#" class="sfxzbx_bottom sfxzbx_right">川</a>
<a href="#" class="sfxzbx_bottom ">宁</a>
<a href="#" class="sfxzbx_right  sfxzbx_right">琼</a>
<a href="#" class="sfxzbx_right  sfxzbx_right">使</a>
<br style="clear:both;height:0px;" />
</div>
</section>

<!-- 车型-->
<div id="carType">
<div id="carbrand">
<div id="letter">
<ul id="car1"></ul>
</div>
<div id="brand">
<ul id="car2" class="clearfix"></ul>
</div>
<div id="cars">
<div class="header">
<div class="left" onclick="toggleCarType();">
<img src="/Public/Home/images/back@2x.png" width="48" height="30">
</div>
</div>
<ul id="car3" class="clearfix"></ul>
</div>
</div>
</div>
<div id="div_keyboard_main" class="keyboard-main">
<div class="keyboard-writing">
<span class="bor-r">港</span>
<span class="bor-r">澳</span>
<span class="bor-r">学</span>
<span class="bor-r">警</span>
<span class="bor-r">领</span>
<span class="keyboard_ok"><img src="/Public/Home/images/keyboard-xiabiao.png"/></span>
</div>
<div class="keyboard-letter">
<ul>
<li>1</li>
<li>2</li>
<li>3</li>
<li>4</li>
<li>5</li>
<li>6</li>
<li>7</li>
<li>8</li>
<li>9</li>
<li>0</li>
<li>Q</li>
<li>W</li>
<li>E</li>
<li>R</li>
<li>T</li>
<li>Y</li>
<li>U</li>
<li>I</li>
<li>O</li>
<li>P</li>
<li>A</li>
<li>S</li>
<li>D</li>
<li>F</li>
<li>G</li>
<li>H</li>
<li>J</li>
<li>K</li>
<li>L</li>
<li id="keyboard_delete" class="keyboard_delete" style="background-color: #b4b6ba;"><img src="/Public/Home/images/keyboard-delete.png"/></li>
<li>Z</li>
<li>X</li>
<li>C</li>
<li>V</li>
<li>B</li>
<li>N</li>
<li>M</li>
<li class="keyboard_ok" style="width: 28%; background-color: #1979ff;color: #fff;">确定</li>
</ul>
</div>
</div>
<input id="form_submit" type="hidden" name="form_submit" value="true">
<input id="form_hash" type="hidden" name="formhash" value="beed8e1b"/>
<div id="userId" style="display: none">FS150901160945422100</div>
</body>
<script type="text/javascript">
// 省份选择
var div_sfxz=document.getElementById("sfxz");
var div_car_p=document.getElementById("car_p");
div_sfxz.addEventListener("touchend",function(e){
if(e.target.nodeName.toUpperCase()=="A")
{
car_p.innerHTML=e.target.innerHTML+"<i></i>";
this.style["display"]="none";
}
e.stopPropagation();
e.preventDefault();
},false);
div_car_p.addEventListener("touchend",function(e){
div_sfxz.style["display"]="block";
},false);


</script>
<!--品牌信息-->
<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/util.js"></script>
<script type="text/javascript" src="/Public/Home/js/toPinYin.js"></script>
<script type="text/javascript" src="/Public/Home/js/xinghao.js"></script>
<script type="text/javascript" src="/Public/Home/js/cartype.js"></script>
<script type="text/javascript" src="/Public/Home/js/custom.js?v=201411221"></script>
<script type="text/javascript" src="/Public/Home/js/vehicleInspection.js"></script>
    <script src="/Public/Home/js/index.js?v=1.3"></script>
    <!--<script>alert('')</script>-->
</html>