<?php
namespace app\home\controller;
use think\Db;
use think\Request;
use think\Controller;

class UpFile extends Base
{
    public function uploads(){
        // 获取上传文件表单字段名
        $fileKey = array_keys(request()->file());
        // 获取表单上传文件
        $file = request()->file($fileKey['0']);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move('upload');
        if($info){
            $result['code'] = 1;
            $result['info'] = '图片上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $result['url'] = '/upload/' . $path;

            return $result;
        }else{
            $result['code'] =0;
            $result['info'] =  $file->getError();
            $result['url'] = '';
            return $result;
        }
    }
}