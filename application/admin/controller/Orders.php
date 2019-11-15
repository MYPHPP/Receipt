<?php

namespace app\admin\controller;

use app\admin\model\CashModel;
use app\admin\model\RecordModel;
use app\admin\model\TaskOrderModel;
use app\admin\model\UserModel;
use think\Db;
use think\Request;

class Orders extends Base
{
    /*
     * 列表页
     */
    public function index()
    {
        if (\request()->isPost()){
            $min = !empty($_POST["logmin"]) ? strtotime($_POST["logmin"]) : strtotime(date('Y-m-1 00:00:00'));
            $max = !empty($_POST["logmax"]) ? strtotime($_POST["logmax"]) : strtotime(date('Y-m-d 23:59:59'));
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $where = null;
            if (!empty($keyword)) {
                $where["tid|uid|jid|tname"] = array("like", "%$keyword%");
            }
            $state = null;
            if (!empty($status)) {
                $state = "status in ($status)";
            }
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $product = new TaskOrderModel();
            $list = $product->task_order_list($where,$state,$min,$max,$page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['uid'] = $v['uid'] == 0 ? "系统" : $v['uid'];
                $list['data'][$k]['ctime'] = date('Y-m-d H:i:s', $v['ctime']);
                $list['data'][$k]['jtime'] = $v['jtime'] == null ? "" : date('Y-m-d H:i:s',$v['jtime']);
                $list['data'][$k]['stime'] = date('Y-m-d H:i:s',$v['stime']);
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("order-list");
    }
    public function info(){
        $oid = input('oid');
        $data = Db::name('task_data')->where(array('oid'=>$oid))->select();
        foreach ($data as $k=>$v){
            $data[$k]['yz'] = explode(',',$v['content']);
        }
        $this->assign('data',$data);
        return $this->fetch('order-info');
    }
    public function updateOrderStatus(){
        $data = input('post.');
        $msg = isset($data['msg']) ? $data['msg'] : '';
        if(!empty($data['type'])){
            $model = new CashModel();
            $res = $model->update_cash_status($data['id'],$data['status'],$msg);
        }else{
            $model = new TaskOrderModel();
            $res = $model->update_order_status($data['id'],$data['status'],$msg);
        }
        return $res;
    }
}
