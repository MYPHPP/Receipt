<?php

namespace app\admin\controller;

use app\admin\model\RecordModel;
use think\Db;
use think\Request;

class Records extends Base
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
            $where = null;
            if (!empty($keyword)) {
                $where["uid"] = array("like", "%$keyword%");
            }
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $product = new RecordModel();
            $list = $product->record_list($where,$min,$max,$page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['ctime'] = date('Y-m-d H:i:s', $v['ctime']);
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("record-list");
    }
    public function cash()
    {
        if (\request()->isPost()){
            $min = !empty($_POST["logmin"]) ? strtotime($_POST["logmin"]) : strtotime(date('Y-m-1 00:00:00'));
            $max = !empty($_POST["logmax"]) ? strtotime($_POST["logmax"]) : strtotime(date('Y-m-d 23:59:59'));
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $where = null;
            if (!empty($keyword)) {
                $where["uid"] = array("like", "%$keyword%");
            }
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $product = new RecordModel();
            $list = $product->cash_list($where,$min,$max,$page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['ctime'] = date('Y-m-d H:i:s', $v['ctime']);
                $list['data'][$k]['stime'] = date('Y-m-d H:i:s', $v['stime']);
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("record-cash");
    }
}
