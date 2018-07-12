<?php
namespace app\index\validate;
use think\Validate;
/**
* 
*/
class Address extends Validate
{
	
	protected $rule=[
         
			'person' => 'require|regex:/^[\x7f-\xff_a-zA-Z0-9_]{2,50}$/',	
			'phone'=>   'require|regex:/^1[34578]\d{9}$/',
			'add' => 'require',

	];
	protected $message=[
	        'person.require' => '联系人必填',
	        'person.regex' => '姓名只能是中英文和_',
			'phone.regex'=>'手机号格式错误',
			'phone.require'=>'请填写手机号',
			'add.require' => '请填地址',
			


			
	];
	
}