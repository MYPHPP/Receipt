<?php
namespace app\home\controller;

use app\admin\model\RecordModel;
use app\admin\model\UserModel;
use think\Controller;
use think\Cookie;
use think\Session;

class Test extends Base
{
    public function index()
    {
      	echo pswCrypt(123456);
        //session('uid',176);
      	
          //var_dump($order);
    }
}
