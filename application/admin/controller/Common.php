<?php
namespace app\admin\controller;

use think\Controller;
class Common extends Controller
{
    protected function _initialize()
    {
        parent::_initialize(); // 继承父类的初始化方法
        //登录状态验证
        if(!session('loginname', '', 'admin') || !session('loginid', '', 'admin')){
            $controller=request()->controller();//获取当前控制器
            $action=request()->action();//获取当前方法
            //登录页面访问地址优化
            if($controller==="Index" && $action==="index"){
                $this->redirect('login/index');
            }
            $this->error("未登录，不允许访问",'login/index');
            //$this->redirect('login/index')
        }
        //获取网站配置信息
        $configRes=db('config')->find();
        $config=json_decode($configRes['config'],true);
        $this -> assign('config',$config);
        $this->assign('admin',session('loginname','','admin'));
    }

    //栏目图片上传
    public function uploadimg()
    {
        //获得上传文件对象
        $file = request()->file('imgfile');
        //判断$file是不是文件对象
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $imgpath="uploads\\" . $info->getSaveName();
            return json(['code'=>1, 'msg'=>'上传成功','img'=>$imgpath]);

        }else{
            return json(['code'=>-0, 'msg'=>$file->getError()]);
        }

    }

    //单张图片删除
    public function delimg($url=""){
        if($url!=="" || !empty($url)){
            $file=ROOT_PATH."public\\".$url;
            if(file_exists($file)){
                $res=unlink($file);
                if($res){
                    //删除成功
                    $this->delpic($url);
                    return json(['code'=>1,'msg'=>"删除成功"]);
                }
                return json(['code'=>0,'msg'=>"删除失败"]);
            }
            $this->delpic($url);
            return json(['code'=>2,'msg'=>"文件不存在"]);
        }

    }

    public function delimgaa($url=""){
        if($url!=="" || !empty($url)){
            $file=ROOT_PATH."public\\".$url;
            if(file_exists($file)){
                $res=unlink($file);
                if($res){
                    //删除成功
                    $this->delpic($url);
                    return json(['code'=>1,'msg'=>"删除成功"]);
                }
                return json(['code'=>0,'msg'=>"删除失败"]);
            }
            $this->delpic($url);
            return json(['code'=>2,'msg'=>"文件不存在"]);
        }

    }

    //删除数据表中图片记录
    protected function delpic($url){
        $pic=db('pics')->where('pic',$url)->field('id')->find();
        if($pic){
            db('pics')->delete($pic['id']);
        }
    }

    public function uploadimga(){

        //获得上传文件对像
        $file = request()->file('imgfile');

        //判断$file是不是文件对像
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $imgpath="uploads\\" . $info->getSaveName();
            return json(['code'=>1,'msg'=>'上传成功','img'=>$imgpath]);
        }else{
            return json(['code'=>0,'msg'=>$file->getError()]);
        }

    }
}