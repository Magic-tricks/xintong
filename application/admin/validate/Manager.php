<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/7/31
 * Time: 16:32
 */

namespace app\admin\validate;


use think\Validate;

class Manager extends  Validate
{
    protected $rule =   [
        'account'  => 'require|min:4|unique:manager',
        'password'   => 'require|min:6|confirm:repassword',
        'code' => 'require|captcha'
        ];
    protected $message  =   [
        'account.require' => '账号不能为空',
        'account.min' => '账号长度不符合规则',
        'account.unique'     => '账号已存在',
        'password.require'   => '密码不能为空',
        'password.min'  => '密码长度不能小于6位',
        'password.confirm'        => '两次密码不一致',
        'code.require' => '验证码不能为空',
        'code.captcha' => '验证码输入不正确',
    ];
    protected $scene = [
        'add' => ['account','password'],
        'edit'  =>  ['password'],
        'login' => ['account'=>'require|min:4','password'=>'require|min:6','code'],

    ];

}