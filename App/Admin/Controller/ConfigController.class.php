<?php
namespace Admin\Controller;
use Think\Controller;
    class ConfigController extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->act = isset($_GET['act']) ? $_GET['act'] : '';
        //检测用户是否登陆
        $login = session('admin');
        if(empty($login)){
            $this->redirect('Admin/User/login');
        }else{
            $user = session('admin');
            $this->assign('admin',$user);
        }
    }

    public function option()
    {
        if ( $this->act == 'edit' ) {
            //查询系统设置参数
            $config_data = M('Config')->where('id = 1')->find();
            $this->assign('config', $config_data);
            $this->display();
        }else if ( $this->act == 'save' ) {
            if(IS_POST){
                $max_order = isset($_POST['max_order']) ? intval($_POST['max_order']) : 0;
                if(empty($max_order)){
                    exit(json_encode(array('status'=>'n', 'msg'=>'请填写一个有效数字')));
                }
                M('Config')->where('id = 1')->save(array('config_val'=>$max_order));
                exit(json_encode(array('status'=>'n', 'msg'=>'操作成功')));
            }
        }
    }

    //服务选项
    public function service()
    {
        if( $this->act == 'list' ){     //列表
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $service = M('Service');
            $count = $service->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->page($p, $max)->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display();

        }else if ( $this->act == 'edit' ) {  //详细信息
            $this->display('service_info');

        }else if ( $this->act == 'save' ) {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $name = isset($_POST['service_name']) ? $_POST['service_name'] : 0;
            $price = isset($_POST['service_price']) ? $_POST['service_price'] : 0;
            if(empty($name) || empty($price)){
                exit(json_encode(array('status'=>'n', 'msg'=>'参数不正确')));
            }
            $insert = M('service')->add(array('service_name'=>$name, 'service_price'=>$price, 'add_time'=>time()));
            if($insert){
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功')));
            }else{
                exit(json_encode(array('status'=>'n', 'msg'=>'系统出错！')));
            }

        }else if ( $this->act == 'del' ) {
            $id = intval($_POST['id']) ? intval($_POST['id']) : 0;
            M('service')->where(array('id'=>$id))->delete();
            exit(json_encode(array('status'=>'y', 'msg'=>'操作成功')));

        }else if ( $this->act == 'branch' ) {        //服务点管理
            $branch = M('service_branch as s');
            $p = isset($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $count = $branch->count();
            $Page = new \Think\Page($count, $max);
            $list = $branch->page($p, $max)->join('tp_member as m on m.id = s.branch_user')->field('s.*, m.wxname as username')->select();
            $show['current'] = $p;
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('service_branch');

        }else if ( $this->act == 'edit_branch' ) {    //服务点编辑
            $branch = M('service_branch');
            $id = isset($_GET['id']) ? intva($_GET['id']) : 0;
            if($id){
                $data = $branch->where(array('id'=>$id))->find(); 
                $this->assign('data', $data);
            }
            $this->display('service_branchInfo');

        }else if ( $this->act == 'branchSave' ) {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $branch_name = isset($_POST['branch_name']) ? $_POST['branch_name'] : '';
            $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
            $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
            if(empty($branch_name) || empty($mobile) || empty($longitude) || empty($latitude)){

                exit(json_encode(array('status'=>'n', 'msg'=>'参数错误！')));
            }
            //查询对应的用户
            $user = M('Member')->where(array('mobile'=>$mobile))->find();
            if(empty($user)){
                exit(json_encode(array('status'=>'n', 'msg'=>'没有找到对应的用户！')));
            }
            $data = array('branch_name'=>$branch_name, 'branch_user'=>$user['id'], 'longitude'=>$longitude, 'latitude'=>$latitude);
            $insert = M('service_branch')->add($data);
            if($insert){
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功')));
            }
        }
    }
    
}
?>
