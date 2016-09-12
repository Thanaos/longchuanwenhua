<?php
namespace Admin\Controller;
use Think\Controller;
class UsersController extends Controller {
    public function login()
    {
        if(session('admin')){
            $this->redirect("index/index");
        }
        if(!empty($_POST)){
            $user = $_POST['name'];
            $pwd  = $_POST['pwd'];
            $code = $_POST['code'];
            if(empty($user) || empty($pwd)){
                $this->error('用户名或密码不能为空');
            }
            $verify = new \Think\Verify();
            if(!$verify->check($code, $id)){
                $this->error('验证码输入有误',__APP__.'/admin/user/login.html');
            }
            $data = M('User');
            //查询是否一致
            $obj = $data->where(array('name'=>$user,'pwd'=>md5($pwd)))->find();
            if(empty($obj)){
                $this->error('用户名或密码不正确',__APP__.'/admin/user/login.html');
            }
            session('admin',$obj);
            $this->success('登陆成功，正在跳转',__APP__.'/Admin/Index/index'); 
        }else{
            $this->display();
        }
    }

    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 40;
        $Verify->length   = 4;
        return $Verify->entry();
    }

    public function logout()
    {
        session('admin',null); // 删除name
        $url = __APP__.'/admin/index/index.html';
        $this->success('退出成功！',$url);
    }
}
