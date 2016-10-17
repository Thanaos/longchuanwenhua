<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

// 定义应用目录
define('APP_PATH','./App/');
define('BIND_MODULE','Home');
define('BIND_CONTROLLER','Pay');
define('BIND_ACTION','goodsback');

$array_data = json_decode(json_encode(simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA)), true);
$_GET['out_trade_no'] = $array_data['out_trade_no'];
$_GET['total_fee'] = $array_data['total_fee'];
$_GET['result_code'] = $array_data['result_code'];
$_GET['return_code'] = $array_data['return_code'];
$_GET['transaction_id'] = $array_data['transaction_id'];
$get_arr = explode('&',$array_data['attach']);
foreach($get_arr as $value){
	$tmp_arr = explode('=',$value);
	$_GET[$tmp_arr[0]] = $tmp_arr[1];
}

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
