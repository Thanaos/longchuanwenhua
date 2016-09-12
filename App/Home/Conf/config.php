<?php
return array(
	//'配置项'=>'配置值'
    'URL_ROUTER_ON'   => true, //开启路由
    'URL_ROUTE_RULES'=>array(
        'ajax/:act'       => 'index/ajax',
        'addcar'       => 'index/addcar',
    ),
);
