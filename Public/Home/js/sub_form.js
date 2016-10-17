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
         if( $(this).is('#zd') || $(this).is('#zd_doctor') || $(this).is('#zd_image') || $(this).is('bl_image') ){
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
            return false;
        }
     });
})
