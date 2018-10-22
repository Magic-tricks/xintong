<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/10/8
 * Time: 17:49
 */

namespace app\index\controller;


class Wenju extends Common
{
    public function index()
    {
        $banner=$this->getbanner();

        $this->assign([
            'banner'=>$banner,
        ]);
        return view('wenju');
    }
    //获取轮播图
    private  function getbanner()
    {
        $res=db('banner')->where('isshow',1)->order('sort ASC')->field('pic,url')->select();
        return $res;
    }
}