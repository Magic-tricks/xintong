<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/8
 * Time: 15:39
 */

namespace app\admin\controller;


class Banner extends Common
{
        //轮播图列表
        public function index()
        {
            $res=model("Banner")->order('id Desc')->select();
            $this->assign("pics",$res);
            return view('banner_list');
        }
        //添加轮播图
        public function add()
        {
            if(request()->isPost()){
                $data=input('post.');

                //获取图片数据
                $file = request()->file('upimg');//获取文件对象
                //图片上传
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    //获取图片路径
                    $picpath="uploads\\".$info->getSaveName();
                    $data['pic']=$picpath;
                }
                //写入数据库
                if(model("Banner")->save($data)){
                    $this->success("添加成功",'index');
                }
                $this->error("添加失败",'index');
            }
            return view('banner_add');
        }

        //编辑轮播图
        public function edit($id)
        {
            if(request()->isPost()){
                $data=input('post.');
                if(!isset($data['isshow'])){
                    $data['isshow']=0;
                }
                //获取图片数据
                $file = request()->file('upimg');//获取文件对象
                if($file){
                    //图片上传
                    if($file){
                        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                        //获取图片路径
                        $picpath="uploads\\".$info->getSaveName();
                        $data['pic']=$picpath;
                    }
                    //删除旧图片
                    $pic=db('banner')->field('pic')->find($id);
                    $picurl=ROOT_PATH ."public\\".$pic['pic'];
                    @unlink($picurl);
                }
                if(model("Banner")->save($data,['id'=>$id])){
                     $this->success("更新成功",'index');
                }
                     $this->error("更新失败",'index');
            }
            $res=model('Banner')->get($id);
            $this->assign('banner',$res);
            return view('banner_edit');
        }

    public function del($id,$pic=null){
        $banner_model=model('Banner');
        //删除数据库记录
        if($banner_model::destroy($id)){
            //删除图片文件
            $picurl=ROOT_PATH ."public/".urldecode($pic);
            @unlink($picurl);
            $this->success("删除成功",'index');
        }
        $this->success("删除失败",'index');
    }


        //处理异步数据
    public function setajax()
    {
        if(request()->isAjax()){
            $data=input('post.');
            $newdata=[];
            $newdata['id']=$data['id'];
            if($data['act']=="show"){
                $newdata['isshow']=$data['v'];
            }
            if($data['act']=="sort"){
                $newdata['sort']=$data['v'];
            }
            if(model('Banner')->update($newdata)){
                return json(1);
            }
            return json(0);
        }
    }
}