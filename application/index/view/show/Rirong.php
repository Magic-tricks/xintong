<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/10/8
 * Time: 17:54
 */

namespace app\index\controller;


class Rirong extends Common
{
    public function index()
    {
        $banner=$this->getbanner();

        $this->assign([
            'banner'=>$banner,
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