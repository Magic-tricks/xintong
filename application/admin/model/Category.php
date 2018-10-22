<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/2
 * Time: 12:52
 */

namespace app\admin\model;
use think\Model;

class Category  extends Model
{
        //使用获取器取栏目类型
        public function getTypeAttr($value)
        {
            $type=[
                1=>"<span class=\"layui-badge layui-bg-blue\">列表</span>",
                2=>"<span class=\"layui-badge\">图片</span>",
                3=>"<span class=\"layui-badge layui-bg-cyan\">单页</span>"
                  ];
            return $type[$value];
        }
        //获取栏目列表
        public static function getcategory($pid=0,$level=-1)
        {
            $res=self::where('pid',$pid)->select();
            static $arr=array();
            $level+=1;//$level=$level+1;
            if($level==0){
                $str="";
            } else {
                $str = "|";
            }
            foreach($res as $v){
                $tmp_arr=array();
                $tmp_arr['id']=$v['id'];
                $tmp_arr['name']=$str.str_repeat("----",$level).$v['name'];
                $tmp_arr['pid']=$v['pid'];
                $tmp_arr['sort']=$v['sort'];
                $arr[]=$tmp_arr;
                self::getcategory($v['id'],$level);
            }
            return $arr;
        }

    //获取栏目列表-优化
    /**
    * @param $data 包含 所有栏目分类的数组
     *@param int $pid 上级栏目标识
     *@param $data $level 层级数
     *@return array
     */
    public static function getcateall($data,$pid=0,$level=-1)
    {
       // $res=self::where('pid',$pid)->select();
        static $arr=array();
        $level+=1;//$level=$level+1;
        if($level==0){
            $str="";
        } else {
            $str = "|";
        }
        foreach($data as $v){
            if($pid==$v['pid']){
                $tmp_arr=array();
                $tmp_arr['id']=$v['id'];
                $tmp_arr['name']=$str.str_repeat("----",$level).$v['name'];
                $tmp_arr['pid']=$v['pid'];
                $tmp_arr['sort']=$v['sort'];
                $tmp_arr['type']=$v['type'];
                $tmp_arr['typeid']=$v->getData('type');
                $arr[]= $tmp_arr;
                self::getcateall($data,$v['id'],$level);
                unset($v);
            }

        }
        return $arr;
    }

    //栏目排序
    public static function sort($data){
        foreach ($data as $id=>$sort){
            self::where('id',$id)->update(['sort'=>$sort]);
        }
        return true;
    }

    //获取子栏目id,包含自身id
    public static function getchildids($id)
    {
        $res=self::where('pid',$id)->field('id')->select();
        static $arr=array();
        foreach($res as $v){
                $arr[]=$v['id'];
                self::getchildids($v['id']);
        }

        return $arr;
    }


}