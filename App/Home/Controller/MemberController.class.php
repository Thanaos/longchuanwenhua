<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller{
    
    function __construct(){
        parent::__construct();
        $this->auth_userinfo = session('auth_userinfo');
        if( empty($this->auth_userinfo) ){
            redirect(U('Index/index'));
        }else{
            $this->userinfo = $this->auth_userinfo['userinfo'];
        }
        //检查是否注册过
        $is_register = M('member')->where(array('openid'=>$this->userinfo['openid']))->find();
        if( $is_register ){
            //redirect(U('Index/index'));
        }
        //查询病证
        $this->assign('sickid',C('SICKID'));
    }
    
    /* 会员注册 */
    public function register()
    {
    
        //微信签名
        $wx_config = M('weixin_config')->where('id = 1')->find();
        $jssdk = new \Org\Util\Wxsdk($wx_config['appid'], $wx_config['secret']);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign('signPackage', $signPackage);
        //查询flash
        $flash = M('flash')->select();
        $this->assign('flash', $flash);
        
        $this->display();

    }
    
    public function ajax_register(){
        $name = I('post.name') ? I('post.name') : '';
        $sex  = I('post.sex') ? I('post.sex') : 0;
        $age  = I('post.age') ? I('post.age') : 0;
        $wxid = I('post.wxid') ? I('post.wxid') : 0;
        $idCard = I('post.idCard') ? I('post.idCard') : '';
        $birthday = strtotime(I('post.birthday')) > 0 ? strtotime(I('post.birthday')) : 0;
        $mobile = preg_match("/^1[34578]\d{9}$/", I('post.mobile')) ? I('post.mobile') : '';
        $email = I('post.email') ? I('post.email') : '';
        $bailor = I('post.bailor') ? I('post.bailor') : '';
        $bailor_idcard = I('post.bailor_idcard') ? I('bailor_idcard') : '';
        $relation = I('post.relation') ? I('post.relation') : '';
        $bailor_mobile = I('post.bailor_mobile') ? I('post.bailor_mobile') : '';
        $bailor_email = I('post.bailor_email') ? I('post.bailor_email') : '';
        $s_wxid = I('post.s_wxid') ? I('post.s_wxid') : '';
        
        $domicile= I('post.d_s').','.I('post.d_c').','.I('post.d_d').','.I('post.address');
        $cq_domicile= I('post.c_s').','.I('post.c_c').','.I('post.c_d');
        $s_domicile= I('post.s_s').','.I('post.s_c').','.I('post.s_d').','.I('post.s_address');
        $diagnose = I('post.diagnose') > 0 ? I('post.diagnose') : 0;
        
        $illness_time = I('post.illness_time') ? I('post.illness_time') : 0;
        $illness_history = I('post.illness_history') ? I('post.illness_history') : '';
        $gm_history = I('post.gm_history') ? I('post.gm_history') : '';
        $jz_history = I('post.jz_history') ? I('post.jz_history') : '';
        $description = I('post.description') ? I('post.description') : '';
        $bl_img = I('post.bl_img') ? I('post.bl_img') : '';
        
        if( empty($name) || empty($idCard) || empty($mobile) ){
            $this->error('请填写比填字段！');
        }
        
        //检测手机和身份证
        if(M('member')->where(array('mobile'=>$mobile))->find()){
            $this->error('手机号已存在！');
            exit;
        }
        
        //检测手机和身份证
        if(M('member')->where(array('idCard'=>$idCard))->find()){
            $this->error('身份证已被使用！');
            exit;
        }
        
        
        //注册用户
        $data = array('openid'=>$this->userinfo['openid'], 'headimg'=>$this->userinfo['headimgurl'], 'name'=>$name, 'birthday'=>$birthday, 'sex'=>$sex, 'idCard'=>$idCard, 'age'=>$age, 'mobile'=>$mobile, 'bailor'=>$bailor, 'bailor_mobile'=>$bailor_mobile, 'diagnose'=>$diagnose, 'domicile'=>$domicile, 'cq_domicile'=>$cq_domicile, 'illness_history'=>$illness_history, 'illness_time'=>$illness_time, 'gm_history'=>$gm_history, 'jz_history'=>$jz_history, 'description'=>$description, 'email'=>$email, 'bailor_idcard'=>$bailor_idcard, 'relation'=>$relation, 'bailor_email'=>$bailor_email, 'bl_img'=>$bl_img, 'wxid'=>$wxid, 'b_domicile'=>$s_domicile, 's_wxid'=>$s_wxid);
        //注册时间
        $data['createtime'] = time();
        $insert = M('member')->add($data);
        if( $insert > 0 ){
            session('userid', $insert);
            $this->userid = $insert;
            $this->assign('url', 'http://'.$_SERVER['HTTP_HOST'].U('Index/index'));
            $this->assign('message', '恭喜您注册成功！');
            $this->display('Public:success');
            
        }else{
            $this->assign('message', '服务器出错！');
            $this->display('Public:error');
        }
    }
    
    public function uploadImg()
    {
        if( IS_AJAX ){
            //检测用户相册数量
            $serverid = isset($_POST['serverIds']) ? $_POST['serverIds'] : '';
            $server_arr = explode(',', trim($serverid, '"'));
            $count = count($server_arr);
            if( $count >= 30 ){
                $this->ajaxReturn(array('status'=>'n','msg'=>'只能上传30张照片'));
            }
            foreach( $server_arr as $v ){
                $url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->access_token().'&media_id='.$v;
                $fileinfo = $this->downloadImageFromWeiXin($url);
                $filename = 'uploads/BL/'.uniqid().'.jpg';
                $this->saveImageFromWeiXin($filename, $fileinfo['body']);
                $data[] = array('user_id'=>$this->userid, 'path'=>'/'.$filename,'server_id'=>$v, 'addtime'=>time());
                $server_id .= $v.',';
                $server_img[] = array('path'=>'/'.$filename, 'id'=>$v);
            }
            
            file_put_contents('1.txt', json_encode(array('status'=>'y', 'server'=>array('server_id'=>trim($server_id, ','), 'server_img'=>$server_img))));
            //插入数据库
            M('img')->addAll($data);
            $this->ajaxReturn(array('status'=>'y', 'server'=>array('server_id'=>trim($server_id, ','), 'server_img'=>$server_img)));
        }
    }
    
    public function saveImageFromWeiXin($filename, $filecontent)
    {
        $local_file = fopen($filename, 'w');
        if (false !== $local_file){
            if (false !== fwrite($local_file, $filecontent)) {
                fclose($local_file);
            }
        }
    }
    
    //下载微信资源图片
    function downloadImageFromWeiXin($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        curl_close($ch);
        return array_merge(array('body' => $package), array('header' => $httpinfo));
    }
    
    protected function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
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
