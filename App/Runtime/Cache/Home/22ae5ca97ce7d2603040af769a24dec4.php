<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>上门服务</title>
<meta name="format-detection" content="telephone=no"/>
<link href="/Public/Home/css/mui.min.css" rel="stylesheet" />
<link href="/Public/Home/css/smxc_css.css?num=2" rel="stylesheet" />

<script src="/Public/Home/js/zepto.min.js"></script>

<script src='http://webapi.amap.com/maps?v=1.3&key=1e0db08368f992824dcde5570a837d4f&number=1231231'></script>

<script src='/Public/Home/js/amap.js'></script>
<script src='/Public/Home/js/tool.js'></script>
<!--<script src="/Public/Home/js/ajax_lib.js"></script>-->

<style>
#map .amap-logo,#map .amap-copyright{display:none;}
.body_load_pop{display:none;
   color:white;
   text-align:center;
   width:100%;
   height:100%;
   line-height:100%;
   position:absolute;
   top:0;left:0;
   background-color:rgba(000,000,000,0.3);
    z-index:99;}
.zf_pop{
display:none;
    color:white;
    text-align:center;
    width:100%;
    line-height:100%;
    position:absolute;
    top:0;left:0;
    background-color:rgba(000,000,000,0.8);
    z-index:180;}


