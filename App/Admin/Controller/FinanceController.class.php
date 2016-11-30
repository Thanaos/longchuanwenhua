<?php
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends AdminController {
    
    function income(){
        if( $this->act == 'list' ){            //查询会员列表
            if( IS_POST ){
                $start = strtotime(I('start_time'));
                $end = strtotime(I('end_time'));
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $where = array('o.order_status'=>2);
            if( $start > 0 && $end > 0 ){
                $where['o.addtime'] = array('between', array($start, $end));
            }
            $service = M('vip_order as o');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on o.user_id = m.id', 'left')->where($where)->page($p, $max)->field('o.*,m.name,m.birthday,m.idCard,m.mobile')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $count_money = $service->where($where)->sum('o.money');
            $this->assign('count_money', $count_money);
            $this->assign('count_member', $count);
            $this->assign('where', array('start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('income_list');
        }
    }
    
    function order(){
        if( $this->act == 'list' ){            //查询会员列表
            if( IS_POST ){
                $start = strtotime(I('start_time'));
                $end = strtotime(I('end_time'));
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $where = array('o.order_status'=>2);
            if( $start > 0 && $end > 0 ){
                $where['o.addtime'] = array('between', array($start, $end));
            }
            $service = M('goods_order as o');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on o.user_id = m.id', 'left')->where($where)->page($p, $max)->field('o.*,m.name,m.mobile')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $count_money = $service->where($where)->sum('o.money');
            $this->assign('count_money', $count_money);
            $this->assign('count_member', $count);
            $this->assign('where', array('start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('order_list');
        }elseif( $this->act == 'm_list' ){            //查询会员列表
            if( IS_POST ){
                $order_sn = I('post.order_sn');
                $name = I('post.name');
                $idcard = I('post.idcard');
                $status = I('post.status');
                $start = strtotime(I('start_time'));
                $end = strtotime(I('end_time'));
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            if( $start > 0 && $end > 0 ){
                $where['o.addtime'] = array('between', array($start, $end));
            }
            if( !empty($order_sn) ){
               $where['o.order_sn'] = array('like', '%'.$order_sn.'%');
            }
            if( !empty($name) ){
                $where['name'] = array('like', '%'.$name.'%');
            }
            if( !empty($idcard) ){
                $where['idcard'] = array('like', '%'.$idcard.'%');
            }
            if( $status > 0 ){
                if( $status == 1 ){
                    $where['order_status'] = 0;
                }else{
                    $where['order_status'] = $status;
                }
            }
            $service = M('goods_order as o');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on o.user_id = m.id', 'left')->where($where)->page($p, $max)->field('o.*,m.name,m.mobile,m.idcard')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $count_money = $service->where($where)->sum('o.money');
            $this->assign('count_money', $count_money);
            $this->assign('count_member', $count);
            $this->assign('where', array('order_sn'=>$order_sn, 'name'=>$name, 'idcard'=>$idcard, 'status'=>$status, 'start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('m_list');
        }elseif( $this->act == 'sub_down' ){
            if( IS_POST && IS_AJAX ){
                if( !($this->admin_role == 'all' || $this->admin_role == 4) ){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'没有权限'));
                }
                $id = I('post.id');
                $status = I('post.status');
                if( $id < 0 || $status < 0 ){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'参数不正确'));
                }
                if( $status == 2 ){
                    //订单否付款
                    $good_data = M('goods_order')->where(array('id'=>$id))->find();
                    if( $good_data['order_status'] != 2 ){
                        $this->ajaxReturn(array('status'=>'n', 'msg'=>'只能操作已付款订单！'));
                    }
                    $insert = M('goods_order')->where(array('id'=>$id))->save(array('order_status'=>4));
                }
                if( $insert ){
                    $this->ajaxReturn(array('status'=>'y', 'msg'=>'操作成功'));
                }
            }
        }elseif( $this->act == 'refund' ){
            
            if( IS_POST ){
                $status = I('post.status');
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $service = M('refund as r');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_goods_order as o on o.id = r.order_id')->join('tp_member as m on o.user_id = m.id', 'left')->where($where)->page($p, $max)->field('r.*,o.*,m.name,m.mobile,m.idcard,r.id as rid,r.status as r_stauts,r.addtime as t_addtime')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('where', array('start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('refund_list');
        }elseif( $this->act == 'refund_detail' ){

            
            $id = I('get.id');
            if( $id < 0 ){
                $this->error('参数不正确！');
            }
            $data = M('refund as r')->join('tp_goods_order as o on o.id = r.order_id')->join('tp_member as m on o.user_id = m.id')->where(array('r.id'=>$id))->field('o.*,r.order_id,r.remark,r.status,r.id as rid,m.name,m.mobile,m.idcard')->find();
            $this->assign('data', $data);
            //查询审核记录
            $check_list = M('check_log as c')->where(array('c.mod_id'=>$data['rid'], 'c.type'=>3))->join('tp_user as u on u.id=c.admin_id')->order('addtime asc')->field('c.*,u.name,u.group_id')->select();
            $this->assign('check_list', $check_list);
            $this->display('refund_detail');
            
        }elseif( $this->act == 'check_log' ){
            if( IS_AJAX && IS_POST ){
                $type = I('post.type');
                $status = I('post.status');
                $remark = I('post.remark');
                $id = I('post.id');
                //检查权限
                if( $this->admin['group_id'] == 4 ){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'没有权限'));
                }
                if(M('check_log')->where(array('type'=>$type, 'mod_id'=>$id, 'admin_id'=>$this->admin['id']))->find()){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'您已经审核过了'));
                }
                $yi_count = M('check_log')->where(array('type'=>$type, 'mod_id'=>$id))->count();
                if( $yi_count >=3 ){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'当前已经有三个人审核过，不需要审核'));
                }
                if(M('check_log')->where(array('type'=>$type, 'mod_id'=>$id, 'admin_group'=>$this->admin_role))->find()){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'已经有相同权限的管理员审核过，无法继续审核！ '));
                }
                //插入数据
                $data = array('admin_id'=>$this->admin['id'], 'admin_group'=>$this->admin['group_id'], 'type'=>$type, 'mod_id'=>$id, 'status'=>$status, 'remark'=>$remark, 'addtime'=>time());
                $insert = M('check_log')->add($data);
                $check_db = M('refund');
                $mod_data = $check_db->where(array('id'=>$id))->find();
                $user_data = M('member')->where(array('id'=>$mod_data['user_id']))->find();
                $w_title = '审核进度';
                //添加操作次数
                if( $status == 1 && $mod_data['times'] != -1 ){
                    //修改订单状态
                    M('goods_order')->where(array('id'=>$mod_data['order_id'], 'order_status'=>3))->save(array('order_status'=>2));
                    $check_db->where(array('id'=>$id))->save(array('times'=>-1));
                    $w_description = '亲爱的'.$user_data['name']."您好！您的退款申请：未通过！"."\r\n".$user_data['remark'];
                    $post_msg = '{
                    "touser":"'.$user_data['openid'].'",
                    "msgtype":"news",
                    "news":{
                    "articles": [
                        {
                            "title":"'.$w_title.'",
                            "description":"'.$w_description.'",
                        }
                    ]
                    }
                }';
                }elseif($status == 2 && $mod_data['times'] != -1){
                    $check_db->where(array('id'=>$id))->save(array('times'=>$mod_data['times']+1, 'check_time'=>time()+3600*24));
                }
                if( $mod_data['times'] == 2 ){
    
                    $order = M('goods_order')->where(array('id'=>$mod_data['order_id'], 'order_status'=>3))->find();
                    if( empty($order) ){
                        $this->ajaxReturn(array('status'=>'n', 'msg'=>'订单不存在'));
                    }
    
                    M('goods_order')->where(array('id'=>$order['id']))->save(array('order_status'=>5));
                    Vendor('WxPayPubHelperGood.WxPayPubHelper');
                    $Refund = new \Refund_pub();
                    $Refund->setParameter('out_trade_no', $order['order_sn']);
                    $Refund->setParameter('out_refund_no', $order['order_sn']);
                    $Refund->setParameter('total_fee', $order['money']);
                    $Refund->setParameter('refund_fee', $order['money']);;
                    $Refund->setParameter('op_user_id', '1327993501');
                    $result = $Refund->getResult();
                    if( $result['return_code'] == 'SUCCESS' && $result['result_code'] == 'FAIL' && $result['err_code'] == 'NOTENOUGH' ){
                        $str = '订单已结算，账户余额不足，请手动退款';
                    }elseif($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
                        $str = '退款成功';
                    }elseif($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'FAIL'){
                        $str = '退款请手动退款';
                    }
                    M('refund')->where(array('id'=>$id))->save(array('refund_remark'=>$str));
    
                    $w_description = '亲爱的'.$user_data['name']."您好！您的退款申请：已通过！\r\n";
                    $w_url = $_SERVER['HTTP_HOST'].'/index.php/home/index/order_detail/id/'.$mod_data['order_id'].'.html';
                    $post_msg = '{
                    "touser":"'.$user_data['openid'].'",
                    "msgtype":"news",
                    "news":{
                    "articles": [
                            {
                                "title":"'.$w_title.'",
                                "description":"'.$w_description.'",
                                "url":"'.$w_url.'",
                            }
                                ]
                        }
                    }';
                }
                if( !empty($w_description) ){
                    $access_token = $this->access_token();
                    $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
                    $ret_json = $this->curl_grab_page($url, $post_msg);
                    $ret = json_decode($ret_json);
                    if($ret->errmsg != 'ok')
                    {
                        $access_token = $this->new_access_token();
                        $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token;
                        $ret_json = $this->curl_grab_page($url, $post_msg);
                        $ret = json_decode($ret_json);
                    }
                }
                if( $insert >0 ){
                    $this->ajaxReturn(array('status'=>'y', 'msg'=>'操作成功'));
                }else{
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'系统出错'));
                }
            }
        }
    }
    
    function doctor_list(){
        if( $this->act == 'list' ){            //查询会员列表
            if( IS_POST ){
                $start = strtotime(I('start_time'));
                $end = strtotime(I('end_time'));
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            if( $start > 0 && $end > 0 ){
                $where['o.addtime'] = array('between', array($start, $end));
            }
            $service = M('check');
            $list = $service->where($where)->group('doctor_bh')->order('count desc')->field('*, count(doctor_bh) as count')->select();
            $this->assign('where', array('start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('list', $list);
            $this->display('doctor_list');
        }
    }
    
    public function new_access_token()
    {
        $time = time();
        $ret = M('weixin_config')->where('id = 1')->find();
        $appid = $ret['appid'];
        $appsecret = $ret['secret'];
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $ret_json = $this->curl_get_contents($url);
        $ret = json_decode($ret_json);
        if($ret->access_token)
        {
            M('weixin_config')->where('id = 1')->save(array('access_token'=>$ret->access_token, 'dateline'=>$time));
        }
        return $ret->access_token;
    }
    
    public function access_token()
    {
        $ret = M('weixin_config')->where('id = 1')->find();
        $appid = $ret['appid'];
        $appsecret = $ret['secret'];
        $access_token = $ret['access_token'];
        $dateline = $ret['dateline'];
        $time = time();
        if(($time - $dateline) >= 7200)
        {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $ret_json = $this->curl_get_contents($url);
            $ret = json_decode($ret_json);
            if($ret->access_token)
            {
                M('weixin_config')->where('id = 1')->save(array('access_token'=>$ret->access_token, 'dateline'=>$time));
                return $ret->access_token;
            }
        }
        elseif(empty($access_token))
        {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $ret_json = $this->curl_get_contents($url);
            $ret = json_decode($ret_json);
            if($ret->access_token)
            {
                M('weixin_config')->where('id = 1')->save(array('access_token'=>$ret->access_token, 'dateline'=>$time));
                return $ret->access_token;
            }
        }
        else
        {
            return $access_token;
        }
    }
    
    public function curl_get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }
    public function curl_grab_page($url,$data,$proxy='',$proxystatus='',$ref_url='')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($proxystatus == 'true')
        {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        if(!empty($ref_url))
        {
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_REFERER, $ref_url);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        ob_start();
        return curl_exec ($ch);
        ob_end_clean();
        curl_close ($ch);
        unset($ch);
    }
    
    
    
}
