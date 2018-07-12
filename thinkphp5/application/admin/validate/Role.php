<?php
namespace app\admin\validate;
use think\Validate;
/**
* 
*/
class Role extends Validate
{
	
	protected $rule=[
          'name'=>'require|max:25',
          'm_id'=>'require',
	];
	protected $message=[
           'name.require'=>'请填写名字',
           'name.max'=>'名字最长25个字符',
           'm_id.require'=>'请勾选权限',

	];
}