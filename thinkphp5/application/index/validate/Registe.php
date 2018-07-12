<?php
namespace app\index\validate;
use think\Validate;
/**
* 
*/
class Registe extends Validate
{
	
	protected $rule=[
         
			'phone'=>   'require|regex:/^1[34578]\d{9}$/',
			'phoneCode' => 'require',
			'email' => 'require|email',
            'password'=>'require|regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/',
			'checkbox' => 'require',


	];
	protected $message=[
			'phone.regex'=>'手机号格式错误',
			'phone.require'=>'请填写手机号',
			'phoneCode.require' => '请填写验证码',
			'email.require' => '请填写邮箱',
			'email.email' => '邮箱格式错误',
			'password.require'=>'请填写密码',
			'password.regex'=>'密码必须是数字,字母组合6位数以上',
			'checkbox.require' => '请勾选用户服务协议',


			
	];
	protected $scene=[
       'registe'=>['phone','phoneCode','email','password','checkbox'],
       'sendMobileCode'=>['phone'],
	];
	
}