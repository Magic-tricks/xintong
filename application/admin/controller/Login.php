<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/1
 * Time: 11:50
 */

namespace app\admin\controller;


use think\Controller;

class Login extends Controller
{
        public function index()
        {
            if(request()->isPost()){
                //1，接收数据
                $data = input('post.');
                //2,登陆验证
                $result=$this -> logincheck($data);
                if(isset($result['mid'])){
                    $data_log=[
                        'mid'=>$result['mid'],
                        'ip'=>request()->ip(),
                        'logintime'=>time(),
                        'msg'=>$result['msg'],
                     ];
                    $log_rows=db('loginlog') -> where('mid',$result['mid']) ->count();
                    if($log_rows>30){
                        $log_min=db('loginlog')->where('mid',$result['mid'])->min('logintime');
                        db('loginlog')->where('mid',$result['mid'])->where('logintime',$log_min)->delete();
                    }
                    db('loginlog')->insert($data_log);
                }

                if($result['code']==1){
                    $this -> success($result['msg'],'index/index');
                }
                $this -> error($result['msg']);
            }
            if(session('loginname', '', 'admin') && session('loginid', '', 'admin')){
                $this->redirect('index/index');
            }
            return view();
        }

        /**
         *  登陆验证
         *  return code:0:登陆失败，1：登陆成功，msg:登录的提示信息
         * @param $data 管理员登陆信息
         */
        protected function logincheck($data)
        {
            //1.后端数据验证（用户名，密码是否符合后端数据验证规则，验证码是否正确）
            //场景验证
            $validate=validate('Manager');
            if(!$validate->scene('login')->check($data)){
                //$this->error($validate->getError());
                return ['code'=>0,'msg'=>$validate->getError()];
            }
            //2.验证用户名在数据库中是否存在
            $res=db('manager')->where('account',$data['account'])->find();
            if(!$res){
               // $this -> error('用户名输入不正确');
                return ['code'=>0,'msg'=>'用户名输入不正确'];
            }
            //3.验证密码是否与数据库一致
            if(md5($data['password'])!==$res['password']){
               // $this ->error('密码输入不正确');
                return ['code'=>0,'msg'=>'密码输入不正确','mid'=>$res['id']];
            }
            //4.验证管理员的状态
            if(!$res['state']){
               // $this ->error('账号已锁定，不允许登陆');
                return ['code'=>0,'msg'=>'账号已锁定，不允许登陆','mid'=>$res['id']];
            }
            //保存登陆信息到session，登陆成功！
            session('loginname', $res['account'], 'admin');
            session('loginid', $res['id'], 'admin');
           // $this ->success('登陆成功','index/index');
            return ['code'=>1,'msg'=>'登陆成功','mid'=>$res['id']];
        }

        //管理员退出
        public function logout()
        {
            session(null, 'admin');
            $this -> success('退出成功','login/index');
        }
}