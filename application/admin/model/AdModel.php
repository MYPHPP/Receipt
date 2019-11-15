<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class AdModel extends Model
{
    protected $table="box_ad";
    public function banner_list($page,$pageSize){
        $result = Db::name("ad")
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }
}
