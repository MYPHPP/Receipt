<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class ArticleModel extends Model
{
    protected $table="box_article";

    public function article_list($where,$min,$max,$page,$pageSize){
        $result = Db::name("article")
            ->where($where)
            ->whereTime('add_time','between',[$min,$max])
            ->order('add_time desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $result;
    }

}
