<?php
namespace app\home\controller;

use app\admin\model\CloseOrderModel;
use app\admin\model\TaskModel;
use app\admin\model\TaskOrderModel;
use app\admin\model\UserModel;
use app\chat\model\ChatModel;
use think\Controller;
use think\Session;

class Base extends Controller
{
    public function _initialize()
    {
        if($this->uid() == null){
            $user = array(
                'close' => 1,
                'id'=>null
            );
        }else{
            $user = \app\admin\model\UserModel::get($this->uid());
        }
        $this->assign('user',$user);
        $controller = \request()->controller();
        $this->assign('controller',strtolower($controller));
        $action = \request()->action();
        $this->assign('action',strtolower($action));
    }
    public function uid(){
        return \think\Session::get('uid');
    }
    public function login(){
        $uid = $this->uid();
        if ($uid) {
            $user = \app\admin\model\UserModel::where('id',$uid)->field('status')->find();
            if(!$user){
                $this->redirect('/login');
            }
            if($user['status'] == 1){
                \think\Session::set('uid',"");
                $this->redirect('/login');
            }
        }else{
            $this->redirect('/login');
        }
    }
    public function getReturn($code = 0,$msg = "成功",$data = null){
        return array("code"=>$code,"msg"=>$msg,"data"=>$data);
    }
    public function closeOrder(){
        $order = \app\admin\model\TaskOrderModel::where(array('status'=>1))->select();
        foreach ($order as $k => $v){
            $time = \app\admin\model\TaskModel::where('id',$v['tid'])->value('outtime');
            if(time() - $v['ctime'] > $time){
                \app\admin\model\CloseOrderModel::insert(['tid'=>$v['tid'],'tname'=>$v['tname'],'uid'=>$v['uid'],'jid'=>$v['jid'],'ctime'=>$v['ctime'],'close_time'=>time()]);
                \app\admin\model\TaskOrderModel::where('id',$v['id'])->delete();
                \app\chat\model\MessageModel::where('tid',$v['tid'])->delete();
                \app\chat\model\ChatModel::where('tid',$v['tid'])->delete();
            }
        }
        $chat = \app\chat\model\MessageModel::where("del != ''")->field('id,roomid,del')->select();
        foreach ($chat as $rows){
            if($rows['del'] < time()){
                \app\chat\model\ChatModel::where('roomid',$rows['roomid'])->delete();
                \app\chat\model\MessageModel::where('roomid',$rows['roomid'])->delete();
            }
        }
      	$task = \app\admin\model\TaskModel::where('bao',1)->select();
        foreach($task as $row){
            $yongjin = \app\admin\model\RecordModel::where(array('tid'=>$row['id'],'type'=>2,'mode'=>'-'))->sum('money');
            $fuwu = \app\admin\model\RecordModel::where(array('tid'=>$row['id'],'type'=>3,'mode'=>'-'))->sum('money');
            $user = \app\admin\model\UserModel::field('bial,d_bial')->find($row['uid']);
            \app\admin\model\UserModel::where(array('id'=>$row['uid']))->update(['bial'=>$user['bial'] + $money,'d_bial'=>$user['d_bial'] - $money]);
            \app\admin\model\RecordModel::insert(['uid'=>$row['uid'],'tid'=>$row['id'],'money'=>$money,'moneys'=>$user['bial'] + $money,'type'=>3,'mode'=>'+','ctime'=>time(),'remark'=>'任务ID:' . $row['id'] . ',解冻保证金' . $money . '元']);
            \app\admin\model\TaskModel::where('id',$row['id'])->update(['bao'=>2,'bao_time'=>time()]);
        }
    }
  	function _empty(){
        header("HTTP/1.0 404 Not Found");
        return $this->fetch(ROOT_PATH . "/public/404.html");
    }
}
