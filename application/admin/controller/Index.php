<?php

namespace app\admin\controller;

use app\admin\model\AdminModel;
use think\Controller;
use think\Db;
use think\Request;

class Index extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
      	if(empty(Session("admin"))){
        	if(sysconf('admin_login_path') == 'admin' || sysconf('admin_login_path') == '') {
	            $this->redirect("admin/login/login");
	        } else {
	            header("HTTP/1.1 404 Not Found");
	            return $this->fetch(ROOT_PATH . '/public/404.html');
	        }
        }
        return $this->fetch("index");

    }
    public function welcome(){
        //获取用户的登录信息
        $admin=session("admin");
        $data=AdminModel::get(["names"=>$admin]);
        $this->assign('data',$data);
        //统计信息
        $min = strtotime(date('Y-m-d'));
        $max = strtotime(date('Y-m-d 23:59:59'));
        $model = new \app\admin\model\RecordModel();
        $sys_sum = $model->sys_sum();
        $this->assign('sys_sum',$sys_sum);
        $cash_sum = $model->cash_sum();
        $this->assign('cash_sum',$cash_sum);
        $sys_money = $model->sys_money();
        $this->assign('sys_money',$sys_money);
        $order_sum = $model->order_sum();
        $this->assign('order_sum',$order_sum);
        $order_pass = $model->order_pass();
        $this->assign('order_pass',$order_pass);
        $order_offpass = $model->order_offpass();
        $this->assign('order_offpass',$order_offpass);
        $order_today = $model->order_today($min,$max);
        $this->assign('order_today',$order_today);
        $order_today_pass = $model->order_today_pass($min,$max);
        $this->assign('order_today_pass',$order_today_pass);
        $order_today_offpass = $model->order_today_offpass($min,$max);
        $this->assign('order_today_offpass',$order_today_offpass);
        $order_today_onpass = $model->order_today_onpass($min,$max);
        $this->assign('order_today_onpass',$order_today_onpass);
        $order_today_money = $model->order_today_money($min,$max);
        $this->assign('order_today_money',$order_today_money);
        $cash_today_onpass = $model->cash_today_onpass($min,$max);
        $this->assign('cash_today_onpass',$cash_today_onpass);
        $max = strtotime(date('Y-m-d 00:00:00',strtotime('-1 day')));
        $order_stoday = $model->order_stoday($min,$max);
        $this->assign('order_stoday',$order_stoday);
        $order_stoday_pass = $model->order_stoday_pass($min,$max);
        $this->assign('order_stoday_pass',$order_stoday_pass);
        $order_stoday_offpass = $model->order_stoday_offpass($min,$max);
        $this->assign('order_stoday_offpass',$order_stoday_offpass);


        return $this->fetch("welcome");
    }


}