.phone-leader-pop{position: absolute;bottom:180px;right: 10px;z-index: 20;}
.phone-leader{display:inline-block;width:52px;height:46px;background-color: #fff;border-radius: 5px;-webkit-box-shadow:0 0 5px #ccc;box-shadow:0 0 5px #ccc; position: relative;transition:width 0.5s;-webkit-transition:width 0.5s;overflow: hidden;}
.phone-leader .leader-icon{width: 52px;height: 46px;float: right;padding: 5px 10px;}
.phone-leader .leader-icon img{width: 100%;}
.phone-leader .leader-number{line-height: 34px;height:34px;color: #222;border-right: 1px solid #e5e5e5;top:6px;right:52px;width: 220px;background-color: #fff;position:absolute;}
.phone-leader .leader-number #input_leader_phone{width:126px; color:#999;   float: left;height: 34px;line-height: 34px;font-size: 14px;padding:0px;margin: auto 0;margin-right:10px;border: 0px;}
.phone-leader .leader-number span{color: #fc5a00;margin-right: 0px;font-size: 14px;}


.keyboard-backdrop{display:none;width: 100%;height: 100%;position: absolute;top: 0;right: 0;bottom: 0;left: 0;z-index: 15;background-color: rgba(000,000,000,0.5);}
.keyboard-main-tel{height: auto;width: 100%;background-color: #f00;position: absolute;left: 0;bottom: 0;}

.keyboard-letter-tel{width: 100%;height:auto;background-color: #cfd2d6;overflow: hidden;padding: 10px 8px;}
.keyboard-letter-tel ul li{float: left;height: 39px;line-height: 39px;width: 14%;margin: 1%;text-align: center;background-color: #f5f6f7;border-radius: 5px;box-shadow: 0px 1px 0px #65686b;font-size:16px;color: #000;font-weight: normal;display: table-cell;vertical-align:middle;}
.keyboard-letter-tel ul li img{width: 21px;height: 15px;vertical-align:middle;}
</style>
</head>
<body>
<!--通出 默认 头部title-->
<div class="header_nav">
<a class="icon-return">返回</a>
<a class="icon-doubt">疑问</a>
<h1 class="mui-title">上门服务</h1>
</div>
<!--end  通出 默认 头部title-->
<!--选择停车位 信息-->
<div class="smfw_layout">
<div class="mui-table-view mui-media-body smfw_search">
<div id="search_p" class="smfw_search_loginbar">
<input id="search_word" name="" type="text" placeholder="输入洗车位置">
<!--<span class="pop_text"></span>-->
<i id="clear_keyWords" class="mui-icon mui-icon-closeempty"></i>
</div>
</div>
</div>
<!--地图-->
<div id="map" class="smfu_map"></div>
<!--遮罩层 灰色0.2透明度-->
<div id="map_pop"  class="map_pop_smxc"></div>
<div id="zf_pop" class="zf_pop"></div>
<!--弹出框- 继续下单-->
<div id="div_pop_status" class="mask_pop_status">
<div id="go_order" class="mui-table-view mui-media-body mask_pop_status_text">
<p>月黑风高，小e不便前往</p>
<p>明早9点安排，可否？</p>
</div>
<div id="div_pop_status_btn" class="mask_pop_status_btn">
<a class="status_btn_cancel">我再想想</a>
<a class="status_btn_determine">继续下单</a>
</div>
</div>

<div id="load_pop" class="body_load_pop"></div>

<!--上门服务 选择块-->
<div class="smfw_icon_taxi"><img id="taxi_img" src="/Public/Home/images/smfw-icon-taxi.png"></div>
<div id="smfw_layout"  class="smfw_locate_layout">
<h1 id="estimateTime">当前车辆</h1>
<div class="status">
<a id="car_info" href="javascript:;">
<!--<span>玛莎拉蒂总裁</span>
<span>宝蓝色</span>
<span>京KN1886</span>-->
<i class="mui-icon mui-icon-forward"></i>
</a>
</div>
</div>
<div class="smfw_module_layout">
<div class="smfw_module_tab">
<div id="fw_list" class="mui-table-view mui-media-body smfw_module_tab_img">
<div id="fw_list_content" class="smfw_module_tab_img_list">
<input type="hidden" name="service" id="service" value="">
<?php if(is_array($service_list)): foreach($service_list as $key=>$vo): ?><div class="smfw_tab_slider"><a href="javascript:;" id="<?php echo ($vo["id"]); ?>" class="service"><div class="img"></div><span><?php echo ($vo["service_name"]); ?><br><?php echo ($vo["service_price"]); ?>元</span></a></div><?php endforeach; endif; ?>
</div>
</div>
<div id="div_promotions" class="smfw_module_tab_preferential">
<!--<span>优惠</span>
<p>全车镀膜送玻璃水1瓶</p>-->
</div>
</div>
<div class="smfw_wallet_btn_list">
<div class="smfw_wallet_btn"><a href="javascript:;"><span id="span_pay" style="width:100%" class="width_35">支付</span></a></div>
</div>
</div>
<!--弹出窗-输入结果查询-->
<div id="car_position" class="xztcw_pop_search">
<div class="xztcw_pop_search_layout">
<div  class="mui-table-view mui-media-body xztcw_pop_layout_list head_foot">
<b>洗车历史</b>
</div>
<div id="position_list" class="xztcw_pop_layout_list_scroll"></div>
</div>
</div>
<!--弹出窗-选择支付方式-->
<div id="smxcPopPay" class="smxc_pop_pay_layout">
<div  class="smxc_pop_pay">
<ul>
<li class="mui-table-view mui-media-body" id="li_zf_-1"><p>请选择支付方式</p></li>
<li class="mui-table-view mui-media-body" id="li_zf_4"><a href="javascript:;"><i class="pay_baidu_icon"></i>百度钱包支付</a></li>
<li class="mui-table-view mui-media-body" id="li_zf_3"><a href="javascript:;"><i class="pay_weixin_icon"></i>&nbsp;微&nbsp;&nbsp;信&nbsp;支付</a></li>
<li class="mui-table-view mui-media-body" id="li_zf_2"><a href="javascript:;"><i class="pay_zfb_icon"></i>支付宝支付</a></li>
<li id="li_zf_-2"><a href="javascript:;">取消</a></li>
</ul>
</div>
</div>
<!--弹出框- 暂未开通-->
<div id="zwkt_pop_status" class="zwkt_pop_status">
<div class="mui-table-view mui-media-body zwkt_pop_status_text">
<a class="down-icon"></a>
<p>您所在区域<em>暂未开通</em>上门服务</p>
<p>点击小灯泡邀请小E开通此区域</p>
<div class="zwkt_pop_status_text_icon"><a id="a_open_area" href="javascript:;" class="active"></a></div>
</div>
<div class="zwkt_pop_status_btn">
<a class="zwkt_status_jump"><span id="span_carWash_store"><!--距离您1.5KM有家洗车店，点击查看--></span><i class="mui-icon mui-icon-forward"></i></a>
</div>
</div>
<!-- 洗车队长 -->
<div class="phone-leader-pop">
<div id="div_leader_phone" class="phone-leader" status="short">
<div id="div_leader" class="leader-icon"><img src="/Public/Home/images/man.png" /></div>
<div  class="leader-number">
<!--<input type="tel" maxlength="11" name="" id="input_leader_phone" placeholder="请输入洗车队长手机号"/>-->
<input type="text" readonly="readonly" maxlength="11" id="input_leader_phone" placeholder="请输入洗车队长手机号"/>
<span id="work_name"></span>
</div>
</div>
</div>
<!--洗车队长专用键盘-->
<div id="div_leader_keyboard" class="keyboard-backdrop">
<div class="keyboard-main-tel">
<div class="keyboard-letter-tel">
<ul id="ul_leader_keyboard">
<li>1</li>
<li>2</li>
<li>3</li>
<li>4</li>
<li>5</li>
<li style="background-color: #b4b6ba;"><img src="/Public/Home/images/keyboard-delete.png"/></li>
<li>6</li>
<li>7</li>
<li>8</li>
<li>9</li>
<li>0</li>
<li style="background-color: #1979ff;color: #fff;">确定</li>
</ul>
</div>
</div>
</div>
<!--end  选择停车位 信息-->
<div style="display:none" id='workno'></div>
<input id="input_form_submit" type="hidden" name="form_submit" value="true">
<input id="input_form_hash"type="hidden" name="formhash" value="beed8e1b" />
</body>
<script type="text/javascript" src="/Public/Home/js/dialog.js"></script>
<script>
(function(){
 $('.service').click(function(){
    var id = $(this).attr('id');
    $('.service').removeClass('active');    
    $(this).addClass('active');    
    $('#service').val(id);
 })  
})();

(function(){	
var map1,			    // 地图容器
mmPoint,		    // 地图中心点
div_search,   	    // 搜索洗车位置
img_clear_keyWords, // 清除搜索关键字
div_car_position,   // 历史记录容器
car_position_head,  // 停车位置历史记录的头
div_position_list,  // 洗车历史地址
input_search,	    // 搜索位置输入框
div_taxi_img,	    // 车辆位置图标
div_smfw_layout,    // 上门服务提醒
h_estimateTime,		// 预估上门时间
div_fw_list,	    // 服务列表容器
div_fw_list_content,// 服务列表内容
span_carWash_store, // 最近的洗车店
a_coupons_info,		// 卡券详细信息
div_zwkt_pop,		// 暂未开通
div_pop_status_btn, // 继续下单按钮
div_pop_status,		// 暂停接单提示
div_promotions,		// 促销活动
div_pop,		    // 遮罩map_pop
div_load_pop,		// 全屏遮罩
div_pop_pay,	    // 支付列表
a_span_pay,			// 支付按钮
dk_info="",			// 抵扣信息
input_form_submit,
input_formhash,
userId="FS150901160945422100",
pointNow={},		// 经纬度
cityNow,			// 当前城市
carId="",			// 汽车id
address="",			// 洗车地址
cutprice="0",		// 减价
session={},			// 数据缓存对象
productSelectId=[], // 选中产品id
estimateTimeStamp="",// 预估时间戳
estimatePriceStamp="",  // 预估价格
orderInfo,				// 订单信息
orderId="",				// 订单编号
payPrice="",			// 应付价格
mobile="15954861505",	    //手机号
moveMapTimer,			// 移动地图计时器
workno=$('#workno').html(),	//洗车工编号
mark;
//host="http://test2.exc118.com/vjifen_new/smwash.php";
host="/index.php/home/ajax";
isAlert=0;				// 是否弹出过“我在想想”页面
//userId="FS142679634188690271";
/*sessiong={
carInfo:"默认车辆信息",
carWashHistory:"历史洗车地址",
products:"产品信息",
promotions:"促销活动信息",
coupons:"卡券信息",
latlng:"经纬度",
address:"地址信息",
estimateTime:"预估时间",
estimatePrice:"预估价格(未写)"
};*/

var mainObj={
// 初始化
init:function(){
div_load_pop=document.getElementById("load_pop");

//loading(true,"/Public/Home/images/loading.gif");

$.post(host+"/getSession",{key:"orderInfo"},function(data){
if(data){
orderInfo=JSON.parse(data);
if(orderInfo.code==0&&orderInfo.data){
orderId=orderInfo.data.orderid;
document.getElementById("zf_pop").style["display"]="block";
a_span_pay.removeAttribute("readonly");
}
else{
orderInfo="";
document.getElementById("zf_pop").style["display"]="none";
}
}

});


input_form_submit=document.getElementById("input_form_submit");
input_form_hash=document.getElementById("input_form_hash");
mainObj.getSession(function(data){
if(data){
session=data;
}
else{
var integral="0.00";

if(integral){
session.useIntegral="1";
}
else{
session.useIntegral="0";

}
}
// 获取页面元素
mainObj.getElements();

// 定位地图上图标和洗车信息框
div_taxi_img.style["left"]=window.innerWidth/2-10+"px";
div_taxi_img.style["top"]=(window.innerHeight-50-165)/2-40+50+2+"px";

div_smfw_layout.style["left"]=window.innerWidth/2-118+"px";
div_smfw_layout.style["top"]=(window.innerHeight-50-165)/2-120+50+"px";

document.getElementById("zf_pop").style["height"]=window.innerHeight-40+"px";



//设置地图高度并加载地图
map1.style["height"]=window.innerHeight-50-165+"px";
var option={divId:"map",callback:mainObj.cb};
mmPoint={};
mmPoint.left=window.innerWidth/2;
mmPoint.top=(window.innerHeight-50-165)/2;

gdMap.drawMap(option);	

mainObj.bind_product_list();
});	
},
// 绑定元素
getElements:function(){
map1=document.getElementById("map")
div_search=document.getElementById("search_p");	    
img_clear_keyWords=document.getElementById("clear_keyWords");
div_car_position=document.getElementById("car_position"); 
car_position_head=div_car_position.getElementsByClassName("head_foot")[0];
div_position_list=document.getElementById("position_list");
input_search=document.getElementById("search_word");
div_taxi_img=document.getElementById("taxi_img");
div_smfw_layout=document.getElementById("smfw_layout");
h_estimateTime=document.getElementById("estimateTime");
div_fw_list=document.getElementById("fw_list");
div_fw_list_content=document.getElementById("fw_list_content");
span_carWash_store=document.getElementById("span_carWash_store");
div_zwkt_pop=document.getElementById("zwkt_pop_status");
div_pop_status_btn=document.getElementById("div_pop_status_btn");
div_pop_status=document.getElementById("div_pop_status");
a_coupons_info=document.getElementById("coupons_info");
div_promotions=document.getElementById("div_promotions");
div_pop=document.getElementById("map_pop");
a_span_pay=document.getElementById("span_pay");

div_pop_pay=document.getElementById("smxcPopPay");
},
// 添加历史地址列表
draw_position_history:function(e){
stopPro(e);
var value=input_search.value;
xcHistory="";

if(value.length==0)
{	
if("carWashHistory" in session)
{
console.log("缓存_历史地址");
mainObj.outerHTML.carWashHistoryHtml(session.carWashHistory);
}
else{
console.log("历史地址");
$.ajax({
method:"post",
url:host+"/addrs ",
data:"userId="+userId+"&limit=10&sort=lastWashTime&form_submit="+input_form_submit.value+"&formhash="+input_form_hash.value,
type:"json",
headers:{"Content-Type":"application/x-www-form-urlencoded"},
onSuccess:function(data){
session.carWashHistory=data;
mainObj.outerHTML.carWashHistoryHtml(data);
}
});
}
}
else{
mainObj.draw_gd_position(e);
}
},
// 添加高德联想列表
draw_gd_position:function(e){
var keyWord=input_search.value
if(keyWord.length>0)
{
car_position_head.style["display"]="none";
gdMap.autoComplete(keyWord,function(status,data){
if(status=="complete")
{
var resultStr = "";
var tipArr = data.tips;
if (tipArr&&tipArr.length>0) {                 
for (var i = 0; i < tipArr.length; i++) {
var name=tipArr[i].name.replace(keyWord,"<em>"+keyWord+"</em>");
resultStr+="<div class='mui-table-view mui-media-body xztcw_pop_layout_list'>";
resultStr+="<a href='javascript:;' data='"+tipArr[i].name+"' class='hover'>"+name+"</a>"
resultStr+="</div>";	
}
if(resultStr.length>0){
div_position_list.innerHTML=resultStr;
div_car_position.style["display"]="block";
div_pop.style["display"]="block";
}
}
else  {
div_position_list.innerHTML="";
div_car_position.style["display"]="none";
div_pop.style["display"]="none";
}
}
});
}
else{
div_position_list.innerHTML=xcHistory;
car_position_head.style["display"]="block";
}
stopPro(e);
},
// 清空地址输入列表
clear_key:function(e){
stopPro(e);
input_search.value="";
div_car_position.style["display"]="none";
},
// 移动地图时
moveMap:function(e){

window.clearTimeout(moveMapTimer);
moveMapTimer=window.setTimeout(function(){
pointNow=gdMap.containTolnglat({x:mmPoint.left,y:mmPoint.top});
session["latlng"]=pointNow;
//gdMap.panTo(pointNow.lng+","+pointNow.lat);
mainObj.getAddress(pointNow.lat,pointNow.lng);
div_pop_pay.style["display"]="none";
},500);

},
// 获取地图中心地址
getAddress:function(lat,lng){
gdMap.getAddress(lat,lng,function(data){
if(data.state==1){
input_search.value=data.address.regeocode.formattedAddress;
}
});
},
// 获取预估价格
getEstimatePrice:function(){
document.getElementById("payPrice").innerHTML="";
var estimateTimeValue="";
try{
estimateTimeValue=estimateTime.getElementsByTagName("span")[0].innerHTML;
}
catch(e){

}
var smfw_tab_sliders=div_fw_list_content.getElementsByClassName("active");
var url=host+"/estimatePrice";
var goods=[];
var amount=0;
for(var i=0;i<smfw_tab_sliders.length;i++){
var product=smfw_tab_sliders[i].info;
eval("var jsonValue = "+product); 
var obj={};
obj.goodsId=jsonValue.id;
obj.goodsName=jsonValue.name;
obj.goodsNum=1;
obj.goodsPrice=jsonValue.price;
amount+=parseFloat(jsonValue.price);
goods.push(obj);
}
var pays=mainObj.getCoupons();


var postStr={city:cityNow,
 userId:userId,
 source:"E洗车",
 platfrom:"0",
 amount:amount,
 carId:carId,
 detailAddress:address,
 carAddress:address,
 discountAmount:cutprice,
 estimateTime:estimateTimeStamp,
 lat:pointNow.lat,
 lng:pointNow.lng,
 goods:JSON.stringify(goods),
 pay:JSON.stringify(pays),
 payType:1,
 mobile:mobile
}
$.post(url,postStr,function(data){
if(data&&data.code==0){
estimatePriceStamp=data.data.price?data.data.price:"";
if(data.data.price){
var dk_price=amount-parseFloat(data.data.price);	
if(dk_price){
var coupons_i=a_coupons_info.innerHTML;
var reg=new RegExp("^([^<]*)(<.*>)$");
if(reg.test(coupons_i)){
dk_info=RegExp.$1+"抵扣"+dk_price+"元"+RegExp.$2;
a_coupons_info.innerHTML=dk_info;
}
}
document.getElementById("payPrice").innerHTML="应付款：￥"+data.data.price;
}
else{
document.getElementById("payPrice").innerHTML="计算价格失败";	
}



}
loading(false,"");
},"json");


},
// 获取预估时间
getEstimateTime:function(isReload){

h_estimateTime.innerHTML=""
if("estimateTime" in session &&isReload)
{
console.log("缓存_预估时间");
mainObj.outerHTML.estimateTimeHtml(session.estimateTime);
}
else{
console.log("获取预估时间");
var productId="";
var products_select=fw_list_content.getElementsByClassName("active");
var productsArr=[];
for(var i=0;i<products_select.length;i++)
{
//productId+=products_select[i].attributes["value"].nodeValue+",";
var info=products_select[i].info;
var d=JSON.parse(info);
var p={productid:d.id,manhaurInMiutes:d.manhaurInMiutes};
productsArr.push(p);
}
if(productsArr.length>0)
{
var url=host+"/estimateTime";
var data={products:JSON.stringify(productsArr),lat:pointNow.lat,lng:pointNow.lng,workno:workno};
console.log(data);
$.ajax({
url:url,
type:"post",
data:data,
dataType:"json",
success:function(data){
session.estimateTime=data;
mainObj.outerHTML.estimateTimeHtml(data);
}
})
}
else{
session.estimateTime="";
}
}	
},
// 输出产品促销活动信息 
draw_product_promotions:function(isReload){
div_promotions.innerHTML="";
var productId="";
var products_select=fw_list_content.getElementsByClassName("active");
for(var i=0;i<products_select.length;i++)
{
productId+=products_select[i].value+",";
}
if(productId.length>0)
{
productId=productId.substr(0,productId.length-1);
if("promotions" in session && isReload)
{	
console.log("缓存_促销活动信息");
mainObj.outerHTML.promotionsHtml(session.promotions,isReload);
}
else{
console.log("促销活动信息");

var url=host+"/promotions";
//var data="userId="+userId+"&city="+cityNow+"&products="+productId+"&lat="+pointNow.lat+"&lng="+pointNow.lng+"&form_submit="+input_form_submit.value+"&formhash="+input_form_hash.value;
var data={userId:userId,city:cityNow,products:productId,lat:pointNow.lat,lng:pointNow.lng};
$.post(url,data,function(data){
session.promotions=data;
mainObj.outerHTML.promotionsHtml(data);
},"json")
}
}
},
// 输出卡券信息
draw_coupons:function(isReload){
var productsArr=[];
var products_select=fw_list_content.getElementsByClassName("active");
for(var i=0;i<products_select.length;i++)
{
productsArr.push({productId:products_select[i].value});
}
if("coupons" in session && isReload)
{
console.log("缓存_卡券列表");
mainObj.outerHTML.couponsHtml(session.coupons);
}
else{
console.log("获取卡券列表");
var url=host+"/coupons";
var dataStr={userId:userId,city:cityNow.substr(0,2),products:JSON.stringify(productsArr),type:2};
$.post(url,dataStr,function(data){
session.coupons=data;
mainObj.outerHTML.couponsHtml(data);
},"json");
}
},
// 地图加载完成后的回调
cb:function (){					
input_search.addEventListener("input",mainObj.draw_gd_position,false);
if(session.latlng)
{
console.log("缓存_经纬度");
gdMap.panTo(session.latlng.lng+","+session.latlng.lat);
}

pointNow=gdMap.containTolnglat({x:mmPoint.left,y:mmPoint.top});
session["latlng"]=pointNow;
mainObj.getCarInfo();

mainObj.getAddress(pointNow.lat,pointNow.lng);


var workerPhone=session["workerPhone"];

if(workerPhone){
$("#work_name").html(session["workerName"]);
$("#input_leader_phone").val(workerPhone);
}


map1.addEventListener("touchend",mainObj.moveMap,false);					// 拖动地图
//input_search.addEventListener("click",mainObj.draw_position_history,false); // 搜索框获得焦点
img_clear_keyWords.addEventListener("touchend",mainObj.clear_key,false);	// 清除搜索框
map_pop.addEventListener("touchend",function(){
div_car_position.style["display"]="none";
map_pop.style["display"]="none";
},false);
// 开通区域服务
document.getElementById("a_open_area").addEventListener("touchend",function(){
mainObj.openArea();
},false);

// 洗车队长按钮
$("#div_leader").on("click",function(){
var status=$("#div_leader_phone").attr("status");
if(status=="short"){
$("#div_leader_phone").attr("status","long");
$("#div_leader_phone").css("width","280px");
$("#div_leader_keyboard").show();
}
else{
$("#div_leader_phone").attr("status","short");
$("#div_leader_phone").css("width","52px");	
$("#div_leader_keyboard").hide();
}

});
$("#input_leader_phone").on("touchend",function(e){
$("#div_leader_keyboard").show();
e.stopPropagation();
});
$("#ul_leader_keyboard").on("touchend",function(e){
var input_phone=$("#input_leader_phone");
var value=input_phone.val();
var target=e.target;

// 点击数字键盘时
if(target.nodeName.toUpperCase()=="LI"&&target.innerHTML.length==1){

if(value.length>=11)
return;
var phone_number=value+target.innerHTML;
input_phone.val(phone_number);

if(phone_number.length==11){
$.post(host+"/getWorker",{phone:phone_number},function(data){
if(data.code==0){
var workName=data.data.WashTurnerName.replace(/\(.*\)|\（.*\）/,"");
$("#work_name").html(workName);
$("#work_name").attr("workno",data.data.WashTurnerCode);

session["workerNo"]=data.data.WashTurnerCode;
session["workerName"]=workName;
session["workerPhone"]=phone_number;

var worker={};
worker.workerNo=data.data.WashTurnerCode;
worker.workerName=workName;
worker.workerPhone=phone_number;
//session.worker=worker;

}
else{
$("#work_name").html("无此洗车工");
$("#work_name").attr("workno","");

session["workerNo"]="";
session["workerName"]="无此洗车工";
session["workerPhone"]=phone_number;


var worker={};
worker.workerNo="";
worker.workerName="无此洗车工";
worker.workerPhone=phone_number;
//session.worker=worker;

}
},"json");
}
else{
$("#work_name").html("");
$("#work_name").attr("workno","");

session["workerNo"]="";
session["workerName"]="";
session["workerPhone"]=phone_number;

var worker={};
worker.workerNo="";
worker.workerName="";
worker.workerPhone=phone_number;
//session.worker=worker;

}
}
// 点击确定按钮
else if(target.innerHTML.length==2){
$("#div_leader_phone").attr("status","short");
$("#div_leader_phone").css("width","52px");	
$("#div_leader_keyboard").hide();
}
// 点击退格按钮
else if(target.nodeName.toUpperCase()=="IMG"||target.innerHTML.length>5){

if(value.length>=1){
var new_phone=value.substr(0,value.length-1);
input_phone.val(new_phone);	

$("#work_name").attr("workno","");
$("#work_name").html("");

session["workerNo"]="";
session["workerName"]="";
session["workerPhone"]=new_phone;

var worker={};
worker.workerNo="";
worker.workerName="";
worker.workerPhone=new_phone;
//session.worker=worker;

}
}	
console.log(phone_number);
e.stopPropagation();
e.preventDefault();
});
div_car_position.addEventListener("click",function(e){						// 点击停车位置
stopPro(e);
loading(true,"");
var target=getParentNode(e.target,"a");
if(target.nodeName.toUpperCase()=="A" && target.innerHTML!="洗车历史")
{
div_zwkt_pop.style["display"]="none";
this.style["display"]="none";
div_pop.style["display"]="none";
var address=target.attributes["data"].nodeValue;
input_search.value=address;

gdMap.placeSearch(address,mainObj.setMapCenter);
}
},false);
},
// 获取车辆信息
getCarInfo:function(){			
if("carInfo" in session)
{	
console.log("缓存_车辆信息");
mainObj.outerHTML.carInfoHtml(session.carInfo);
}
else{
console.log("车辆信息");
var url=host+"/defaultCar";
postStr={userId:userId};
$.post(url,postStr,function(data){
session.carInfo=data;
mainObj.outerHTML.carInfoHtml(data);
},"json");
}	
},
// 设置地图中心点
setMapCenter:function(data){
var poiArr = data.poiList.pois;
if(poiArr.length>0)
{
gdMap.panTo(poiArr[0].location.toString());
pointNow={lat:poiArr[0].location.lat,lng:poiArr[0].location.lng};
}
},
// 开通区域服务
openArea:function(){
var url=host+"/openArea";
var data={userId:userId,
  lat:pointNow.lat,
  lng:pointNow.lng,
  city:cityNow}
$.post(url,data,function(data){
var d=data;
},"json");
},
// 提交订单
submitOrder:function(){
mainObj.loading(true,"");
if(orderInfo){
mainObj.outerHTML.payHtml(JSON.parse(orderInfo.data));
return;
}	

confirm("确认下单？",function(){
var url=host+"/suborder";

var smfw_tab_sliders=div_fw_list_content.getElementsByClassName("active");
var goods = $('#service').val();
var data={
 carId:carId,
 address:input_search.value,
 lat:pointNow.lat,
 lng:pointNow.lng,
 goods:goods
}
if(!carId){
alertNew("请选择车辆",2000,"/Public/Home/images/icon-1.png");
mainObj.loading(false,"");
return ;
}
if(!goods){
mainObj.loading(false,"");
alertNew("请选择产品",2000,"/Public/Home/images/icon-1.png");
return ;
}
mainObj.setSession(function(){
$.post(url,data,function(data){
    if(data.status == 'y'){
        mainObj.wxPay(data);
    }else{
        alertNew(data.msg,2000,"/Public/Home/images/icon-1.png");
    }
},"json");
});	

},function(){
mainObj.loading(false,"");
});


},
wxPay:function(data){
WeixinJSBridge.invoke('getBrandWCPayRequest',{
"appId":data.appId,
"package":data.package,
"timeStamp":data.timeStamp,
"nonceStr":data.nonceStr,
"paySign":data.paySign,
"signType":data.signType
},function(res){

WeixinJSBridge.log(res.err_msg);
if(res.err_msg=="get_brand_wcpay_request:ok"){
alertNew("成功支付",2000,"/Public/Home/images/icon-1.png");
}else{
alertNew(res.err_msg,50000,"/Public/Home/images/icon-1.png");
}
});

},
// 获取选中卡券
getCoupons:function(){
var pays=[];
var coupons=session.coupons;

if(coupons&&coupons.data&&coupons.data.coupons){
var couponArr=coupons.data.coupons;
for(var i=0;i<couponArr.length;i++){
if(couponArr[i].selected=="1")
{
var cp={};
cp.cardNo=couponArr[i].id;
cp.payAmount=couponArr[i].amout;
cp.payType=5;
cp.serialNum="";
pays.push(cp);
break;
}
}
}
if(pays.length==0&&coupons&&coupons.data&&coupons.data.cards){
var cardsArr=coupons.data.cards;
for(var i=0;i<cardsArr.length;i++){
if(cardsArr[i].card){
var cards=cardsArr[i].card;
for(var j=0;j<cards.length;j++){
if(cards[j].selected=="1")
{
var cp={};
cp.cardNo=cards[j].id;
cp.payAmount=cards[j].amout;
cp.payType=6;
cp.serialNum="";
pays.push(cp);
}
}

}
}
}
var jf="0.00";
if(jf){
if(session.useIntegral=="1")
{
var jf={payType:"1",payAmount:jf};
pays.push(jf);
}
}

return pays;
},
// 绑定列表事件
bind_product_list:function(e){

/*
// 选择优惠券
wallet.addEventListener("touchend",function(){
loading(true,"");
mainObj.setSession(function(){

loading(false,"");
location.href="../../smwash.php?do=kbxz";
});

},false);
*/
// 添加车辆
smfw_layout.addEventListener("touchend",function(){
loading(true,"");
var ci=session.carInfo;
mainObj.setSession(function(){
loading(false,"");
if(ci.data)
{
location.href="../../smwash.php?do=qclb";
}
else{
location.href="../../smwash.php?do=add_car";
}
});
},false);
// 支付按钮
a_span_pay.addEventListener("click",function(){

if(a_span_pay.getAttribute("readonly")){
return ;	
}
else{
if(orderInfo){
div_pop_pay.style["display"]="block";
}
else{
mainObj.submitOrder();
}
}
stopPro(e);
});


// 继续下单
div_pop_status_btn.addEventListener("touchend",function(e){
div_smfw_layout.style["display"]="block";
div_pop_status.style["display"]="none";	
mainObj.loading(false,"");
});
// 百付宝支付
document.getElementById("li_zf_4").addEventListener("touchend",function(e){
mainObj.pay("bfb");
stopPro(e);
},false);

// 取消支付
document.getElementById("li_zf_-2").addEventListener("click",function(){
div_pop_pay.style["display"]="none";
stopPro(e);
},false);
// 微信支付
document.getElementById("li_zf_3").addEventListener("touchend",function(e){
mainObj.pay("wx");
stopPro(e);
},false);
// 支付宝支付
document.getElementById("li_zf_2").addEventListener("touchend",function(e){
mainObj.pay("zfb");
stopPro(e);
},false);
},
setSession:function(callback){
var url=host+"/setSession";
//session=JSON.stringify(session);
var sessionStr=session?mainObj.sessionUtil(session,"json"):"";
var data={key:"dataCache",value:sessionStr};
$.post(url,data,function(data){
if(data.code==0&&typeof callback=="function")
{
callback();
}
},"json");
},
getSession:function(callback){
var url=host+"/getSession";
var data={key:"dataCache"};
$.post(url,data,function(data){
if(data&&data.code==0&&data.data&&typeof callback=="function")
{
callback(mainObj.sessionUtil(data.data,"object"));
}
else if(typeof callback=="function")
{
callback();
}
},"json");
},
sessionUtil:function(session,action){
for(var key in session)
{
if(action=="json"){ // session属性转json
session[key]=JSON.stringify(session[key]);
}
else{		  //session属性转对象
session[key]=JSON.parse(session[key]);
}
}
return session;
},
loading:function(type,html){
if(type){
div_load_pop.style["display"]="block";
if(html)
div_load_pop.innerHTML=html;
}
else{
div_load_pop.style["display"]="none";
}

},
outerHTML:{
carWashHistoryHtml:function(data){
if(data.code==0)
{
div_car_position.style["display"]="block";
div_pop.style["display"]="block";
car_position_head.style["display"]="block";
}
else{
div_car_position.style["display"]="none";
div_pop.style["display"]="none";
car_position_head.style["display"]="block";
}
},
carInfoHtml:function(data){
if(data&&data.code!=-1&&data.data){
carId=data.data.id?data.data.id:"";	//记录默认车辆id
if(data.data.brand){
var brand=data.data.brand?data.data.brand:" ";
var color=data.data.color?data.data.color:" ";
var number=data.data.number?data.data.number:" ";
var html="<span>&nbsp;"+brand+"</span>";
html+="<span>&nbsp;"+color+"</span>";
html+="<span>&nbsp;"+number+"</span>";
html+="<i class='mui-icon mui-icon-forward'></i>";			
document.getElementById("car_info").innerHTML=html;
}
else{
document.getElementById("car_info").innerHTML="<span>&nbsp;暂无车辆，请设置当前车辆信息</span><i class='mui-icon mui-icon-forward'></i>";
}
}
else{
document.getElementById("car_info").innerHTML="<span>&nbsp;暂无车辆，请设置当前车辆信息</span><i class='mui-icon mui-icon-forward'></i>";
}
},
productsHtml:function(data,isReload){
div_fw_list_content.innerHTML="";

if(data!=null){
if(data.data&&data.data.products){
div_fw_list_content.style.width=data.data.products.length*100+"px";
var html="";
var oFrag = document.createDocumentFragment();
var exclusiveArr=[];
var divAArr=[];
for(var i=0;i<data.data.products.length;i++){

var enabled=data.data.products[i].enabled;

var img={};
img["selected"]=data.data.products[i].productImg;
img["unSelected"]=data.data.products[i].unProductImg;

var divImg=document.createElement("div");
divImg.className="img";
divImg.img=img;

if(data.data.products[i].isDefault==1)
{
var cla="active";
exclusiveArr=exclusiveArr.concat(data.data.products[i].exclusiveProducts);
productSelectId.push("id"+data.data.products[i].id);
divImg.style["background-image"]="url("+img["selected"]+")";
}
else{
var cla="";
divImg.style["background-image"]="url("+img["unSelected"]+")";
}




var spanPrice=document.createElement("span");
spanPrice.innerHTML=data.data.products[i].displayName+"<br>"+data.data.products[i].price+"元";
var divA=document.createElement("a");
divA.id="id"+data.data.products[i].id;
divA.href="javascript:;";
divA.exclusiveNum=0;
divA.index=i;
divA.enabled=enabled;
divA.exclusiveArr=data.data.products[i].exclusiveProducts;
divA.info=JSON.stringify(data.data.products[i]);
divA.value=data.data.products[i].id;
divA.className=cla;
divA.appendChild(divImg);
divA.appendChild(spanPrice);
divAArr.push(divA);
var divSlider=document.createElement("div");
divSlider.className="smfw_tab_slider";
divSlider.appendChild(divA);

oFrag.appendChild(divSlider);

}
if(divAArr&&exclusiveArr){
for(var i=0;i<exclusiveArr.length;i++)
{
var id="id"+exclusiveArr[i];
for(var j=0;j<divAArr.length;j++)
{
if(divAArr[j].id==id){
divAArr[j].exclusiveNum++;
}
}
}
}

//div_fw_list_content.innerHTML=html;	
div_fw_list_content.appendChild(oFrag); 
mainObj.draw_product_promotions(isReload);
if(!data.data.store)
mainObj.getEstimateTime(isReload);
}

if(data.data&&data.data.store){
a_span_pay.setAttribute("readonly","readonly");
//div_promotions.innerHTML="";
h_estimateTime.innerHTML="当前区域未开通上门洗车服务";
}
}
},
promotionsHtml:function(data,productId,isReload){
if(data!=null&&data.code==0){	
if(data.data.promotions)
{
cutprice=data.data.total.cutprice;
div_promotions.innerHTML="<span>优惠</span><p value="+data.data.promotions.selected[0].id+">"+data.data.promotions.selected[0].title+"</p>";
//mainObj.draw_coupons(productId,data.data.promotions.selected[0].id)
}
else{
//div_promotions.innerHTML="<p>暂无优惠信息</p>";
//mainObj.draw_coupons(productId,0);
}
}
else{
div_promotions.innerHTML="";
//mainObj.draw_coupons(productId,0);
}
},
couponsHtml:function(data){
if(data&&data.code==0)
{
a_coupons_info.innerHTML="";
var html="";
var htmlCK="";
for(var i=0;i<data.data.coupons.length;i++)
{
if(data.data.coupons[i].selected.toString()=="1")
{
html="使用优惠券";
break;
}
}
for(var j=0;j<data.data.cards.length;j++)
{
var br=0;
var card=data.data.cards[j].card;
for(var k=0;k<card.length;k++)
{
if(card[k].selected.toString()=="1" && card[k].type.toString()=="2")
{
html="使用优惠券";
br=1;
break;
}
else if(card[k].selected.toString()=="1" && card[k].type.toString()=="3")
{
htmlCK="使用次卡";
br=1;
break;
}
// if(br)
// break;
}
}
if(html){
html+=htmlCK?("."+htmlCK):"";
}
else{
html=htmlCK?htmlCK:"";
}
if(session.useIntegral=="1"){
/*if(html.length==0){
html="使用积分";	
}*/
html+=html?".积分":"使用积分";
}
/*if(html.length>0)
html=html.substr(0,html.length-1);*/
html+="<i class='mui-icon mui-icon-forward'></i>";
a_coupons_info.innerHTML=html;
}
mainObj.getEstimatePrice();
},
estimateTimeHtml:function(data){
a_span_pay.removeAttribute("readonly");
if(data&&data.code==0){
div_pop_status.style["display"]="none";
div_smfw_layout.style["display"]="block";
if(data.excep==undefined||data.excep==""){

estimateTimeStamp=data.data.timeStamp;
h_estimateTime.innerHTML="&nbsp;预计<span>"+data.data.time+"</span>前完成洗车";
}
else if(data.excep=="1"){
document.getElementById("go_order").innerHTML=decodeURIComponent(data.message);
if(isAlert==0){
div_pop_status.style["display"]="block";
isAlert=1;
}
h_estimateTime.innerHTML="&nbsp;预计<span>"+data.data.time+"</span>前完成洗车";
}
else if(data.excep=="0"){
a_span_pay.setAttribute("readonly","readonly");
h_estimateTime.innerHTML=decodeURIComponent(data.message);

}

}
},
}
};
mainObj.init();
})();
</script>
</html>