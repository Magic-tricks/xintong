<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/10/8
 * Time: 17:54
 */

namespace app\index\controller;


class Riyong extends Common
{
    public function index()
    {
        $banner=$this->getbanner();

        $this->assign([
            'banner'=>$banner,
        ]);

        $artRes=db("erjineirong")->where('cid',input('cid'))->limit(6)->select();
        $artAllRes=db("erjineirong")->where('cid',input('cid'))->limit(6)->select();
        foreach ($artRes as $k => $v)
        {
            $artRes[$k]['pic']=db('erjipic')->where('aid',$v['id'])->field('pic')->find();
        }
        foreach ($artAllRes as $k => $v)
        {
            $artAllRes[$k]['pic']=db('erjipic')->where('aid',$v['id'])->field('pic')->find();
        }

        $this->assign([
            'artRes'=>$artRes,
            'artAllRes'=> $artAllRes
        ]);
        return view('riyong');
    }

    //获取轮播图
    private  function getbanner()
    {
        $res=db('banner')->where('isshow',1)->order('sort ASC')->field('pic,url')->select();
        return $res;
    }
}