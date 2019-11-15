<?php
namespace app\home\controller;

use app\admin\model\RecordModel;
use app\admin\model\UserModel;
use think\Session;

class Login extends Base
{
    public function index()
    {
        if(request()->post()){
            $data = input('post.');
            $user = UserModel::where('tel',$data['tel'])->find();
            if(!$user){
                return $this->getReturn(2,'手机号不存在！');
            }
            if($user['password'] != pswCrypt($data['password'])){
                return $this->getReturn(1,'密码错误！');
            }
            $res = UserModel::where('tel',$data['tel'])->update(['last_time'=>time(),'last_ip'=>request()->ip()]);
            if($res){
                \think\Session::set('uid',$user['id']);
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'登陆失败！请重试');
            }
        }
        $this->assign('title','登陆');
        return $this->fetch();
    }
    public function reg($uid = null){
        if(request()->post()){
            $data = input('post.');
            $user = UserModel::where('tel',$data['tel'])->find();
            if($user){
                return $this->getReturn(2,'手机号已存在！');
            }
            $code = Cookie('code');
            if($data['code'] != $code){
                return $this->getReturn(1,'验证码错误');
            }
            unset($data['code']);
            if($data['invite'] == ''){
                $data['invite'] = null;
            }
          	$data['avatar'] = sysconf('site_logo');
            $data['password'] = pswCrypt($data['password']);
            $data['add_time'] = time();
            $data['last_time'] = time();
            $data['last_ip'] = request()->ip();
            $res = UserModel::insertGetId($data);
            if($data['invite'] != '' && sysconf('user_invite_give') > 0 || $data['invite'] != '' && sysconf('user_invite_give') != '' || $data['invite'] != '' && sysconf('user_invite_give') != null) {
                $invite = UserModel::field('id,money,sum')->find($data['invite']);
                $money = $invite['money'] + sysconf('user_invite_give');
                UserModel::where('id', $data['invite'])->update(['money' =>$money, 'sum'=>$invite['sum'] + sysconf('user_invite_give')]);
                RecordModel::insert(['uid' => $data['invite'],'lev'=>$res,'money'=>sysconf('user_invite_give'),'moneys'=>$money,'ctime'=>time(),'type'=>4,'mode'=>'+','remark'=>'邀请下级' . $res . '获得奖励' . sysconf('user_invite_give') . '元']);
            }
            if($res){
                Session::set('uid',$res);
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'注册失败，请稍后再试！');
            }
        }
        $this->assign('invite',$uid);
        $this->assign('title','注册');
        return $this->fetch();
    }
  	public function forpwd(){
        if(request()->post()){
            $data = input('post.');
            $user = UserModel::where('tel',$data['tel'])->find();
            $code = Cookie('code');
            if($data['code'] != $code){
                return $this->getReturn(1,'验证码错误');
            }

            $password = pswCrypt($data['password']);
            
            $res = UserModel::where('tel',$data['tel'])->update(['password'=>$password]);
            
            if($res){
                return $this->getReturn();
            }else{
                return $this->getReturn(1,'重置失败，请稍后再试！');
            }
        }
        $this->assign('title','重置密码');
        return $this->fetch();
    }
    public function sendcode(){
        $data = input('post.');
        $code = mt_rand(000000,999999);
        $time = "5";
        $pwd = md5(sysconf('sms_mm'));
        $statusStr = array(
            "0" => "短信发送成功",
            "-1" => "短信通道参数不全",
            "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
            "30" => "短信通道密码错误",
            "40" => "账号不存在",
            "41" => "余额不足",
            "42" => "帐户已过期",
            "43" => "IP地址限制",
            "50" => "内容含有敏感词"
        );
        $smsapi = "http://api.smsbao.com/";
        $user = sysconf('sms_id'); //短信平台帐号
        $pass = $pwd; //短信平台密码
        $content= "【" . sysconf('sms_sign') . "】您的验证码为{$code}，请于{$time}分钟内输入。如非本人操作，请忽略此短信。";//要发送的短信内容
        $phone = $data['tel'];//要发送短信的手机号码
        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);

        $result = file_get_contents($sendurl) ;
        if($result == 0){
            cookie("code",$code, 600);
            return json(['code'=>0,'msg'=>'发送成功！']);
        }else{
            return json(['code'=>1,'msg'=>$statusStr[$result]]);
        }
    }
    public function downApp(){
        if(getOs() == 'IOS'){
            header("location:". sysconf('site_app_ios'));
        }else{
            header("location:". sysconf('site_app'));
        }
    }
}
