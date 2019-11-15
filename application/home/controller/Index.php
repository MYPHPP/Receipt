<?php
namespace app\home\controller;

use app\admin\model\AdModel;
use app\admin\model\ServiceModel;
use app\admin\model\StepModel;
use app\admin\model\TaskModel;
use app\admin\model\TaskOrderModel;
use app\admin\model\TypeModel;
use app\admin\model\UserModel;
use think\Db;

class Index extends Base
{
    public function index()
    {
        $banner = AdModel::where('status',0)->select();
        $this->assign('banner',$banner);
        $oid = \think\Db::name('user_order')->where('uid',$this->uid())->value('tid');
        $order = $oid == null ? null : "id not in ($oid)";
        $task = TaskModel::where(array('status'=>0,'is_hot'=>0))
            ->where("number != jnum")
            //->where($order)
            ->order('sort desc')
            ->order('add_time desc')
            ->select();
        foreach ($task as $k=>$v){
            $task[$k]['icon'] = $v['icon'] == null ? null : explode(',',$v['icon']);
            $task[$k]['price'] = get_user_info($this->uid(),'invite') == null ? $v['price'] : $v['price'] - $v['price'] * sysconf('task_invite_mout') / 100;
            $task[$k]['avatar'] = $v['uid'] != 0 ? get_user_info($v['uid'],'avatar') : sysconf('site_logo');
            $task[$k]['tname'] = Db::name('task_type')->where('id',$v['type'])->field('name')->value('name');
        }
        $this->assign('task',$task);
        $this->assign('title','首页');
        return $this->fetch();
    }
    public function task()
    {
        $column = input('column');
        if($column == 0 || $column == null || $column == ''){
            $column = "1,2";
            $where = null;
        }else{
            $where = array("column"=>$column);
        }
        $top = TaskModel::where(array('status'=>0,'is_top'=>0))->field('id,title,price,sort')->select();
        $this->assign('top',$top);
        $oid = \think\Db::name('user_order')->where('uid',$this->uid())->value('tid');
        $order = $oid == null ? null : "id not in ($oid)";
        $task = TaskModel::where($where)
            ->where("number != jnum")
            ->where(array('status'=>0))
            ->order('sort desc')
            ->order('add_time desc')
            ->select();
        foreach ($task as $k=>$v){
            $task[$k]['icon'] = $v['icon'] == null ? null : explode(',',$v['icon']);
            $task[$k]['price'] = get_user_info($this->uid(),'invite') == null ? $v['price'] : $v['price'] - $v['price'] * sysconf('task_invite_mout') / 100;
            $task[$k]['avatar'] = $v['uid'] != 0 ? get_user_info($v['uid'],'avatar') : sysconf('site_logo');
            $task[$k]['tname'] = Db::name('task_type')->where('id',$v['type'])->field('name')->value('name');
        }
        $this->assign('task',$task);
        $type = TypeModel::where($where)
            ->where(array('status'=>0))
            ->select();
        $this->assign('type',$type);
        $this->assign('column',input('column') == null ? 0 : $column);
        $this->assign('title','任务大厅');
        return $this->fetch('task-list');
    }
    public function gettask(){
        if(request()->post()){
            $data = input('post.');
            if(empty($data['type'])){
                $where = null;
            }else{
                $ids = implode(',',$data['type']);
                $where = "type in ($ids)";
            }
            switch ($data['order']){
                case 'new':
                    $task = TaskModel::where($where)->where(array('status'=>0))->order('add_time desc')->select();
                    break;
                case 'price':
                    $task = TaskModel::where($where)->where(array('status'=>0))->order('price desc')->select();
                    break;
                case 'hot':
                    $task = TaskModel::where($where)->where(array('status'=>0))->order('jnum desc')->select();
                    break;
                default:
                    $task = TaskModel::where($where)->where(array('status'=>0))->order('sort desc')->select();
                    break;
            }
            foreach ($task as $k=>$v){
                $task[$k]['icon'] = $v['icon'] == null ? null : explode(',',$v['icon']);
                $task[$k]['price'] = get_user_info($this->uid(),'invite') == null ? $v['price'] : $v['price'] - $v['price'] * sysconf('task_invite_mout') / 100;
                $task[$k]['avatar'] = $v['logo'] == '' ? $v['uid'] != 0 ? get_user_info($v['uid'],'avatar') : sysconf('site_logo') : $v['logo'];
                $task[$k]['tname'] = TypeModel::where('id',$v['type'])->field('name')->value('name');
            }
            return $this->getReturn(0,'成功',$task);
        }
    }
    public function detail($id){
        $task = TaskModel::get($id);
        $task['tname'] = TypeModel::where('id',$task['type'])->field('name')->value('name');
        $task['price'] = get_user_info($this->uid(),'invite') == null ? $task['price'] : $task['price'] - $task['price'] * sysconf('task_invite_mout') / 100;
        $task['avatar'] = $task['uid'] != 0 ? get_user_info($task['uid'],'avatar') : sysconf('site_logo');
        $this->assign('task',$task);
        $data = StepModel::where('tid',$task['id'])->select();
        $this->assign('data',$data);
        $order = TaskOrderModel::where(array('tid'=>$id,'jid'=>$this->uid()))->field('id,status')->order('id desc')->find();
        $roomid = base64_encode($this->uid() . get_user_info($this->uid(),'tel') . $task['id']);
        $this->assign('roomid',$roomid);
        $rand = TaskModel::where(array('status'=>0))->orderRaw('rand()')->field('id')->limit(1)->find();
        $this->assign('rand',$rand);
        $this->assign('order',$order == '' ? 0 : $order);
        $this->assign('title','任务详情');
        return $this->fetch('task-detail');
    }
    public function video(){

        $this->assign('title','做单视频');
        return $this->fetch();
    }
    public function service($id){
        $service = ServiceModel::get($id);
        $this->assign('title',$service['title']);
        $this->assign('data',$service);
        return $this->fetch('read-detail');
    }
}
