<?php
namespace app\admin\validate;
use think\Validate;
/**
* 
*/
class Product extends Validate
{
     protected $rule=[
            'p_name' => 'require|max:60',
			'show_price'=>   'require|number',
	];
	protected $message=[
            'p_name.require' => '请填写名称 ',
			'p_name.max' => ' 名称最多不能超过 60 个字符 ',
			'show_price.require' => '请填写展示价格',
			'show_price.number' => ' 价格必须是数字 ',
	];
	

}