<?php
namespace Admin\Controller;
use Think\Controller;

class PowerController extends AdminController{
    
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
    public function user()
    {
        if( $this->act == 'list' ){     //列表
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $service = M('user');
            $count = $service->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->page($p, $max)->join('tp_user_group on tp_user_group.id = tp_user.group_id','left')->field('tp_user.*,tp_user_group.title')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('user_list');
            
        }else if ( $this->act == 'edit' ) {  //详细信息
            $id = I('id');
            if( $id > 0 ){
                $user = M('user')->where(array('id'=>$id))->find();
                $this->assign('data', $user);
            }
            $this->display('user_edit');
            
        }else if ( $this->act == 'save' ) {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $name = isset($_POST['name']) ? $_POST['name'] : 0;
            $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : 0;
            $group = isset($_POST['group']) ? $_POST['group'] : 0;
            if(empty($name)){
                exit($this->ajaxReturn(array('status'=>'n', 'msg'=>'参数不正确')));
            }
            if( $id > 0 ){
                $data = array('name'=>$name, 'createtime'=>date('Y-m-d H:i:s'), 'group_id'=>$group);
                if( !empty($pwd) ){
                    $data['pwd'] = $pwd;
                }
                $insert = M('user')->where(array('id'=>$id))->save($data);
            }else{
                //用户名是否重复
                $is_reply = M('user')->where(array('name'=>$name))->find();
                if( $is_reply ){
                    $this->ajaxReturn(array('status'=>'n', '用户已存在'));
                }
                $insert = M('user')->add(array('name'=>$name, 'pwd'=>md5($pwd), 'createtime'=>date('Y-m-d H:i:s'), 'group_id'=>$group));
            }
            if($insert){
                exit($this->ajaxReturn(array('status'=>'y', 'msg'=>'操作成功')));
            }else{
                exit($this->ajaxReturn(array('status'=>'n', 'msg'=>'系统出错！')));
            }

            
        }else if ( $this->act == 'del' ) {
            $id = intval($_POST['id']) ? intval($_POST['id']) : 0;
            M('user')->where(array('id'=>$id))->delete();
            exit($this->ajaxReturn(array('status'=>'y', 'msg'=>'操作成功')));
            
        }
    }
    
}