<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/16
 * Time: 9:33
 */

namespace app\admin\controller;
use app\admin\model\Erji as CateModel;

class Erjineirong extends Common
{

    //内容列表
    public function index($cid=null)
    {
        $res=db('erjineirong')->alias('a')
            ->join('erji b','b.id=a.cid')
            ->join('erjipic c','c.aid=a.id','LEFT')
            ->order('a.istop desc,a.toptime Desc,a.addtime Desc')
            ->field('a.*,b.name,count(c.pic) as pic')
            ->group('a.id')
            ->paginate(8,false,['query'=>['cid'=>$cid]]);
        $this->assign('list',$res);
        return view('erjineirong_list');
    }
    //添加内容
    public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            $data['addtime']=strtotime($data['addtime']);
            if(isset($data['istop'])){
                $data['toptime']=time();
            }
            //后端数据验证
            $validate=validate('Erjineirong');
            if(!$validate->check($data)){
                $this->error($validate->getError(),'erjineirong/add');
            }
            //清楚token字段
            // unset($data['__token__']);
            //unset($data['pic']);
            // unset($data['imgfile']);

            $result=model('Erjineirong')->allowField(true)->save($data);

            if(!$result){

                $this->error("内容添加失败");
            }
            if($data['pic']!=''){
                //拆分图片地址
                $arr_tmp=explode(',',$data['pic']);
                //获取新增文章id
                $aid=model('Erjineirong')->id;
                $thum=[];
                foreach($arr_tmp as $v){
                    $thum[]=['aid'=>$aid,'pic'=>$v];
                }
//                dump(db('erjipic')->insertAll($thum));die;
            }
            $this->success("内容添加成功");
            return;
        }
        //栏目获取
        $cateall=CateModel::order('sort Desc,id Asc')->select();
        $res=CateModel::erjiacateall($cateall,0,-1);
        $this->assign('cate',$res);
        return view('erjineirong_add');
    }

    //置顶
    public function istop()
    {
        if(request()->isAjax()){
            $data=input('post.');
            $value=[];
            $value['id']=$data['id'];
            $value['toptime']=time();
            $articleModel=model('Erjineirong');
            if($data['istop']==="true"){
                $value['istop']=1;
                if( $articleModel::update($value)){
                    return json(['code'=>1,'msg'=>"置顶成功"]);
                }
                return json(['code'=>0,'msg'=>"操作失败"]);
            }else{
                $value['istop']=0;
                if( $articleModel::update($value)){
                    return json(['code'=>1,'msg'=>"取消置顶成功"]);
                }
                return json(['code'=>0,'msg'=>"操作失败"]);
            }
        }
    }

    //图片列表
    public function pics($aid)
    {
        $res=db('erjipic')->where('aid',$aid)->order('sort Desc,id Desc')->select();
        $this->assign('erjipic',$res);
        return view('erjineirong_pic');
    }
    //删除单张图片 $id 图片id
    public function delpic($id)
    {
        $res=db('erjipic')->where('id',$id)->find();

        if($res){
            $pic=$res['erjipic'];
            $result=db('erjipic')->delete($id);
            if($result){
                $file=ROOT_PATH . "public/".$pic;
                if(file_exists($file)){
                    if(unlink($file)){
                        $this->success('图片删除成功');
                    }else{
                        $this->error('删除失败');
                    }
                }
            }
        }

    }

    //内容编辑
    public function edit($id)
    {
        if(request()->isPost()){
            $data=input('post.');
            $data['addtime']=strtotime($data['addtime']);
            if(isset($data['istop'])){
                $data['toptime']=time();
            }
            //后端数据验证
            $validate=validate('Erjineirong');
            if(!$validate->check($data)){
                $this->error($validate->getError(),'erjineirong/add');
            }
            //更新内容信息
            model('Erjineirong')->allowField(true)->save($data,['id' => $id]);
            $this->success("更新成功",'index');
            if(isset($data['istop'])){
                $data['toptime']=time();
            }
            //后端数据验证
            $validate=validate('Erjineirong');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            //更新内容信息
            model('Erjineirong')->allowField(true)->save($data,['id' => $id]);
            $this->success("更新成功",'index');
        }
        //获取文章信息
        $res=db('erjineirong')->where('id',$id)->find();
        //图片信息获取
        //1.分表
        $pics=db('erjipic')->where('aid',$id)->field('pic')->select();
         $res['pic']=$pics;

        //2.关联查询
        $res=db('erjineirong')->alias('a')
            ->join('erjipic b','b.aid=a.id')
            ->where('a.id',$id)
            ->field('a.*,GROUP_CONCAT(b.pic) as pic')
            ->find();
        $res['pic']=explode(",",$res['pic']);

        $this->assign('erjineirong',$res);
        $cateall=CateModel::order('sort Desc,id Asc')->select();
        $cates=CateModel::erjiacateall($cateall,0,-1);
        $this->assign('cate',$cates);
        return view('erjineirong_edit');
    }
    //图片排序
    public function picsort()
    {
        if(request()->isAjax()){
            $data=input('post.');
            $result=db('erjipic')->update($data);
            if($result){
                return json(['code'=>1,'msg'=>"排序成功"]);
            }
            return json(['code'=>0,'msg'=>"排序失败"]);
        }
    }
    //删除内容
    public function del($aid)
    {
        $article = model('Erjineirong');
        if( $article::destroy($aid)){ //删除成功
            //删除图片内容
            $this->success("删除成功");
        }
        //删除失败
        $this->error("删除失败");
    }


}