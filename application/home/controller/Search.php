<?php
namespace app\home\controller;


use app\admin\model\TaskModel;
use think\Cookie;

class Search extends Base
{
    public function index()
    {
        if(request()->post()){
            Cookie::set('keyword',null);
            return json(['code'=>0]);
        }
        $keyword = input('keyword');
        if(!empty($keyword)){
            $where["id|title|name|remark"]=array("like","%$keyword%");
            $task = TaskModel::where($where)->select();
            foreach ($task as $k=>$v){
                $task[$k]['tname'] = \think\Db::name('task_type')->where('id',$v['type'])->field('name')->value('name');
                $task[$k]['avatar'] = $v['logo'] == null ? $v['uid'] != 0 ? get_user_info($v['uid'],'avatar') : sysconf('site_logo') : $v['logo'];
            }
            $this->assign('task',$task);
            $keywords = Cookie::get('keyword');
            if(!$keywords){
                Cookie::set('keyword',array(
                    0 => $keyword
                ));
            }else{
                if(!in_array($keyword,$keywords)){
                    array_push($keywords,$keyword);
                    Cookie::set('keyword',$keywords);
                }
            }
        }
        $this->assign('hidden',!empty($keyword) ? 'hidden' : "");
        $this->assign('title','搜索');
        return $this->fetch();
    }
}
