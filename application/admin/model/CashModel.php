<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class CashModel extends Model
{
    protected $table="box_cash";

    public function update_cash_status($id,$status,$msg = null){
        $cash = CashModel::get($id);
        if(!$cash){
            return ['code'=>1,'msg'=>'订单不存在！'];
        }
        if($cash['status'] != 1){
            return ['code'=>1,'msg'=>'订单状态异常！'];
        }
        if($status == 0){
            RecordModel::insert(['uid'=>$cash['uid'],'money'=>$cash['money'],'type'=>6,'mode'=>'-','ctime'=>time(),'remark'=>'用户提现' . $cash['money'] . '元审核通过！']);
            MessageModel::insert(['uid'=>$cash['uid'],'title'=>'提现审核通过！','content'=>'您的提现订单金额：' . $cash['money'] . '提现申请已通过，请耐心等待打款！','ctime'=>time()]);
        }else{
            switch ($cash['type']){
                case '2':
                    UserModel::where('id',$cash['uid'])->update(['bial'=>get_user_info($cash['uid'],'bial') + $cash['money']]);
                    break;
                default:
                    UserModel::where('id',$cash['uid'])->update(['money'=>get_user_info($cash['uid'],'money') + $cash['money']]);
                    break;
            }
            MessageModel::insert(['uid'=>$cash['uid'],'title'=>'提现审核驳回通知','content'=>'您的提现订单金额：' . $cash['money'] . '申请被驳回，驳回原因：' . $msg . '。如有疑问请联系客服咨询！','ctime'=>time()]);
        }
        $res = CashModel::where('id',$id)->update(['status'=>$status,'stime'=>time()]);
        if($res){
            return ['code'=>0,'msg'=>'审核成功！'];
        }else{
            return ['code'=>1,'msg'=>'审核失败！'];
        }
    }
}
