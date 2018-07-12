<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
class Basetemplate extends Controller
{
	 function __construct()
	{   
	      parent::__construct();
    $cate=Db::table('product_cate')->field('name,id')->where('f_id',1)->select();
    foreach ($cate as $key => $value) {
    	     $cate[$key]['next']=Db::table('product_cate')->field('name,id')->where('f_id',$value['id'])->select();
    }
		$this->assign('cate',$cate);
		return $this->fetch('/base');
	}
}
