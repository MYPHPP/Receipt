<?php
namespace app\chat\controller;

use app\admin\model\TaskModel;
use app\admin\model\TypeModel;
use app\chat\model\ChatModel;
use app\chat\model\MessageModel;
use app\home\controller\Base;

class Message extends Base
{
    public function index()
    {
        $message = MessageModel::where('uid',$this->uid())
            ->order('ctime desc')
            ->select();
        foreach ($message as $k=>$v){
            $message[$k]['avatar'] = $v['uid'] == 0 ? sysconf('site_logo') : get_user_info($v['uid'],'avatar');
            $message[$k]['title'] = TaskModel::where('id',$v['tid'])->value('title');
            $message[$k]['content'] = chat_content($v['roomid']);
            $message[$k]['weidu'] = ChatModel::where(array('toid'=>$this->uid(),'roomid'=>$v['roomid']))->order('time desc')->limit(1)->value('state');
            if($message[$k]['weidu'] == 1){
                $message[$k]['num'] = ChatModel::where(array('toid'=>$this->uid(),'roomid'=>$v['roomid'],'state'=>1))->count();
            }
        }
        $this->assign('empty','<div class="no-msg p-center p-img"><img src="/static/home/img/no-msg.png"><p class="p97">您还没有任何消息</p></div>');
        $this->assign('message', $message);
        $this->assign('title','消息通知');
        return $this->fetch();
    }
    public function chat($roomid){
        $this->login();
        ChatModel::where(array('toid'=>$this->uid(),'roomid'=>$roomid,'state'=>1))->update(['state'=>0]);
        $msg = MessageModel::where(array('roomid'=>$roomid,'uid'=>$this->uid()))->find();
        $this->assign('msg',$msg);
        $task = TaskModel::field('id,title,price,type,name')->find($msg['tid']);
        $task['tname'] = TypeModel::where('id',$task['type'])->field('name')->value('name');
        $this->assign('task',$task);
        $chat = ChatModel::where(array('roomid'=>$roomid))->select();
        foreach ($chat as $k=>$v){
            $chat[$k]['avatar'] = $v['fid'] == 0 ? sysconf('site_logo') : get_user_info($v['fid'],'avatar');
        }
        $this->assign('chat',$chat);
        $this->assign('title','咨询任务');
        return $this->fetch();
    }
    public function sendmsg(){
        $this->login();
        if(request()->post()){
            $data = request()->except('file');
            $task = TaskModel::field('uid,status')->find($data['tid']);
            if(!$task){
                return $this->getReturn(1,'该任务不存在！无法发起对话！如有疑问请咨询客服');
            }
            if($task['status'] == 3){
                return $this->getReturn(1,'该任务已下架，无法发起对话！如有疑问请咨询客服');
            }
            if($task['uid'] == 0){
                return $this->getReturn(1,'官方订单请咨询微信客服或QQ群咨询！');
            }
            $uid = $this->uid();
            $msg = MessageModel::where(array('tid'=>$data['tid'],'uid'=>$data['toid'],'roomid'=>$data['roomid']))->find();
            if(!$msg){
                MessageModel::insert(['tid'=>$data['tid'],'fid'=>$uid,'uid'=>$data['toid'],'roomid'=>$data['roomid'],'ctime'=>time()]);
            }

            if($msg['del'] != '' && time() - $msg['del'] < 86400){
                MessageModel::where(array('roomid'=>$msg['roomid']))->update(['del'=>strtotime('+2 day',strtotime($msg['del']))]);
                ChatModel::insert(['tid'=>$data['tid'],'fid'=>0,'toid'=>$uid,'content'=>'由于您发起对话，该聊天对话内容删除时间延长48小时！','time'=>time(),'isonline'=>0,'type'=>'save','foid'=>$this->uid(),'roomid'=>$data['roomid'],'state'=>1,'txt'=>'system']);
                ChatModel::insert(['tid'=>$data['tid'],'fid'=>0,'toid'=>$data['toid'],'content'=>'由于对方发起对话，该聊天对话内容删除时间延长48小时！','time'=>time(),'isonline'=>0,'type'=>'save','foid'=>$this->uid(),'roomid'=>$data['roomid'],'state'=>1,'txt'=>'system']);
            }
            $res = ChatModel::insert(['tid'=>$data['tid'],'fid'=>$uid,'toid'=>$data['toid'],'content'=>$data['content'],'time'=>time(),'isonline'=>0,'type'=>'save','foid'=>$this->uid(),'roomid'=>$data['roomid'],'state'=>1,'txt'=>$data['txt']]);
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'发送失败！');
            }
        }
    }
}
