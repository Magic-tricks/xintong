<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/7/31
 * Time: 15:36
 */

namespace app\admin\controller;


class Manager extends Common
{
        //管理员列表
        public function index()
        {
            //查询所有数据
            $res = Db('manager') -> paginate(2);
            $this -> assign('manager',$res);
            return view();
        }
        //添加管理员
        public function add()
        {
            if(request()->isPost()){
              $data = input('post.');
             $validate = validate('Manager');//实例化验证器
                //数据验证
             if(!$validate -> scene('add') -> check($data)){
                 $this -> error($validate -> getError(),'add','',1);
                 return;
             }

             //验证通过,数据写入到数据库
                unset($data['repassword']);
                $data['password'] = md5(  $data['password']);
                if ( db('manager')->insert($data)){
                    $this -> success("管理员添加成功",'add');
                } else {
                    $this -> error("数据添加异常",'add');
                }
                    return;
            }
            return view();
        }

        //编辑管理员
        public function edit($id)
        {
            if(request()->isPost()){
                $data=input('post.');
                if(isset($data['account'])){
                    unset($data['account']);
                }
                if(!$data['password']){
                    unset($data['password']);
                    unset($data['repassword']);
                }else{
                    $validate=validate('Manager');
                    if(!$validate ->scene('edit') -> check($data)){
                        $this -> error($validate->getError());
                    }
                    unset($data['repassword']);
                    $data['password']=md5($data['password']);
                }
                if($data['state']==0 && $id==1){
                    $this -> error("超级管理员不允许锁定!");
                }
                $result=db('manager') -> where('id',$id) -> update($data);
                if(!$result){
                    $this -> error("管理员修改失败");
                }
                    $this -> success ("管理员修改成功",'manager/index');
                return;
            }
            $res = db('manager') -> where('id',$id)-> field('account,state') -> find();
            $this -> assign('manager',$res);
            return view();

        }

        //管理员删除
    public function del($id){//参数绑定
        //假定id为1的管理员为超级管理员
        if($id==1){
            $this->success('超级管理员不允许删除','manager/index');
        }
        $result=db('manager')->where('id',$id)->delete();
        if($result){
            $this->success('删除成功','manager/index');
        }else{
            $this->success('删除失败','manager/index');
        }
    }

    //管理员密码修改
    public function setpass()
    {
        if(request()->ispost()){
            $data=input('post.');
            $validate=validate('Manager');//实例化验证器类
            //验证器场景验证
            if(!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }
            $res=db('manager')->field('password')->find(session('loginid'));
            if(md5($data['oldpassword'])==$res['password']){
                $this -> error("旧密码输入不正确");
            }
            $result=db('manager')->where('id',session('loginid','','admin'))->setField('password',md5($data['password']));
            if(!$result){
                $this -> error("密码修改失败");
            }
            $this -> success("密码修改成功");
            dump($res);
            return;
        }
        return view();
    }
}