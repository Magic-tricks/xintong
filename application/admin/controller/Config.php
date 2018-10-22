<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/1
 * Time: 17:30
 */

namespace app\admin\controller;

class Config extends Common
{
    public function index(){
        if(request()->isPost()){
            $data=input('post.');
            //获取上传文件对象
            $file=input('file.logoimg');
            if($file){
                $data['logo']=$this->uploadimg($file);
            }
            //判断配置表中是否有记录，没有的话新增，有的话直接修改
            $result=db('config')->find();
            if(!$result){
                db('config')->insert(['config'=>json_encode($data,JSON_UNESCAPED_UNICODE)]);
            }else{
                $result=db('config')->where('id',$result['id'])->update(['config'=>json_encode($data,JSON_UNESCAPED_UNICODE)]);
                if($result===false)
                {
                    $this->error('修改失败','config/index');
                }
            }
        }
        //读取配信息
        $res=db('config')->find();
        //分配模板变量
        $config=json_decode($res['config'],true);//把网站配置json字符串转换成数组
        $this->assign('config',$config);
        return view();
    }

    protected  function loadimg($file)
    {
        if($file){
            //上传图片
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads','logo');
            //获取服务器上的文件路径
            $path=$info->getSaveName();
            return $path;
        }
    }
}