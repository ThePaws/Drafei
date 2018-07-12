<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
// use app\admin\model\ProductPic;
use app\admin\validate\Product as PV;
        ini_set("display_errors", "On");
        error_reporting(E_ALL || E_STRICT);
class Attribute extends Controller
{  
	 public function read()
	{   
		$attribute=Db::table('product_attr')->select();
		foreach ($attribute as $key => $value) {
			 // dump($value['attr_cate_id']);
			$attr_cate_name=Db::table('product_attr_cate')->field('name,id')->where('id',$value['attr_cate_id'])->find();
			// dump($attr_cate_name);
			$attribute[$key]['attr_cate_name']=$attr_cate_name['name'];
		}
		// dump($attribute);
           $this->assign('list',$attribute);
		return $this->fetch();
	}
	public function edit(Request $request)
	{
		if ($request->isPost())
		 {
			$post=$request->post();
			// dump($post);die;
			unset($post['attr_cate_name']);
			Db::table('product_attr')->update($post);
		    return   json(['code'=>1,'msg'=>'添加成功','url'=>'/admin/Attribute/read']);
		}
		else
		 { 	
		 	$id=input('id');
			$attr_cate_name=input('attr_cate_name');
			$attr=Db::table('product_attr')->field('attr')->where('id',$id)->find();
			// dump($attr);

			$this->assign('id',$id);
			$this->assign('attr_cate_name',$attr_cate_name);
			$this->assign('attr',$attr['attr']);
			return $this->fetch();

		 }
		
	}
	public function add(Request $request)
	{
		if ($request->isPost())
		 {
		 	$post=$request->post();

		 	if (empty($post['attr'])) {
		 		 return   json(['code'=>0,'msg'=>'请添加属性名']);
		 	}
		 	$insert=Db::table('product_attr')->insert($post);
		 	if ($insert) {
		 		 return   json(['code'=>1,'msg'=>'添加成功','url'=>'/admin/Attribute/read']);
		 	}
		 	else
		 	{
		 		 return   json(['code'=>0,'msg'=>'添加失败']);
		 	}
		 }
	    else{
              $attr_cate=Db::table('product_attr_cate')->select();
              // dump($attr_cate);die;
              $this->assign('attr_cate',$attr_cate);
	      	return $this->fetch();
	    }
		
	}
}