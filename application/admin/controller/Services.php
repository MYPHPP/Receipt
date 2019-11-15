<?php

namespace app\admin\controller;

use app\admin\model\ServiceModel;
use think\Db;
use think\Request;

class Services extends Base
{
    /*
     * 列表页
     */
    public function index()
    {
        if (\request()->isPost()){
            $min = !empty($_POST["logmin"]) ? strtotime($_POST["logmin"]) : strtotime(date('Y-1-1'));
            $max = !empty($_POST["logmax"]) ? strtotime($_POST["logmax"]) : strtotime(date('Y-12-31 23:59:59'));
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $where = null;
            if (!empty($keyword)) {
                $where["id|title"] = array("like", "%$keyword%");
            }
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $model = new ServiceModel();
            $list = $model->service_list($where,$min,$max,$page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['add_time'] = date('Y-m-d H:i:s', $v['add_time']);
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("service-list");
    }
    public function addService(){
        if(\request()->post()){
            $data = \request()->except('file');
            $data['add_time'] = time();
            $res = ServiceModel::insert($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'添加失败！');
            }
        }
        return $this->fetch('service-add');
    }
    public function editService(){
        $id = input('id');
        if(\request()->post()){
            $data = \request()->except('file');
            $data['add_time'] = time();
            $res = ServiceModel::where('id',$id)->update($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'修改失败！');
            }
        }
        $info = ServiceModel::get($id);
        $this->assign('info',$info);
        return $this->fetch('service-edit');
    }
}
