<?php

namespace app\admin\controller;

use app\admin\model\OperationModel;
use app\admin\model\TaskOrderModel;
use app\common\util\QrcodeServer;
use think\Controller;
use think\Db;
use think\Request;

class System extends Base
{
    public function base(){
        if(\request()->post()){
            $data = \request()->except('file');
            foreach ($data as $k=>$v){
                $res =  Db::name('config')->where('code',$k)->update(['value'=>$v]);
            }
            return ['code'=>1,'msg'=>'保存成功！'];
        }
        $group =  ['site','user','sms','task','pay'];
        $config = \think\Db::name('config')->where('type','in',$group)->field('code,value')->column('value','code');
        $this->assign('config',json_encode($config,true));
        $this->assign('info',$config);
        return view('system-base');
    }
    /**
     * 显示资源列表   操作日志
     */
    public function operation()
    {
        $min=isset($_POST["logmin"])?strtotime($_POST["logmin"]):"";
        $max=isset($_POST["logmax"])?strtotime($_POST["logmax"]):"";
        $keyword=isset($_POST["keyword"])?$_POST["keyword"]:"";
        $where = null;
        if(!empty($keyword)){
            $where['name'] = array("like","%$keyword%");
        }
        $model=new OperationModel();
        $data=$model->Loglist($where,$min,$max);
        $num=count($data);
        $this->assign("data",$data);
        $this->assign("num",$num);
        //
        return $this->fetch("system-operation");

    }

    /*
     * 批量删除  操作日志
     */
    public function delOperation(){
        $id=input("id/a");
        $model=new OperationModel();
        $data=$model->delAll($id);
        exit(json_encode($data));
    }
    public function update(){
        $data = input('post.');
        if(!empty($data['sort'])){
            $res = Db::name($data['type'])->where('id',$data['id'])->update(['sort'=>$data['sort']]);
        }else{
            $res = Db::name($data['type'])->where('id',$data['id'])->update(['status'=>$data['status']]);
        }

        if($res){
            return $this->getReturn();
        }else{
            return $this->getReturn(1,'更新失败！');
        }
    }
    public function del(){
        $data = input('post.');
        switch($data['type']){
            case 'task':
                Db::name('msg')->where('tid',$data['id'])->delete();
                Db::name('msg_record')->where('tid',$data['id'])->delete();
                $res = Db::name('task')->delete($data['id']);
                break;
            case 'task_order':
                $order = TaskOrderModel::get($data['id']);
                Db::name('msg')->where(array('tid'=>$order['tid'],'uid'=>$order['jid']))->delete();
                Db::name('msg')->where(array('tid'=>$order['tid'],'uid'=>$order['uid']))->delete();
                Db::name('msg_record')->where(array('tid'=>$order['tid'],'toid'=>$order['jid']))->delete();
                Db::name('msg_record')->where(array('tid'=>$order['tid'],'toid'=>$order['uid']))->delete();
                $res = Db::name('task_order')->delete($data['id']);
                break;
            default:
                $res = Db::name($data['type'])->delete($data['id']);
                break;
        }
        if($res){
            return $this->getReturn();
        }else{
            return $this->getReturn(1,'删除失败！');
        }
    }
    public function enQrcode($tid){
        $url = sysconf('site_url') . "/detail/" . $tid;
        $qr_code = new QrcodeServer(['generate'=>"display","size",200]);
        $content = $qr_code->createServer($url);
        return response($content,200,['Content-Length'=>strlen($content)])->contentType('image/png');
    }
}
