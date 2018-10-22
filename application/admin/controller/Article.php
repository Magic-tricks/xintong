<?php
/**
 * Created by PhpStorm.
 * User: yifeng
 * Date: 2017/11/2
 * Time: 22:22
 */
namespace app\admin\controller;
use app\admin\model\Category as CateModel;
use think\Lang;
class Article extends Common
{

    //内容列表
    public function index($cid=null){
        if($cid){
            $map=['a.cid'=>$cid];
        }else{
            $map=[];
        }
    //内容添加
    //获取内容列表信息
$res=db('article')->alias('a')
->join('category b','b.id=a.cid')
->join('pics c','c.aid=a.id','LEFT')
->order('a.istop desc,a.toptime Desc,a.addtime Desc')
->field('a.*,b.name,count(c.pic) as pic')
->where($map)
->group('a.id')
->paginate(10,false,['query'=>['cid'=>$cid]]);
$this->assign('list',$res);
    //栏目获取
$cateall= CateModel::order('sort Desc,id Asc')->select();
$res= CateModel::getcateall($cateall,0,-1);
$this->assign('cate',$res);
$this->assign('cid',$cid);
return view('article_list');
}
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            //dump($data);die;
            $data['addtime']=strtotime($data['addtime']);
            if(isset($data['istop'])){
                $data['toptime']=time();
            }
            //后端数据验证
            $validate=validate('Article');
            if(!$validate->check($data)){
                $this->error($validate->getError(),'article/add');
            }
            //清除__token__字段
            //unset($data['__token__']);
            //unset($data['pic']);
            //unset($data['imgfile']);
            $result=model('Article')->allowField(true)->save($data);
            Lang::set('Content addition success','内容添加成功','zh-cn');
            Lang::set('Content addition failure','内容添加失败','zh-cn');
            if(!$result){
                $this->error(lang('Content addition failure'));
            }
            $this->success(lang('Content addition success'));
            return;
        }
        //获取栏目列表
        //$CateModel = model('Category');
        $cateall= CateModel::order('sort Desc,id Asc')->select();
        $res= CateModel::getcateall($cateall,0,-1);
        $this->assign('cate',$res);
        return view('article_add');
    }
    //内容编辑
    public function edit($id){
        if(request()->isPost()){
            $data=input('post.');
            $data['addtime']=strtotime($data['addtime']);
            if(isset($data['istop'])){
                $data['toptime']=time();
            }
            //后端数据验证
            $validate=validate('Article');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            //更新内容信息
            model('Article')->allowField(true)->save($data,['id' => $id]);
            $this->success("更新成功",'index');
        }
        //获取文章信息
        //$res=db('article')->where('id',$id)->find();
        //图片信息获取
        //第一种：分表查询
        //$pics=db('pics')->where('aid',$id)->field('pic')->select();
        //$res['pic']=$pics;
        //dump($res);
        //第二种：关联查询
        $res=db('article')->alias('a')
            ->join('pics b','b.aid=a.id')
            ->join('category c','c.id=a.cid')
            ->where('a.id',$id)
            ->field('a.*,GROUP_CONCAT(b.pic) as pic,c.type')
            ->find();
        $res['pic']=explode(",",$res['pic']);
        $this->assign('article',$res);
        //获取栏目列表
        //$CateModel = model('Category');
        $cateall= CateModel::order('sort Desc,id Asc')->select();
        $cates= CateModel::getcateall($cateall,0,-1);
        $this->assign('cate',$cates);
        return view('article_edit');
    }
    //置顶
    public function istop(){
        if(request()->isAjax()){
            $data=input('post.');
            $value=[];
            $value['id']=$data['id'];
            $value['toptime']=time();
            $articleModel=model('Article');
            if($data['istop']==="true"){
                $value['istop']=1;
                if($articleModel::update($value)){
                    return json(['code'=>1,'msg'=>"置顶成功"]);
                }
                return json(['code'=>0,'msg'=>"操作失败"]);
            }else{
                $value['istop']=0;
                if($articleModel::update($value)){
                    return json(['code'=>1,'msg'=>"取消置顶成功"]);
                }
                return json(['code'=>0,'msg'=>"操作失败"]);
            }

        }
    }
    //图片列表
    public function pics($aid){
        $res=db('pics')->where('aid',$aid)->order('sort Desc,id Desc')->select();
        $this->assign('pics',$res);
        return view('article_pic');
    }
    //删除单张图片

    /**
     * @param string $id 图片Id
     */
    public function delpic($id){
        $res=db('pics')->where('id',$id)->find();
        if($res){
            $pic=$res['pic'];
            $result=db('pics')->delete($id);
            if($result){
                $file=ROOT_PATH ."public/".$pic;
                if(file_exists($file)){
                    if(unlink($file)){
                        $this->success('删除成功');
                    }else{
                        $this->error('删除失败');
                    }
                }
            }
        }

    }
    //图片排序
    public function picsort(){
        if(request()->isAjax()){
            $data=input('post.');
            $result=db('pics')->update($data);
            if($result){
                return json(['code'=>1,'msg'=>"排序成功"]);
            }
            return json(['code'=>0,'msg'=>"排序失败"]);
        }
    }
    //删除内容
    public function del($aid){
        $article = model('Article');
        if($article::destroy($aid)){//删除成功
            //删除图片内容
            $this->success("删除成功");
        }
        //删除失败
        $this->error("删除失败");
    }
    //批量删除
    public function delall(){
        if(request()->isPost()){
            $data=input('post.');
            //清除干扰项
//        if(isset($data['istop'])){
//            unset($data['istop']);
//        }
//            if(isset($data['cid'])){
//                unset($data['cid']);
//            }
            if(empty($data['id'])){
                $this->error("请选择要删除的内容");
            }
            $article = model('Article');
            $article = model('Article');
            $ids=implode(',', $data['id']);
            $result=$article::destroy($ids);
            if($result){//删除成功
                //删除图片内容
                $this->success("删除成功");
            }
            //删除失败
            $this->error("删除失败");
        }
    }
}