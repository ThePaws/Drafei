<?php
namespace app\admin\validate;
use think\Validate;
/**
* 
*/
class User extends Validate
{
	
	protected $rule=[
            'name' => 'require|max:25',
            'password'=>'regex:/^\w{4,16}$/',
			'age' => 'number|between:1,120',
			'phone'=>   'require|regex:/^1[34578]\d{9}$/',
			'email' => 'require|email',
	];
	protected $message=[
            'name.require' => '请填写名称 ',
			'name.max' => ' 名称最多不能超过 25 个字符 ',
			'password.regex'=>'密码不能少于4位数',
			'age.number' => ' 年龄必须是数字 ',
			'age.between' => ' 年龄只能在 1-120 之间 ',
			'phone.require'=>'请填写手机号',
			'phone.regex'=>'手机号格式错误',
			'email.require' => '请填写邮箱',
			'email.email' => '邮箱格式错误',
			
	];
	
}