<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    /****
     *微信支付回调
     ***/
    public function payback()
    {
        $out_trade_no = $_GET['out_trade_no'];
        $out_trade_no = '1441507392';
        $userid = $_GET['userid'];
        if(intval($_GET['total_fee']) && $_GET['result_code'] == 'SUCCESS' && $_GET['userid']) {
            $data = M('order')->where(array('user_id'=>$userid, 'order_sn'=>$out_trade_no))->find();
            if($data && $data['pay_status'] == 0){
                $str = strtotime(date('Y-m-d'));
                if(!$_SESSION[$str]){
                    $_SESSION[$str] = 1;
                }else{
                    $_SESSION[$str] += 1;
                }
                M('order')->where(array('id'=>$data['id']))->save(array('pay_status'=>2));
            } 
        }else{
			//exit('付款失败');
    }
        exit;
    }

}

