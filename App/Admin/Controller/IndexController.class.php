<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AdminController {

    public function index(){
        $this->display();
    }
    
    /* 轮播图管理 */
    public function flash()
    {
        $db = M('flash');
        if( $this->act == 'list' ){
            $p = isset($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $count = $db->count();
            $Page = new \Think\Page($count, $max);
            $list = $db->page($p, $max)->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;//总页数
            $show['current'] = $p;
            $this->assign('list', $list);
            $this->assign('show', $show);
            $this->display('flash_list');
            
            /* 新增操作 */
        }elseif( $this->act == 'edit' ){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if($id){
                $data = $db->where(array('id'=>$id))->find();
                $this->assign('data', $data);
            }
            $this->display('flash_edit');
        }
        
        /*******保存********/
        else if($this->act == 'save'){
            $id = empty($_POST['id']) ? 0 : intval($_POST['id']);
            $name = isset($_POST['name']) ? $_POST['name'] : exit(json_encode(array('status'=>'n', 'msg'=>'轮播名称必须填写')));
            $url = isset($_POST['url']) ? $_POST['url'] : exit(json_encode(array('status'=>'n', 'msg'=>'跳转网址必须填写')));
            $image = isset($_POST['image']) ? $_POST['image'] : exit(json_encode(array('status'=>'n', 'msg'=>'请上传一张图片')));
            $data = array('name'=>$name, 'url'=>$url, 'image'=>$image, 'addtime'=>time);
            if($id){
                $insert = $db->where(array('id'=>$id))->save($data);
            }else{
                $insert = $db->add($data);
            }
            if($insert){
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功', 'id'=>$insert)));
            }else{
                exit(json_encode(array('status'=>'n', 'msg'=>'操作失败')));
            }
        }
        
    }
    
    public function agreement(){
        $db = M('agreement');
        if( $this->act == 'list' ){
            $p = isset($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $count = $db->count();
            $Page = new \Think\Page($count, $max);
            $list = $db->page($p, $max)->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;//总页数
            $show['current'] = $p;
            $this->assign('list', $list);
            $this->assign('show', $show);
            $this->display('agreement_list');
        
            /* 新增操作 */
        }elseif( $this->act == 'edit' ){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if($id){
                $data = $db->where(array('id'=>$id))->find();
                $this->assign('data', $data);
            }
            $this->display('agreement_edit');
        }
    
        /*******保存********/
        else if($this->act == 'save'){
            $id = empty($_POST['id']) ? 0 : intval($_POST['id']);
            $name = isset($_POST['name']) ? $_POST['name'] : exit(json_encode(array('status'=>'n', 'msg'=>'协议名称必须填写')));
            $content = isset($_POST['content']) ? $_POST['content'] : exit(json_encode(array('status'=>'n', 'msg'=>'协议内容必须填写')));
            $data = array('name'=>$name, 'content'=>$content, 'addtime'=>time());
            if($id){
                $insert = $db->where(array('id'=>$id))->save($data);
            }else{
                $insert = $db->add($data);
            }
            if($insert){
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功', 'id'=>$insert)));
            }else{
                exit(json_encode(array('status'=>'n', 'msg'=>'操作失败')));
            }
        }
    }
    
    /* 诊疗项目管理 */
    public function goods()
    {
        $db = M('goods');
        if( $this->act == 'list' ){
            $p = isset($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $count = $db->count();
            $Page = new \Think\Page($count, $max);
            $list = $db->page($p, $max)->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;//总页数
            $show['current'] = $p;
            $this->assign('list', $list);
            $this->assign('show', $show);
            $this->display('goods_list');
            
            /* 新增操作 */
        }elseif( $this->act == 'edit' ){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            //查询会员名称
            $package = M('package')->select();
            $this->assign('package', $package);
            if($id){
                $data = $db->where(array('id'=>$id))->find();
                $this->assign('data', $data);
            }
            $this->display('goods_edit');
        }
        
        /*******保存********/
        else if($this->act == 'save'){
            $id = empty($_POST['id']) ? 0 : intval($_POST['id']);
            $good_name = isset($_POST['good_name']) ? $_POST['good_name'] : exit(json_encode(array('status'=>'n', 'msg'=>'项目名称必须填写')));
            $good_price = isset($_POST['good_price']) ? $_POST['good_price'] : exit(json_encode(array('status'=>'n', 'msg'=>'价格必须填写')));
            $good_scale1 = isset($_POST['good_scale1']) ? $_POST['good_scale1'] : exit(json_encode(array('status'=>'n', 'msg'=>'补贴比例必须填写')));
            $good_scale2 = isset($_POST['good_scale2']) ? $_POST['good_scale2'] : exit(json_encode(array('status'=>'n', 'msg'=>'补贴比例必须填写')));
            $good_scale3 = isset($_POST['good_scale3']) ? $_POST['good_scale3'] : exit(json_encode(array('status'=>'n', 'msg'=>'补贴比例必须填写')));
            $good_detail = $_POST['content'];
            $data = array('good_name'=>$good_name, 'good_price'=>$good_price, 'good_scale1'=>$good_scale1, 'good_scale2'=>$good_scale2, 'good_scale3'=>$good_scale3, 'good_detail'=>$good_detail, 'addtime'=>time());
            if($id){
                $insert = $db->where(array('id'=>$id))->save($data);
            }else{
                $insert = $db->add($data);
            }
            if($insert){
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功', 'id'=>$insert)));
            }else{
                exit(json_encode(array('status'=>'n', 'msg'=>'操作失败')));
            }
        }
        
    }
    
    public function package(){
        $db = M('package');
        if( $this->act == 'list' ){
            $p = isset($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $count = $db->count();
            $Page = new \Think\Page($count, $max);
            $list = $db->page($p, $max)->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;//总页数
            $show['current'] = $p;
            $this->assign('list', $list);
            $this->assign('show', $show);
            $this->display('package_list');
        
            /* 新增操作 */
        }elseif( $this->act == 'edit' ){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if($id){
                $data = $db->where(array('id'=>$id))->find();
                $this->assign('data', $data);
            }
            $this->display('package_edit');
        }
    
        /*******保存********/
        else if($this->act == 'save'){
            $id = empty($_POST['id']) ? 0 : intval($_POST['id']);
            $package_name = isset($_POST['package_name']) ? $_POST['package_name'] : exit(json_encode(array('status'=>'n', 'msg'=>'种类名称必须填写')));
            $package_price1 = isset($_POST['package_price1']) ? $_POST['package_price1'] : exit(json_encode(array('status'=>'n', 'msg'=>'价格必须填写')));
            $package_price2 = isset($_POST['package_price2']) ? $_POST['package_price2'] : exit(json_encode(array('status'=>'n', 'msg'=>'价格必须填写')));
            $package_price3 = isset($_POST['package_price3']) ? $_POST['package_price3'] : exit(json_encode(array('status'=>'n', 'msg'=>'价格必须填写')));
            $package_price4 = isset($_POST['package_price4']) ? $_POST['package_price4'] : exit(json_encode(array('status'=>'n', 'msg'=>'价格必须填写')));
            $package_price5 = isset($_POST['package_price5']) ? $_POST['package_price5'] : exit(json_encode(array('status'=>'n', 'msg'=>'价格必须填写')));
            $data = array('package_name'=>$package_name, 'package_price1'=>$package_price1, 'package_price2'=>$package_price2, 'package_price3'=>$package_price3, 'package_price4'=>$package_price4, 'package_price5'=>$package_price5, 'addtime'=>time());
            if($id){
                $insert = $db->where(array('id'=>$id))->save($data);
            }else{
                $insert = $db->add($data);
            }
            if($insert){
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功', 'id'=>$insert)));
            }else{
                exit(json_encode(array('status'=>'n', 'msg'=>'操作失败')));
            }
        }
        //管理项目
        else if($this->act == 'type'){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if( $id < 0 ){
                $this->error('参数不正确！');
            }

            //查询
            $list = M('package_type')->where(array('package_id'=>$id))->select();
            $this->assign('list', $list);
            $this->assign('id', $id);
    
            $this->display('package_type_detail');
        }
        
        else if($this->act == 'save_type'){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if( $id < 0 ){
                $this->error('参数不正确！');
            }
            if( IS_POST ){
                $save_data = array('type_name'=>I('post.type_name', ''), 'type_price'=>I('post.type_price', ''), 'type_scale'=>I('post.type_scale', ''), 'package_id'=>$id);
                $insert = M('package_type')->add($save_data);
                if( $insert < 0 )
                    $this->error('服务器出错！');
                else
                    redirect(__APP__.'/admin/package/type/'.$id.'html');
            }
            
        }
        
    }
    
    
    public function model()
    {
        if( $this->act == 'del' ){
            if(  IS_PSOT ){
                $model = isset($_POST['model']) ? $_POST['model'] : '';
                $id = isset($_POST['id']) ? $_POST['id'] : '';
                if( $model && $id ){
                    M($model)->where(array('id'=>$id))->delete();
                }
                exit(json_encode(array('status'=>'y', 'msg'=>'删除成功')));
            }
        }
    }
    
    
    
    /* 订单管理 */
    public function order()
    {
        $order = M('order as o');
        $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
        $max = 20;
        if( $this->act == 'untreated' ){  //未处理订单
            $w = array('o.order_status'=>0, 'o.pay_status'=>2);
            $count = $order->where($w)->count();
            $Page = new \Think\Page($count, $max);
            $list = $order->page($p, $max)->where($w)->join('tp_member as m on m.id = o.user_id', 'left')->join('tp_service as s on s.id = o.good', 'left')->field('o.*, m.wxname, m.headimg, m.mobile, s.service_name, s.service_price')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('order_untreated');

        }else if ( $this->act == 'list' ) {     //订单查询

        }else if ( $this->act == 'handle' ) {       //处理订单

            if(IS_POST){
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $service_id = isset($_POST['service_id']) ? intval($_POST['service_id']) : 0;
                //查询当前订单是否处理过
                $data = M('order')->where(array('id'=>$id))->find();
                if($data['order_status'] != 0){
                    exit(json_encode(array('status'=>'n', 'msg'=>'当前订单已经处理过')));
                }
                M('order')->where(array('id'=>$id))->save(array('service_id'=>$service_id, 'order_status'=>1)); //修改订单状态进行中
                /* 给用户发送末班消息 */
                //查询服务点用户
                $user = M('service_branch as b')->join('tp_member as m on m.id = b.branch_user','left')->where(array('b.id'=>$service_id))->field('m.*')->find();
                //查询订单用户信息
                $order_user = M('member')->where(array('id'=>$data['user_id']));
                $w_title = '服务提醒';
                $w_description = '下单人：'.$order_user['wxname']."\r\n".'地址：'.$data['address']."\r\n".'联系电话：'. $order_user['mobile'] ."\r\n".'支付状态：已支付';
                $w_url = $_SERVER['HTTP_HOST'].'/index.php/home/index/service/'. $data['id'] .'.html';
                $post_msg = '{
                    "touser":"'.$user['wxid'].'",
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
                /* 发送模板消息结束 */
                exit(json_encode(array('status'=>'y', 'msg'=>'操作成功')));
            }
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            if(empty($id)){
                $this->error('参数出错！');
            }
            //查询订单信息
            $w = array('id'=>$id);
            $data = M('order')->where($w)->find();
            //列出最近的服务点。及工作状态。
            $branch_list = M('service_branch')->where('status = 0')->limit(10)->select();
            foreach($branch_list as $k => $v){
                $num = getDistance($data['latitude'], $data['longitude'] , $v['latitude'], $v['longitude']); 
                $v['distance'] = $num;
                $distance[$num] = $v;
            }
            ksort($distance);
            $this->assign('distance', $distance);
            $this->assign('data', $data);
            $this->display('order_untreated_handle');

        }
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

    //editor 上传图片
    public function uploadImg()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './uploads/'; // 设置附件上传根目录
        $upload->savePath  =      ''; // 设置附件上传（子）目录
        //是否添加水印
        if(intval($_POST['iswater']) == 1){
            $position = intval($_POST['position']);
            $transparent = intval($_POST['transparent']);
            if(!in_array($position,array(1,2,3,4,5,6,7,8,9))){
                $this->error('水印位置参数不正确！');
                echo json_encode(array('error' => 1, 'message' => '水印位置参数不正确'));
                exit;
            }
            if($transparent <= 1 || $transparent >100){
                echo json_encode(array('error' => 1, 'message' => '透明度必须在1-100之间'));
                exit;
            }
            //默认水印的图片
            $water_url ='Public/Admin/image/gtt.png';
        }
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                $url = __ROOT__;
                $file_root = 'uploads/'.$file['savepath'].$file['savename'];
                $file_url = $url.'/'.$file_root;
                if(!empty($water_url)){
                    $image = new \Think\Image();
                    $image->open($file_root)->water($water_url,$position,$transparent)->save($file_root);
                }
                echo json_encode(array('error' => 0, 'url' => $file_url));
            }
        }
    }
    public function uploadFile()
    {
        $action = $_GET['act'];
        if($action=='delimg'){
            $filename = $_POST['imagename'];
            if(!empty($filename)){
                //unlink('/'.$filename);
                echo '1';
                exit;
            }else{
                echo '删除失败.';
                exit;
            }
        }
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './uploads/'; // 设置附件上传根目录
        $upload->savePath  =      ''; // 设置附件上传（子）目录
            //默认水印的图片
            $water_url ='Public/Admin/image/gtt.png';
        // 上传文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            echo json_encode(array('status'=>'n', 'message'=>$upload->getError()));
            exit;
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                $url = __ROOT__;
                $file_root = 'uploads/'.$file['savepath'].$file['savename'];
                $file_url = $url.'/'.$file_root;
                $image = new \Think\Image();
                $arr = array(
                    'name' => $file['name'],
                    'pic'  => $file_root,
                    'size' => $file['size'],
                    'status' => 'y'
                );
                echo json_encode($arr);
            }
        }
    }
}

