<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends BaseController{

    /* 会员注册 */
    public function register()
    {
        $user = $this->userinfo;
        $this->assign('userinfo', $user);
        if( $user['step'] == 0 ){   //会员注册流程第一步
            if( IS_POST ){
                $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : exit(json_encode(array('status'=>'n', 'msg'=>'昵称不能为空')));
                $sex = isset($_POST['sex']) ? $_POST['sex'] : exit(json_encode(array('status'=>'n', 'msg'=>'请选择性别')));
                $date = isset($_POST['date']) ? $_POST['date'] : exit(json_encode(array('status'=>'n', 'msg'=>'请选择生日')));
                $height = isset($_POST['height']) ? $_POST['height'] : exit(json_encode(array('status'=>'n', 'msg'=>'请选择身高')));
                $education = isset($_POST['education']) ? $_POST['education'] : exit(json_encode(array('status'=>'n', 'msg'=>'请选择学历')));
                $marriage = isset($_POST['marriage']) ? $_POST['marriage'] : exit(json_encode(array('status'=>'n', 'msg'=>'请选择婚姻状况')));
                $income = isset($_POST['income']) ? $_POST['income'] : exit(json_encode(array('status'=>'n', 'msg'=>'请选择月收入')));

                //修改用户详细信息
                $data = array('birthday'=>$date, 'height'=>$height, 'education'=>$education, 'marriage'=>$marriage, 'income'=>$income, 'user_id'=>$this->userid);
                $insert = M('userinfo')->add($data);
                //修改昵称
                M('member')->where(array('id'=>$this->userid))->save(array('nickname'=>$nickname, 'step'=>1));
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功')));

            }
        
            $this->display('register_step1');
        }elseif( $user['step'] == 1 ){  //会员注册流程第二步
            if( IS_POST ){
                $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : exit(json_encode(array('status'=>'n', 'msg'=>'请输入手机号')));
                if( !preg_match("/1[3458]{1}\d{9}$/",$mobile) ){
                    exit(json_encode(array('status'=>'n', 'msg'=>'请输入正确的手机号')));
                }
                //检测手机号是否已经注册
                $mobile_data = M('member')->where(array('mobile'=>$mobile))->find();
                if( $mobile_date ){
                    exit(json_encode(array('status'=>'n', 'msg'=>'该手机号已经注册过')));
                }
                M('member')->where(array('id'=>$this->userid))->save(array('mobile'=>$mobile, 'step'=>2));
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功')));

            }
            $this->display('register_step2');
        }else{
            $this->redirect('Member/index');
            exit;
        }
    }

}
