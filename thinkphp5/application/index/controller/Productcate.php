<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\index\controller\Basetemplate;

class Productcate extends Basetemplate
{
	public function read(Request $request)
	{
		$cate_id=$request->get('id');
		$newst_product=Db::table('product')->where('c_id',$cate_id)->paginate(1);
		 $page = $newst_product->render();
	    $newst_product=$newst_product->all();
	      foreach ($newst_product as $key => $value)
	       {
	          $newst_product[$key]['path']=Db::table('product_pic')->field('p_thumb_path')->limit(1)->order('id desc')->where('pro_id',$value['p_id'])->select();
	      }
	      $this->assign('product',$newst_product);
	      $this->assign('page',$page);
		return $this->fetch();
	}
}