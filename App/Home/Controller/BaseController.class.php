<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
        //检测是否是注册用户
        $this->userid = session('userid');
        $this->auth_userinfo = session('auth_userinfo');
        
        if( empty($this->auth_userinfo) ){
            $wx = $this->auths('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            if( $wx['userinfo']['nickname'] ){
                session('auth_userinfo', $wx);
                $this->auth_userinfo = $wx;
            }else{
                exit('请稍后重试！');
            }
        }
    
        $user = M('Member')->where(array('wxid'=>$this->auth_userinfo['userinfo']['openid']))->find();
        if( empty($user) ){
            //注册页面
        }else{
            //首页
        }

        /* 生成微信分享信息 */
        $wx_config = M('weixin_config')->where('id = 1')->find();
        $jssdk = new \Org\Util\Wxsdk($wx_config['appid'], $wx_config['secret']);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign('signPackage', $signPackage);
    }


    /* 微信自动登录所需函数START */
    
    protected function cookie($var, $value = '', $time = 0, $path = '', $domain = '', $s = false)
	{
		error_reporting(E_ALL ^ E_NOTICE);
		$_COOKIE[$var] = $value;
		if (is_array($value)) {
			foreach ($value as $k => $v) {
				@setcookie($var . '[' . $k . ']', $v, $time, $path, $domain, $s);
			}
		} else {
			@setcookie($var, $value, $time, $path, $domain, $s);
		}
	}

    protected function auths($urls)
	{
	    $auth_userinfo = session('auth_userinfo');
	    if( $auth_userinfo ){
	        return $auth_userinfo;
        }
		$openid = '';
		$access_token = '';
		$ret = array();
        
        if(empty($_GET['code'])){
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b184188b0865ca9&redirect_uri=".urlencode($urls)."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            //$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b184188b0865ca9&redirect_uri=".urlencode($urls)."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
            Header("Location: $url");
        }
        if(!empty($_GET['code'])){
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx0b184188b0865ca9&secret=55af2a82817520f7873d50fef46c3211&code=".$_GET['code']."&grant_type=authorization_code";
            $datas = $this->https_request($url);
            $result = json_decode($datas,true);
            $openid = $result['openid'];
            $access_token = $result['access_token'];
            //$this->cookie('openid',$openid,time()+3600*24*365,"/");
        }
		
        /*
		$tokenurl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx0b184188b0865ca9&secret=55af2a82817520f7873d50fef46c3211";
		$tokresult = $this->https_request($tokenurl);
		$jsoninfo = json_decode($tokresult, true);
		$access_token = $result['access_token'];
        */
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
		//$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid;
		$res = $this->https_request($url);
		$results = json_decode($res,true);

		$ret['openid'] = $openid;
		$ret['userinfo'] = $results;

		return $ret;
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

    /* 微信自动登录所需函数END */

}
