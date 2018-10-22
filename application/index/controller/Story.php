<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/10/8
 * Time: 14:40
 */

namespace app\index\controller;


class Story extends Common
{
    public function index()
    {
        $banner=$this->getbanner();

        $this->assign([
            'banner'=>$banner,
        ]);

        $cateGory=db("category")->where('id','7')->select();
        $artRes=db("article")->where('cid','7')->select();
        foreach ($artRes as $k => $v)
        {
            $artRes[$k]['pic']=db('pics')->where('aid',$v['id'])->field('pic')->find();
        }
        $count=count($artRes);
        //dump($artRes);die;
        $this->assign([
            'banner'=>$banner,
            'count'=>$count,
            'artRes'=>$artRes,
            'cateGory'=>$cateGory
        ]);
        return view('story');
    }
    //获取轮播图
    private  function getbanner()
    {
        $res=db('banner')->where('isshow',1)->order('sort ASC')->field('pic,url')->select();
        return $res;
    }
}