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
            redirect(U('Index/index'));
        }
        //查询病证
        $this->assign('sickid',C('SICKID'));
    }
    
    /* 会员注册 */
    public function register()
    {
    
        //查询flash
        $flash = M('flash')->select();
        $this->assign('flash', $flash);
        
        $this->display();

    }
    
    public function ajax_register(){
        $name = I('post.name') ? I('post.name') : '';
        $sex  = I('post.sex') ? I('post.sex') : 0;
        $age  = I('post.age') ? I('post.age') : 0;
        $idCard = I('post.idCard') ? I('post.idCard') : '';
        $birthday = strtotime(I('post.birthday')) > 0 ? strtotime(I('post.birthday')) : 0;
        $mobile = preg_match("/^1[34578]\d{9}$/", I('post.mobile')) ? I('post.mobile') : '';
        $bailor = I('post.bailor') ? I('post.bailor') : '';
        $bailor_mobile = I('post.bailor_mobile') ? I('post.bailor_mobile') : '';
        
        $domicile= I('post.d_s').','.I('post.d_c').','.I('post.d_d');
        $cq_domicile= I('post.c_s').','.I('post.c_c').','.I('post.c_d').','.I('post.address');
        $diagnose = I('post.diagnose') > 0 ? I('post.diagnose') : 0;
        
        $illness_time = I('post.illness_time') ? I('post.illness_time') : 0;
        $illness_history = I('post.illness_history') ? I('post.illness_history') : '';
        $gm_history = I('post.gm_history') ? I('post.gm_history') : '';
        $jz_history = I('post.jz_history') ? I('post.jz_history') : '';
        $description = I('post.description') ? I('post.description') : '';
        
        if( empty($name) || empty($idCard) || empty($mobile) ){
            $this->error('请填写比填字段！');
        }
        
        //注册用户
        $data = array('openid'=>$this->userinfo['openid'], 'headimg'=>$this->userinfo['headimgurl'], 'name'=>$name, 'birthday'=>$birthday, 'sex'=>$sex, 'idCard'=>$idCard, 'age'=>$age, 'mobile'=>$mobile, 'bailor'=>$bailor, 'bailor_mobile'=>$bailor_mobile, 'diagnose'=>$diagnose, 'domicile'=>$domicile, 'cq_domicile'=>$cq_domicile, 'illness_history'=>$illness_history, 'illness_time'=>$illness_time, 'gm_history'=>$gm_history, 'jz_history'=>$jz_history, 'description'=>$description);
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

}
