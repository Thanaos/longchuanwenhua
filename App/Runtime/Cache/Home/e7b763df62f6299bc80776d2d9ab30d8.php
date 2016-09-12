<?php if (!defined('THINK_PATH')) exit();?><script>
    WeixinJSBridge.invoke('getBrandWCPayRequest',{
        "appId":"<?php echo ($jsApiParameters["appId"]); ?>",
    "package":"<?php echo ($jsApiParameters["package"]); ?>",
    "timeStamp":"<?php echo ($jsApiParameters["timeStamp"]); ?>",
    "nonceStr":"<?php echo ($jsApiParameters["nonceStr"]); ?>",
    "paySign":"<?php echo ($jsApiParameters["paySign"]); ?>",
    "signType":"<?php echo ($jsApiParameters["signType"]); ?>"
},function(res){

WeixinJSBridge.log(res.err_msg);
if(res.err_msg=="get_brand_wcpay_request:ok"){
alert("成功支付");
}else{
alert(res.err_msg);
}
});
</script>