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
                $start_age = I('post.start_age') ? I('post.start_age') : '';
                $end_age = I('post.end_age') ? I('post.end_age') : '';
                $illness_time = I('post.illness_time') ? I('post.illness_time') : '';
                $diagnose = I('post.diagnose') ? I('post.diagnose') : '';
                $domicile = I('post.cq_domicile') ? I('post.cq_domicile') : '';
                if( $name ){
                    $where['name'] = $name;
                }
                if( $mobile ){
                    $where['mobile'] = $mobile;
                }
                if( $idCard ){
                    $where['idCard'] = $idCard;
                }
                if( !empty($start_age) && !empty($end_age) ){
                    $where['age'] = array('between', array($start_age, $end_age));
                }
                
                if( $illness_time > 0 ){
                    $where['illness_time'] = $illness_time;
                }
                if( $diagnose > 0 ){
                    $where['diagnose'] = $diagnose;
                }
                if( $domicile ){
                    $where['cq_domicile'] = array('like', '%'.$domicile.'%');
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
            $this->assign('where', array('name'=>$name, 'mobile'=>$mobile, 'idCard'=>$idCard, 'start_age'=>$start_age, 'end_age'=>$end_age, 'illness_time'=>$illness_time, 'diagnose'=>$diagnose, 'cq_domicile'=>$domicile));
            $this->assign('show', $show);
            $this->assign('list', $list);
            
            $this->display('member_list');
        }elseif($this->act == 'check_log'){
            if( IS_AJAX && IS_POST ){
                $type = I('post.type');
                $status = I('post.status');
                $remark = I('post.remark');
                $id = I('post.id');
                //检查权限
                if( $this->admin['group_id'] != 2 ){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'没有权限'));
                }
                if(M('check_log')->where(array('type'=>$type, 'mod_id'=>$id, 'admin_id'=>$this->admin['id']))->find()){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'您已经审核过了'));
                }
                $yi_count = M('check_log')->where(array('type'=>$type, 'mod_id'=>$id))->count();
                if( $yi_count >=3 ){
                    $this->ajaxReturn(array('status'=>'n', 'msg'=>'当前已经有三个人审核过，不需要审核'));
                }
                //插入数据
                $data = array('admin_id'=>$this->admin['id'], 'admin_group'=>$this->admin['group_id'], 'type'=>$type, 'mod_id'=>$id, 'status'=>$status, 'remark'=>$remark, 'addtime'=>time());
                $insert = M('check_log')->add($data);
                if( $type == 1 ){
                    $check_db = M('check');
                }else{
                    $check_db = M('subsidies');
                }
                $mod_data = $check_db->where(array('id'=>$id))->find();
                $user_data = M('member')->where(array('id'=>$mod_data['user_id']))->find();
                $w_title = '审核进度';
                //添加操作次数
                if( $status == 1 && $mod_data['times'] != -1 ){
                    $check_db->where(array('id'=>$id))->save(array('times'=>-1));
                    $w_description = '亲爱的'.$user_data['name']."您好！您的会员申请果：未通过！"."\r\n".$user_data['remark'];
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
                    $w_description = '亲爱的'.$user_data['name']."您好！您的会员申请结果：已通过！\r\n".'点击此处继续购买';
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
            $list = $service->join('tp_member as m on m.id = s.userid', 'left')->where($where)->page($p, $max)->field('s.*,m.*,s.id as sid')->select();
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
                if( $status == 0 ){
                    $where = 'times != -1 AND times != 3';
                }elseif( $status == 1 ){
                    $where = 'times = -1';
                }elseif( $status == 2 ){
                    $where = 'times = 3';
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

            if( $status == 2 ){

            }else{

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
        //查询审核记录
        $check_list = M('check_log as c')->where(array('c.mod_id'=>$data['sid'], 'c.type'=>2))->join('tp_user as u on u.id=c.admin_id')->order('addtime asc')->field('c.*,u.name,u.group_id')->select();
        $this->assign('check_list', $check_list);
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
        //查询审核记录
        $check_list = M('check_log as c')->where(array('c.mod_id'=>$data['id'], 'c.type'=>1))->join('tp_user as u on u.id=c.admin_id')->order('addtime asc')->field('c.*,u.name,u.group_id')->select();
        $this->assign('check_list', $check_list);
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
