<?php

namespace app\admin\controller;

use app\admin\model\AdModel;
use app\admin\model\MessageModel;
use think\Db;
use think\Request;

class Manage extends Base
{
    /*
     * 列表页
     */
    public function banner()
    {
        if (\request()->isPost()){
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $where = null;
            if (!empty($keyword)) {
                $where["id|title"] = array("like", "%$keyword%");
            }
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $model = new AdModel();
            $list = $model->banner_list($page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['ctime'] = date('Y-m-d H:i:s', $v['ctime']);
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("banner-list");
    }
    public function addBanner(){
        if(\request()->post()){
            $data = \request()->except('file');
            $data['ctime'] = time();
            $res = AdModel::insert($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'添加失败！');
            }
        }
        return $this->fetch('banner-add');
    }
    public function editBanner(){
        $id = input('id');
        if(\request()->post()){
            $data = \request()->except('file');
            $data['ctime'] = time();
            $res = AdModel::where('id',$id)->update($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'修改失败！');
            }
        }
        $info = AdModel::get($id);
        $this->assign('info',$info);
        return $this->fetch('banner-edit');
    }
    public function message()
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
            $model = new MessageModel();
            $list = $model->message_list($where,$min,$max,$page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['ctime'] = date('Y-m-d H:i:s', $v['ctime']);
                $list['data'][$k]['uid'] = $v['uid'] == 0 ? "全体通知" : $v['uid'];
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("message-list");
    }
    public function sendMsg(){
        if(\request()->post()){
            $data = \request()->except('file');
            $data['ctime'] = time();
            $res = MessageModel::insert($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'添加失败！');
            }
        }
        return $this->fetch('message-add');
    }
    public function editMsg(){
        $id = input('id');
        if(\request()->post()){
            $data = \request()->except('file');
            $data['ctime'] = time();
            $res = MessageModel::where('id',$id)->update($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'修改失败！');
            }
        }
        $info = MessageModel::get($id);
        $this->assign('info',$info);
        return $this->fetch('message-edit');
    }
}
