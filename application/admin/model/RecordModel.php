<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class RecordModel extends Model
{
    protected $table="box_record";
    public function record_list($where,$min,$max,$page,$pageSize){
        $result = \think\Db::name("record")
            ->where($where)
            ->whereTime('ctime','between',[$min,$max])
            ->order('ctime desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }
    public function cash_list($where,$min,$max,$page,$pageSize){
        $result = \think\Db::name("cash")
            ->where($where)
            ->whereTime('ctime','between',[$min,$max])
            ->order('ctime desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }
    public function sys_sum(){
        return RecordModel::where(array('mode'=>'+'))->sum('money');
    }
    public function cash_sum(){
        return CashModel::where('status',0)->sum('money');
    }
    public function sys_money(){
        return UserModel::sum('money');
    }
    public function order_sum(){
        return TaskOrderModel::count();
    }
    public function order_pass(){
        return TaskOrderModel::where('status',0)->count();
    }
    public function order_offpass(){
        return TaskOrderModel::where('status',3)->count();
    }
    public function order_today($min,$max){
        return TaskOrderModel::whereTime('ctime','between',[$min,$max])->count();
    }
    public function order_today_pass($min,$max){
        return TaskOrderModel::where('status',0)->whereTime('ctime','between',[$min,$max])->count();
    }
    public function order_today_offpass($min,$max){
        return TaskOrderModel::where('status',3)->whereTime('ctime','between',[$min,$max])->count();
    }
    public function order_today_onpass($min,$max){
        return TaskOrderModel::where('status',2)->whereTime('ctime','between',[$min,$max])->count();
    }
    public function order_today_money($min,$max){
        $money = TaskOrderModel::where('status',0)->whereTime('ctime','between',[$min,$max])->sum('money');
        $invite_money = TaskOrderModel::where('status',0)->whereTime('ctime','between',[$min,$max])->sum('invite_money');
        return $money + $invite_money;
    }
    public function cash_today_onpass($min,$max){
        return CashModel::where('status',1)->whereTime('ctime','between',[$min,$max])->sum('money');
    }
    public function order_stoday($min,$max){
        return TaskOrderModel::whereTime('ctime','between',[$max,$min])->count();
    }
    public function order_stoday_pass($min,$max){
        return TaskOrderModel::where('status',0)->whereTime('ctime','between',[$max,$min])->count();
    }
    public function order_stoday_offpass($min,$max){
        return TaskOrderModel::where('status',3)->whereTime('ctime','between',[$max,$min])->count();
    }
}
