<?php

namespace app\admin\controller;

use app\admin\model\StepModel;
use app\admin\model\TaskModel;
use app\admin\model\TypeModel;
use think\Db;
use think\Request;

class Tasks extends Base
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
                $where["id|name|title|remark"] = array("like", "%$keyword%");
            }
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $model = new TaskModel();
            $list = $model->task_list($where,$min,$max,$page,$pageSize);
            foreach ($list['data'] as $k => $v) {
                $list['data'][$k]['add_time'] = date('Y-m-d H:i:s', $v['add_time']);
                $list['data'][$k]['tname'] = Db::name('task_type')->where('id',$v['type'])->field('name')->value('name');
                $list['data'][$k]['uid'] = $v['uid'] == 0 ? "系统" : $v['uid'];
            }
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch("task-list");
    }
    public function addTask(){
        if(\request()->post()){
            $data = \request()->except('file');
            $step = StepModel::where(array('tid'=>null,'uid'=>0))->find();
            if(!$step){
                return $this->getReturn(1,'请添加任务步骤！');
            }
            if(empty($data['icon'])){
                $data['icon'] = null;
            }else{
                $data['icon'] = implode(',',$data['icon']);
            }
            $data['column'] = TypeModel::where('id',$data['type'])->value('column');
            $data['add_time'] = time();
            $data['uid'] = 0;
            $tid = TaskModel::insertGetId($data);
            $res = StepModel::where(array('tid'=>null,'uid'=>0))->update(['tid'=>$tid]);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'添加失败！');
            }
        }
        $type = TypeModel::where('status',0)->select();
        $this->assign('type',$type);
        $data = StepModel::where(array('tid'=>null,'uid'=>0))->select();
        $this->assign('data',$data);
        return $this->fetch('task-add');
    }
    public function editTask(){
        $id = input('id');
        if(\request()->post()){
            $data = \request()->except('file');
            if(empty($data['icon'])){
                $data['icon'] = null;
            }else{
                $data['icon'] = implode(',',$data['icon']);
            }
            $data['add_time'] = time();
            $data['column'] = TypeModel::where('id',$data['type'])->value('column');
            $res = TaskModel::where('id',$id)->update($data);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'修改失败！');
            }
        }
        $task = TaskModel::get($id);
        $task['icon'] = explode(',',$task['icon']);
        $this->assign('task',$task);
        $type = TypeModel::where('status',0)->select();
        $this->assign('type',$type);
        $data = StepModel::where(array('tid'=>$id,'uid'=>0))->select();
        $this->assign('data',$data);
        return $this->fetch('task-edit');
    }
    public function addStep(){
        $data = request()->except('file');
        $data['uid'] = 0;
        $data['ctime'] = time();
        $res = StepModel::insertGetId($data);
        if($res){
            return $this->getReturn(0,'创建成功！',$res);
        }else{
            return $this->getReturn(['code'=>1,'msg'=>'创建失败！请重试']);
        }
    }
    public function editstep(){
        if(request()->post()){
            $data = input('post.');
            $step = \app\admin\model\StepModel::get($data['id']);
            if(!$step){
                return $this->getReturn(1,'数据错误，请刷新后重试！');
            }
            if(!empty($data['txt'])){
                $res = \app\admin\model\StepModel::where('id',$data['id'])->update(['mark'=>$data['mark'],'txt'=>$data['txt']]);
            }else{
                $res = \app\admin\model\StepModel::where('id',$data['id'])->update(['mark'=>$data['mark']]);
            }
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'修改失败！请稍后再试！');
            }
        }
    }
    public function delStep(){
        if(\request()->post()){
            $id = input('id');
            $step = StepModel::get($id);
            if(!$step){
                return $this->getReturn(1,'该步骤不存在！请刷新页面');
            }
            $res = Db::name('task_step')->delete($id);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'删除失败');
            }
        }
    }
}
