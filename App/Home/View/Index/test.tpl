<script>
    WeixinJSBridge.invoke('getBrandWCPayRequest',{
        "appId":"{$jsApiParameters.appId}",
    "package":"{$jsApiParameters.package}",
    "timeStamp":"{$jsApiParameters.timeStamp}",
    "nonceStr":"{$jsApiParameters.nonceStr}",
    "paySign":"{$jsApiParameters.paySign}",
    "signType":"{$jsApiParameters.signType}"
},function(res){

WeixinJSBridge.log(res.err_msg);
if(res.err_msg=="get_brand_wcpay_request:ok"){
alert("成功支付");
}else{
alert(res.err_msg);
}
});
</script>

