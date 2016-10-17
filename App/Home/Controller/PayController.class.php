<?php
namespace Home\Controller;

use Think\controller;
class PayController extends Controller{
    function payback(){
        $userid = $_GET['userid'];
        $order_sn = $_GET['out_trade_no'];
        file_put_contents('1.txt', $order_sn);
        if(intval($_GET['total_fee']) && $_GET['result_code'] == 'SUCCESS' && $_GET['userid']) {
            $data = M('vip_order')->where(array('order_sn'=>$order_sn, 'user_id'=>$userid))->find();
            if( $data['status'] == 0 ){
                //查询之前会员的类型
                $user = M('member')->where(array('id'=>$userid))->find();
                if( $data['type'] == $user['vip_type'] ){
                    exit('会员类型一致');
                }
                $time = $data['addtime'];
                if( $user['vip_type'] > 0 ){ //会员升级降级
                    $old_order = M('vip_order')->where(array('addtime'=>$user['vip_start'], 'type'=>$user['vip_type']))->find();
                    //计算时间
                    $day = ($time - $user['vip_start'])/(3600*24);
                    //查询价格
                    $sy_money = $old_order['money'] - (365/$old_order['money'])*$day;
                    $user_data = array('vip'=>1, 'vip_type'=>$data['type'], 'vip_start'=>$time, 'vip_time'=>$time+3600*24*365, 'money'=>$sy_money);
                }else{
                    $user_data = array('vip'=>1, 'vip_type'=>$data['type'], 'vip_start'=>$time, 'vip_time'=>$time+3600*24*365);
                }
                M('vip_order')->where(array('id'=>$data['id']))->save(array('order_status'=>2));
                M('member')->where(array('id'=>$userid))->save($user_data);
            }
        }else{
            exit('付款失败');
        }
        exit;
    }
    
    function goodsback(){
        $userid = $_GET['userid'];
        $order_sn = $_GET['out_trade_no'];
        file_put_contents('1.txt', $order_sn);
        if(intval($_GET['total_fee']) && $_GET['result_code'] == 'SUCCESS' && $_GET['userid']) {
            $data = M('goods_order')->where(array('order_sn'=>$order_sn, 'user_id'=>$userid))->find();
            if( $data['status'] == 0 ){
                M('goods_order')->where(array('id'=>$data['id']))->save(array('order_status'=>2));
            }
        }else{
            exit('付款失败');
        }
        exit;
    }
    
    /*
    function payback(){
        $userid = 1;
        $order_sn = 1474957844;
//        file_put_contents('1.txt', $order_sn);
//        if(intval($_GET['total_fee']) && $_GET['result_code'] == 'SUCCESS' && $_GET['userid']) {
            $data = M('vip_order')->where(array('order_sn'=>$order_sn, 'user_id'=>$userid))->find();
            if( $data['status'] == 0 ){
                //查询之前会员的类型
                $user = M('member')->where(array('id'=>$userid))->find();
                if( $data['type'] == $user['vip_type'] ){
                    exit('会员类型一致');
                }
                $time = $data['addtime'];
                if( $user['vip_type'] > 0 ){ //会员升级降级
                    $old_order = M('vip_order')->where(array('addtime'=>$user['vip_start'], 'type'=>$user['vip_type']))->find();
                    //计算时间
                    $day = ceil(($time - $user['vip_start'])/(3600*24));
                    //查询价格
                    if( $day < 1 ){
                        $sy_money = $old_order['money'];
                    }elseif($day >= 365){
                        $sy_money = 0;
                    }else{
                        $sy_money = floor($old_order['money'] - ($old_order['money']/365)*$day);
                    }
                    $user_data = array('vip'=>1, 'vip_type'=>$data['type'], 'vip_start'=>$time, 'vip_time'=>$time+3600*24*365, 'money'=>$sy_money+$user['money']);
                }else{
                    $user_data = array('vip'=>1, 'vip_type'=>$data['type'], 'vip_start'=>$time, 'vip_time'=>$time+3600*24*365);
                }
                M('vip_order')->where(array('id'=>$data['id']))->save(array('order_status'=>2));
                M('member')->where(array('id'=>$userid))->save($user_data);
            }
//        }else{
//            exit('付款失败');
//        }
//        exit;
    }
    */
}