<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class MessageModel extends Model
{
    protected $table="box_message";

    public function message_list($where,$min,$max,$page,$pageSize){
        $result = Db::name("message")
            ->where($where)
            ->whereTime('ctime','between',[$min,$max])
            ->order('ctime desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }
}
