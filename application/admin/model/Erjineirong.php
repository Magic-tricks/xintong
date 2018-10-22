<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/16
 * Time: 9:32
 */

namespace app\admin\model;


use think\Model;

class Erjineirong extends Model
{
    protected static function init()
    {
        //添加之后
        Self::afterInsert(function ($data) {

            if($data['pic']!=''){
                //拆分图片地址
                $arr_tmp=explode(',',$data['pic']);
                //获取新增文章id
                $aid=model('Erjineirong')->id;
                $thum=[];
                foreach($arr_tmp as $v){
                    $thum[]=['aid'=>$aid,'pic'=>$v];
                }
                db('erjipic')->insertAll($thum);
            }
        });
        //更新之后
        Self::afterUpdate(function ($data) {


            if($data['pic']!=''){
                //拆分图片地址
                $arr_tmp=explode(',',$data['pic']);
                //获取新增文章id
                $aid=input('id');
                $thum=[];
                foreach($arr_tmp as $v){
                    $thum[]=['aid'=>$aid,'pic'=>$v];
                }
                db('erjipic')->insertAll($thum);
            }
        });
        //删除之后
        self::afterDelete(function ($data) {
            $aid=$data['id'];
            $res=db('erjipic')->where('aid',$aid)->select();
            if($res){   //如果有对应的图片，图片文件的删除
                foreach ($res as $v){
                    $file=ROOT_PATH ."\\public\\".$v['pic'];
                    if(file_exists($file)){
                        @unlink($file);
                    }
                }
                db('erjipic')->where('aid',$aid)->delete() ;
            }
        });
    }
}