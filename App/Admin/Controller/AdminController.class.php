<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->act = isset($_GET['act']) ? $_GET['act'] : 'list';
        //检测用户是否登陆
        $login = session('admin');
        if(empty($login)){
            $this->redirect('Admin/Users/login');
        }else{
            $user = session('admin');
            $this->admin = $user;
            $this->assign('admin',$user);
        }
        //后台用户组
        $user_group = M('user_group')->select();
        $this->user_group = $user_group;
        $this->assign('user_group', $user_group);
        $admin_role = $user_group[$login['group_id'] - 1]['rules'];
        $this->assign('admin_role', $admin_role);
        $this->admin_role = $admin_role;
        
    }
}