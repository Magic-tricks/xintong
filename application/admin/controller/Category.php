<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/2
 * Time: 12:56
 */

namespace app\admin\controller;
use app\admin\model\Category as CateModel;

class Category  extends Common
{
    public function index(){
        $cateall=CateModel::order('sort Desc,id Asc')->select();
        $cate=CateModel::getcateall($cateall,0,-1);
        $this->assign('cate',$cate);
        return view();
    }
    //栏目添加
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            if(isset($data['imgfile'])){
                unset($data['imgfile']);
            }
            //使用模型进行数据添加
            $result=CateModel::create($data);

            if($result){
                $this->success("栏目添加成功");
            }
        }
        //获取栏目列表
        $cateall=CateModel::order('sort Desc,id Asc')->select();
        $res=CateModel::getcateall($cateall,0,-1);
        $this->assign('cate',$res);
        return view();
    }
    //栏目排序
    public function sort(){
        if(request()->isPost()){
            $data=input('post.');
            if(CateModel::sort($data)){
                $this->success("排序成功");
            }
            $this->error("操作异常");
        }
    }

    //栏目编辑
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            if(isset($data['imgfile'])){
                unset($data['imgfile']);
            }
            $cateids=CateModel::getchildids($id);
            $cateids[]=$id;
            //判断更新条件,pid不在当前编辑栏目或者其子分类中
            if(!in_array($data['pid'],$cateids)){
                $this->error("上级栏目选择错误！");
            }
            //列新栏目数据
            if(CateModel::where('id',$id)->update($data)){
                $this->success("更新成功",'category/index');
            }
            $this->error("更新失败");

        }

        //获取栏目列表
        $cateall=CateModel::order('sort Desc,id Asc')->select();
        $res=CateModel::getcateall($cateall,0,-1);
        //获取当前栏目信息
        $result=CateModel::get($id);
        //拆分图片地址到数组


        $result->pics=explode(",",$result->pic);
        $this->assign([
            'cate'=>$res,
            'curcate'=>$result
        ]);
        return view();
    }
    //删除栏目
    public function del($id){
//        判断是否有下级栏目
        $res=CateModel::where('pid',$id)->select();
        if($res){
            $this->error("有下级栏目，不能删除该栏目");
        }
        //1.获取栏目图片地址
        $pics=CateModel::where('id',$id)->field('pic')->find();
        if(CateModel::destroy($id)){
            //删除栏目图片
            //栏目图片可能是多张，两张之间用‘,’分隔
            //2.拆分栏目图片地址
            $arr_pic=explode(',',$pics->pic);
            foreach ($arr_pic as $v){
                $this->delimg($v);
            }
            $this->success("删除成功",'category/index');
        }
        $this->error("删除失败");
    }

}