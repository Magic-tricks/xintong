<?php
/**
 * Created by PhpStorm.
 * User: 约伯
 * Date: 2018/8/16
 * Time: 11:02
 */

namespace app\admin\validate;


use think\Validate;

class Erjineirong extends Validate
{
    protected $rule =   [
        'title'  => 'require',
        'views' => 'require|number|checkviews:0',
        '__token__'  =>  'require|token',
    ];

    protected $message  =   [
        'title.require' => '标题不能为空',
        'views.number' => '浏览次数必须是数字',
        'views.checkviews' => '浏览次数必须大于0',
        '__token__.require' => "非法提交",
        '__token__.token' => "请不要重复提交表单"
    ];

    //自定义验证规则 $value要验证字段的值 $rule验证规则传来的值 bool true 验证通过 false|字符串   验证不通过
    protected function checkviews($value,$rule)
    {
        if($value>=$rule){
            return true;
        }
        return false;
    }
}