<?php
return array(
    'URL_ROUTER_ON'   => true, //开启路由
	//'配置项'=>'配置值'
    'URL_ROUTE_RULES'=>array(
        'model/:act$'            => 'index/model',
        'model/:act/:id$'        => 'index/model',
        'option/:act$'           => 'config/option',
        'option/:act/:id$'       => 'config/option',
        'user/:act$'             => 'power/user',
        'user/:act/:id$'         => 'power/user',
        'member/:act$'           => 'member/member',
        'member/:act/:id$'       => 'member/member',
        'income/:act$'           => 'finance/income',
        'income/:act/:id$'       => 'finance/income',
        'subsidies/:act$'           => 'member/subsidies',
        'subsidies/:act/:id$'       => 'member/subsidies',
        'flash/:act$'            => 'index/flash',
        'flash/:act/:id$'        => 'index/flash',
        'package/:act$'          => 'index/package',
        'package/:act/:id$'      => 'index/package',
        'goods/:act$'          => 'index/goods',
        'goods/:act/:id$'      => 'index/goods',
        'order/:act$'            => 'index/order',
        'order/:act/:id$'        => 'index/order',
    ),
    'URL_ROLE' => array('power'),
);
