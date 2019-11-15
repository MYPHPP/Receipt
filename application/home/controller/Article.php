<?php
namespace app\home\controller;

use app\admin\model\ArticleModel;
use think\Controller;

class Article extends Base
{
    public function index()
    {

        $article = ArticleModel::where('status',0)->order('sort desc')->order('add_time desc')->select();
        foreach ($article as $k=>$v){
            $article[$k]['content'] = article_content($v['content']);
        }
        $this->assign('article',$article);
        $this->assign('empty','<div class="no-msg p-center p-img"><img src="/static/home/img/no-msg.png"><p class="p97">还没有任何资讯</p></div>');
        $this->assign('title','资讯中心');
        return $this->fetch();
    }
    public function read($id){
        $data = ArticleModel::get($id);
        $this->assign('data',$data);
        $this->assign('title',$data['title']);
        return $this->fetch();
    }
}
