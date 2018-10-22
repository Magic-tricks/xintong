<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        $banner=$this->getbanner();

        $this->assign([
            'banner'=>$banner,
        ]);

        $cateResult=db('erji')->where('pid','0')->select();
        $artAll=db('erjineirong')->alias('a')->join('erjipic b','a.id=b.aid')->select();

        $this->assign([
            'cateResult'=>$cateResult,
            'artAll'=>$artAll,
        ]);
        //dump($cateResult);die;
        return view('indexs');
    }

    //获取轮播图
    private  function getbanner()
    {
        $res=db('banner')->where('isshow',1)->order('sort ASC')->field('pic,url')->select();
        return $res;
    }

    //获取首页栏目信息
}
