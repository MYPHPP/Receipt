<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class ServiceModel extends Model
{
    protected $table="box_service";

    public function service_list($where,$min,$max,$page,$pageSize){
        $result = Db::name("service")
            ->where($where)
            ->whereTime('add_time','between',[$min,$max])
            ->order('add_time desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }
}
