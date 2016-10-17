<?php
namespace Admin\Controller;
use Think\Controller;

class MemberController extends AdminController{
    function __construct(){
        parent::__construct();
        $this->assign('sickid',C('SICKID'));
    }
    
    function member(){
        if( $this->act == 'list' ){
            $where = array();
            if( IS_POST ){
                $name = I('post.name') ? I('post.name') : '';
                $mobile = I('post.mobile') ? I('post.mobile') : '';
                $idCard = I('post.idCard') ? I('post.idCard') : '';
                if( $name ){
                    $where['name'] = $name;
                }
                if( $mobile ){
                    $where['mobile'] = $mobile;
                }
                if( $idCard ){
                    $where['idCard'] = $idCard;
                }
                
            }
            //查询会员列表
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $service = M('member');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->where($where)->page($p, $max)->select();
            foreach( $list as $k =>$v ){
                    if( !empty($v['bl_img']) ){
                        
                    $img_arr = explode(',', $v['bl_img']);
                    foreach( $img_arr as $key=>$val ){
                        if( $key == 0 ){
                            $img_str .= '"' . $val . '"';
                        }else{
                            $img_str .= ',"' . $val . '"';
                        }
                    }
                    $list[$k]['bl_img_arr'] = M('img')->where('server_id in ('.trim($img_str,',').')')->select();
                }else{
                    $list[$k]['bl_img_arr'] = array();
                }
            }
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('where', $where);
            $this->assign('show', $show);
            $this->assign('list', $list);
            
            $this->display('member_list');
        }
        
    }
    
    function subsidies(){
        if( $this->act == 'list' ){
            $where = array();
            if( IS_POST ){
                $name = I('post.name') ? I('post.name') : '';
                $mobile = I('post.mobile') ? I('post.mobile') : '';
                $idCard = I('post.idCard') ? I('post.idCard') : '';
                if( $name ){
                    $where['name'] = $name;
                }
                if( $mobile ){
                    $where['mobile'] = $mobile;
                }
                if( $idCard ){
                    $where['idCard'] = $idCard;
                }
                
            }
            //查询会员列表
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $service = M('subsidies as s');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on m.id = s.userid')->where($where)->page($p, $max)->field('s.*,m.*,s.id as sid')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('where', $where);
            $this->assign('show', $show);
            $this->assign('list', $list);
            
            $this->display('subsidies_list');
        }elseif($this->act=='buy'){
            $where = array();
            if( IS_POST ){
                $status = I('post.status') ? I('post.status') : '';
                if( $status < 4 ){
                    $where['s.status'] = $status;
                }
        
            }
            //查询会员列表
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $service = M('check as s');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on m.id = s.user_id')->where($where)->page($p, $max)->field('s.*,m.*,s.id as sid')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('where', array('status'=>$status));
            $this->assign('show', $show);
            $this->assign('list', $list);
    
            $this->display('check_list');
        }elseif( $this->act == 'yes' ){
            $id = I('post.id');
            $status = I('post.status');
            $remark = I('post.remark');
            if( $id < 0  ){
                $this->ajaxReturn(array('status'=>'n', 'msg'=>'参数不正确'));
            }
            if( $status != 1 && $status != 2 ){
                $this->ajaxReturn(array('status'=>'n', 'msg'=>'参数不正确'));
            }
            if( $status == 1 && empty($remark) ){
                $this->ajaxReturn(array('status'=>'n', 'msg'=>'请填写不通过原因！'));
            }
            M('check')->where(array('id'=>$id))->save(array('status'=>$status, 'checktime'=>time(), 'remark'=>$remark));
            $check_data = M('check')->where(array('id'=>$id))->find();
            $user_data = M('member')->where(array('id'=>$check_data['user_id']))->find();
            $w_title = '审核进度';
            if( $status == 2 ){
                $w_description = '亲爱的'.$user_data['name']."您好！您的会员申请已经审核完毕\r\n".'审核结果：已通过！'."\r\n".'点击此处继续购买';
                $w_url = $_SERVER['HTTP_HOST'].'/index.php/home/index/getVip.html';
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
            }else{
                $w_description = '亲爱的'.$user_data['name']."您好！您的会员申请已经审核完毕\r\n".'审核结果：未通过！'."\r\n".$check_data['remark'];
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
            }

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
            $this->ajaxReturn(array('status'=>'y', 'msg'=>'操作成功'));
        }elseif($this->act=='no'){
            
        }
        
    }

    function subsidies_detail(){
        $id = I('get.id') ? I('get.id') : exit('参数不正确！');
        $data = M('subsidies as s')->where(array('s.id'=>$id))->join('tp_member as m on m.id = s.userid', 'left')->field('s.*,m.*,s.id as sid')->find();
        $img_arr = explode(',', $data['bl_image']);
        foreach( $img_arr as $v ){
            $img_str .= '"'.$v.'",';
        }
        $package = M('package_type')->where(array('package_id'=>$data['vip_type']))->select();
        $count_price = 0;
        $count_yh = 0;
        foreach( $package as $k=>$v ){
            $price = $v['type_scale1'] * $v['type_price']/100;
            $package[$k]['yh_price'] = $price;
            $count_yh +=$price;
            $count_price += $v['type_price'];
        }
        $this->assign('count_price', $count_price);
        $this->assign('count_yh', $count_yh);
        $this->assign('package', $package);
        $data_img = M('img')->where('user_id = '.$data['userid'].' and server_id in ('.trim($img_str,',').')')->select();
        $this->assign('data', $data);
        $this->assign('data_img', $data_img);
        $this->display();
    }
    
    function buy_detail(){
        $id = I('get.id') ? I('get.id') : exit('参数不正确！');
        $data = M('check')->where(array('id'=>$id))->find();
        $img_arr = explode(',', $data['bl_img']);
        foreach( $img_arr as $v ){
            $img_str .= '"'.$v.'",';
        }
        $data_img = M('img')->where('server_id in ('.trim($img_str,',').')')->select();
        $this->assign('data_img', $data_img);
        $this->assign('data',$data);
        $this->assign('id', $id);
        $this->display();
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
