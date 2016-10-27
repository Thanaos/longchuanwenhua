$(function(){
    var set_error = function(_this){
        _this.removeClass('form-control');
        _this.addClass('form-control-error');
    }
    var set_success = function(_this){
        _this.addClass('form-control');
        _this.removeClass('form-control-error');
    }
    //文本框失去焦点后
    $('form :input').blur(function(){
         //验证手机
         if( $(this).is('#mobile') ){
            if( this.value == "" || ( this.value!="" && !/^1[3|4|5|7|8]\d{9}$/.test(this.value) ) ){
                set_error($(this));
            }else{
                set_success($(this));
            }
         }
        //验证身份证
        if( $(this).is('#idCard') ){
            if( this.value =="" || ( this.value!="" && !/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(this.value) ) ){
                set_error($(this));
            }else{
                set_success($(this));
            }
        }
         if( $(this).is('#name') || $(this).is('#age') || $(this).is('#birthday') ){
             if( this.value == "" ){
                 set_error($(this));
             }else{
                 set_success($(this));
             }
         }
    })

    
    //提交，最终验证。
     $('#submit').click(function(){
        $('form :input').trigger('blur');
        var _numError = $('.form-control-error').length;
        if(_numError){
            alert('请修改错误信息！');
            return false;
        }
     });
})
