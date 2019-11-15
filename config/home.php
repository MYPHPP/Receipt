<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [

    '/'=>'home/index/index',
    '/video'=>'home/index/video',
    '/service/:id'=>'home/index/service',
    '/search'=>'home/search/index',

    '/task'=>'home/index/task',
    '/getask'=>'home/index/gettask',
    '/detail/:id'=>'home/index/detail',
    '/edit/task/:id'=>'home/task/edittask',
    '/preview'=>'home/task/preview',
    '/accept'=>'home/task/accept',
    '/pushtask'=>'home/task/pushtask',

    '/message'=>'chat/message/index',
    '/chat/:roomid'=>'chat/message/chat',
    '/sendmsg'=>'chat/message/sendmsg',

    '/article'=>'home/article/index',
    '/read/:id'=>'home/article/read',

    '/about'=>'home/user/about',
    '/user'=>'home/user/index',
    '/user/invite'=>'home/user/invite',
    '/getqrcode'=>'home/user/enQrcode',
    '/user/cashlist'=>'home/user/cashlist',
    '/user/cash'=>'home/user/cash',
    '/user/record'=>'home/user/record',
    '/user/set'=>'home/user/set',
    '/user/close'=>'home/user/close',
  	'/user/invites'=>'home/user/invites',
    '/mytask'=>'home/user/mytask',
    '/publish'=>'home/user/publish',
  	'/order/:tid'=>'home/order/detail',
    '/orders/:oid'=>'home/order/info',
    '/recharge'=>'home/order/recharge',
  	'/pay/paydo'=>'home/pay/paydo',
    '/pay/payResult'=>'home/pay/payResult',
  
    '/msg'=>'home/user/message',
    '/msginfo/:id'=>'home/user/msginfo',


    '/login'=>'home/login/index',
    '/reg'=>'home/login/reg',
    '/regs/:uid'=>'home/login/reg',
  	'/forpwd'=>'home/login/forpwd',
    '/down'=>'home/login/downApp',
  
  	'admin/$' => 'admin/index/index',
    'admin/login$' => 'admin/index/index',
    'admin/login/index' => 'admin/index/index',
    '/ccwmage/$' => 'admin/login/login',
];
