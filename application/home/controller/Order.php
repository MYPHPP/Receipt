<?php
namespace app\home\controller;


use app\admin\model\TaskModel;
use app\admin\model\TaskOrderModel;
use think\Db;

class Order extends Base
{
    public function recharge(){
        if(\request()->isPost()){
            $data = input('post.');
            $data['sn'] = "R" . date('YmdHis') . mt_rand(100,999);
            $data['ctime'] = time();
            $data['uid'] = $this->uid();
            $data['param'] = '商户充值'.$data['sn'];
            $res = Db::name('pay')->insert($data);
            if($res){
                $model = new Pay();
                return $model->creat($data['sn'],$data['money']);
            }else{
                return $this->getReturn(1,'创建订单失败！请重试');
            }
        }
        $this->assign('title','充值');
        return $this->fetch();
    }
    public function detail($tid){
        if(\request()->isPost()){
            $data = input('post.');
            $info = TaskOrderModel::field('uid')->find($data['id']);
            if($info['uid'] != $this->uid()){
                return $this->getReturn(1,'权限不足！');
            }
            $model = new TaskOrderModel();
            return $model->update_order_status($data['id'],$data['status']);
        }
        $order = TaskOrderModel::where(array('tid'=>$tid))->select();
        $this->assign('order',$order);
        $this->assign('empty','<div class="no-msg p-center p-img"><img src="/static/home/img/no-msg.png"><p class="p97">您还没有订单</p></div>');
        $this->assign('title','订单列表');
        return $this->fetch('order-list');
    }
    public function info($oid){
        $data = Db::name('task_data')->where(array('oid'=>$oid))->select();
        foreach ($data as $k=>$v){
            $data[$k]['yz'] = explode(',',$v['content']);
        }
        $this->assign('data',$data);
        $this->assign('title','订单详情');
        return $this->fetch('order-info');
    }
}
