<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;

class UpFiles extends Base
{
    public function upload(){
        // 获取表单上传文件
        $file = request()->file('file');
        // 移动到框架应用根目录/public/upload/ 目录下
        $name= $file->getFilename();

        $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move('uploads/');
        if($info){
            $result['code'] = 1;
            $result['info'] = '图片上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $result['url'] = '/uploads/'. $path;
            return $result;
        }else{
            // 上传失败获取错误信息
            $result['code'] =0;
            $result['info'] =  $file->getError();
            $result['url'] = '';
            return $result;
        }
    }
    public function uploads(){
        // 获取表单上传文件
        $file = request()->file('file');
        // 移动到框架应用根目录/public/upload/ 目录下
        $name= $file->getFilename();

        $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move('uploads/task');
        if($info){
            $result['code'] = 1;
            $result['info'] = '图片上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $result['url'] = '/uploads/task/'. $path;
            return $result;
        }else{
            // 上传失败获取错误信息
            $result['code'] =0;
            $result['info'] =  $file->getError();
            $result['url'] = '';
            return $result;
        }
    }
}