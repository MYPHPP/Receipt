<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class TaskOrderModel extends Model
{
    protected $table="box_task_order";
    public function task_order_list($where,$state,$min,$max,$page,$pageSize){
        $result = \think\Db::name("task_order")
            ->where($state)
            ->where($where)
            ->whereTime('ctime','between',[$min,$max])
            ->order('ctime desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }
    public function update_order_status($id,$status,$msg=null){
        $order = \app\admin\model\TaskOrderModel::get($id);
        if(!$order){
            return ['code'=>1,'msg'=>'订单不存在！'];
        }
        if($order['status'] != 2){
            return ['code'=>1,'msg'=>'订单状态不正确！'];
        }
        $roomid = base64_encode($order['jid'] . get_user_info($order['jid'],'tel') . $order['tid']);
        switch ($status){
            case '0':
                if($order['invite'] != '' && $order['invite_money'] > 0 || $order['invite'] != 0 && $order['invite_money'] > 0){
                    $invite = \app\admin\model\UserModel::field('id,money,sum')->find($order['invite']);
                    $money = $invite['money'] + $order['invite_money'];
                    $sum = $invite['money'] + $order['invite_money'];
                    \app\admin\model\UserModel::where('id',$invite['id'])->update(['money'=>$money,'sum'=>$sum]);
                    \app\admin\model\RecordModel::insert(['uid'=>$invite['id'],'tid'=>$order['tid'],'lev'=>$order['jid'],'money'=>$order['invite_money'],'moneys'=>$money,'type'=>4,'mode'=>'+','ctime'=>time(),'remark'=>'下级完成任务返佣' . $order['invite_money'] . '元']);
                    
                  	if(sysconf('user_invite') != 1){
                      	$this->reward_invite($order['invite']);
                    }
                }
                $user = \app\admin\model\UserModel::field('id,money,sum')->find($order['jid']);
                $money = $user['money'] + $order['money'];
                $sum = $user['money'] + $order['money'];
                $success = \think\Db::name('user_order')->where('uid',$order['jid'])->find();
                $res = null;
                //启动事务
                \think\Db::startTrans();
                try {
                    if($order['uid'] != 0 || $order['uid'] != '' || $order['uid'] != null){
                        $muser = \app\admin\model\UserModel::field('id,bial,d_bial')->find($order['uid']);
                        \app\admin\model\RecordModel::insert(['uid'=>$muser['id'],'tid'=>$order['tid'],'money'=>$order['money'],'moneys'=>$muser['d_bial'] - $order['money'],'type'=>2,'mode'=>'-','ctime'=>time(),'remark'=>'用户' . $order['jid'] . '订单' . $order['id'] . '审核通过！已冻结保证金扣除发放用户佣金' . $order['money'] . '元(后台审核)']);
                        $mout = ( $order['money'] + $order['invite_money'] ) * sysconf('site_mout') / 100 ;
                        \app\admin\model\UserModel::where('id',$order['uid'])->update(['d_bial'=>$muser['d_bial'] - $order['money'] - $order['invite_money'] - $mout]);
                        \app\admin\model\RecordModel::insert(['uid'=>$muser['id'],'tid'=>$order['tid'],'money'=>$mout,'moneys'=>$muser['d_bial'] - $mout,'type'=>3,'mode'=>'-','ctime'=>time(),'remark'=>'订单' . $order['id'] . '审核通过冻结保证金扣收服务费:' . $mout . '元']);
                    }
                    \app\admin\model\UserModel::where('id',$order['jid'])->update(['money'=>$money,'sum'=>$sum]);
                    \app\admin\model\RecordModel::insert(['uid'=>$user['id'],'tid'=>$order['tid'],'invite'=>$order['invite'],'money'=>$order['money'],'moneys'=>$money,'type'=>1,'mode'=>'+','ctime'=>time(),'remark'=>'完成任务获得佣金' . $order['money'] . '元']);
                    if(!$success){
                        \think\Db::name('user_order')->insert(['uid'=>$order['jid'],'tid'=>$order['tid']]);
                    }else{
                        $tid = $success['tid'] . "," . $order['tid'];
                        \think\Db::name('user_order')->where('uid',$order['jid'])->update(['tid'=>$tid]);
                    }
                    \app\admin\model\TaskModel::where('id',$order['tid'])->setInc('passnum');
                    \app\chat\model\ChatModel::insert(['tid'=>$order['tid'],'fid'=>0,'toid'=>$order['jid'],'content'=>'恭喜！您的订单已经审核通过！赶紧尝试其他任务吧！该对话内容将在24小时后自动删除！','time'=>time(),'isonline'=>0,'type'=>'save','foid'=>$order['uid'],'roomid'=>$roomid,'state'=>1,'txt'=>'system']);
                    $res = \app\admin\model\TaskOrderModel::where('id',$id)->update(['status'=>0,'stime'=>time(),'ptime'=>time()]);
                    // 提交事务
                    \think\Db::commit();
                } catch (\Exception $e) {
                    //回滚
                    \think\Db::rollback();
                }
                break;
            default:
                \app\admin\model\TaskModel::where('id',$order['tid'])->setDec('jnum');
                \app\chat\model\ChatModel::insert(['tid'=>$order['tid'],'fid'=>0,'toid'=>$order['jid'],'content'=>'抱歉！您的订单未通过审核！驳回原因：' . $msg . '。请尝试其他任务吧！如有疑问可在此咨询悬赏主！若您无发起对话，对话内容将在24小时后删除！','time'=>time(),'isonline'=>0,'type'=>'save','foid'=>$order['uid'],'roomid'=>$roomid,'state'=>1,'txt'=>'system']);
                $res = \app\admin\model\TaskOrderModel::where('id',$id)->update(['status'=>3,'stime'=>time(),'ptime'=>time()]);
                break;
        }
        \app\chat\model\MessageModel::where('roomid',$roomid)->update(['del'=>strtotime(date('Y-m-d H:i:s',strtotime('+1 day')))]);
        if($res){
            return ['code'=>0,'msg'=>'审核成功！'];
        }else{
            return ['code'=>1,'msg'=>'审核失败！'];
        }
    }
    public function reward_invite($invite){
        $reward = \think\Db::name('user_reward')->where('uid',$invite)->find();
        if(!$reward){
            $invite_num = \app\admin\model\UserModel::where(array('invite'=>$invite,'status'=>0))->count();
            if($invite_num >= sysconf('user_invite_num')){
                $invite_money = \app\admin\model\RecordModel::where(array('uid'=>$invite,'type'=>4,'mode'=>'+'))->where("tid != ''")->sum('money');
                if($invite_money > sysconf('user_invite_sum')){
                    $user = \app\admin\model\UserModel::field('id,money,sum')->find($invite);
                    \app\admin\model\UserModel::where('id',$invite)->update(['money'=>$user['money'] + sysconf('user_invite_money'),'sum'=>$user['sum'] + sysconf('user_invite_money')]);
                    \app\admin\model\RecordModel::insert(['uid'=>$invite,'money'=>sysconf('user_invite_money'),'moneys'=>$user['money'] + sysconf('user_invite_money'),'type'=>4,'mode'=>'+','ctime'=>time(),'remark'=>'完成邀请任务！获得奖励：' . sysconf('user_invite_money') . '元']);
                    \think\Db::name('user_reward')->insert(['uid'=>$invite,'invite'=>$invite,'money'=>sysconf('user_invite_money'),'status'=>0,'ctime'=>time()]);
                }
            }
        }
    }
}
