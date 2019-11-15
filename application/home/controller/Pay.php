<?php
namespace app\home\controller;

use app\admin\model\PayModel;
use app\admin\model\RecordModel;
use app\admin\model\UserModel;
use think\Db;

class Pay extends Base
{
    public function creat($sn,$money){
        $mid = sysconf('pay_mid');
        $apikey = sysconf('pay_key');
        $param = '商户充值'.$sn;
        $type = 1;
        $notifyUrl = sysconf('site_url') . 'pay/paydo';
        $returnUrl = sysconf('site_url') . 'pay/payResult';

        $sign = md5($mid . $sn . $param . $type . $money . $apikey);

        $urls = 'mid=' . $mid . '&payId=' . $sn . '&type=1&price=' . $money . '&param=' . $param . '&isHtml=1&notifyUrl=' . urlencode($notifyUrl) . '&returnUrl=' . urlencode($returnUrl);

        $query = $urls . '&sign=' . $sign;
        $url = "http://api.pay.netchu.cn/createOrder/?{$query}"; //支付页面
        return $this->getReturn(0,'即将跳转支付页面，请扫码付款！',$url);
    }
    public function payResult()
    {
        echo "支付成功";
        header("Refresh:0,Url=/user");
    }
    public function paydo(){
        $mid = sysconf('pay_mid');
        $apikey = sysconf('pay_key');
        $payId = input('payId');//商户订单号
        $param = input('param');//创建订单的时候传入的参数
        $type = input('type');//支付方式 ：微信支付为1 支付宝支付为2
        $price = input('price');//订单金额
        $reallyPrice = input('reallyPrice');//实际支付金额
        $sign = input('sign');//校验签名，计算方式 = md5(payId + param + type + price + reallyPrice + 通讯密钥)
        $info = PayModel::where('sn',$payId)->find();
        $_sign =  md5($mid . $info['sn'] . $info['param'] . $type . $info['money'] . $reallyPrice . $apikey);

        if (!$payId || $sign != $_sign) { //不合法的数据
            exit('fail');  //返回失败 继续补单
        } else { //合法的数据
            //验证刷新支付状态
            if(!$info){
                exit('fail');
            }else if($info['status']==0){
                exit('success');
            }else{
                PayModel::where('sn',$payId)->update(['ptime'=>time(),'status'=>0]);
                $user = UserModel::field('bial')->find($info['uid']);
                RecordModel::insert(['uid'=>$info['uid'],'money'=>$info['money'],'moneys'=>$user['bial'] + $info['money'],'type'=>2,'mode'=>'+','ctime'=>time(),'remark'=>$info['param']]);
                UserModel::where('id',$info['uid'])->update(['bial'=>$user['bial'] + $info['money']]);
                exit('success');
            }
        }
    }
}
