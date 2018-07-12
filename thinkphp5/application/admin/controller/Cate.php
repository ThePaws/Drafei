<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\Product as pm;
use app\admin\model\Cate_tree as loop;

class Cate extends Controller
{
	//前端分类
	public function cate(Request $request)
	{
		if ($request->param()) {
              
	        $id=$request->param('id');
		 
			$list=Db::table('product')->where('c_id',$id)->paginate(
				2,false,
					[
					    'type'     => 'Bootstrap',
					    'var_page' => 'page',
					'query' =>$request->param(),
					 ]
					);
			$this->assign('list',$list);
			
              if ($request->isPost())
               {
              	 $msg=$this->fetch('product/base');
              	 return   json(['code'=>1,'msg'=>$msg]);
               }
			   
			  else
			   {
			   	 return $this->fetch('product/base');
			   }
		}
		else
		{
			$listTop=Db::table('product_cate')->select();
            return  json($listTop);
		}
	}
	public function search(Request $request)
	{ 
		$condition=input('name');
		// dump($condition);die;
		$data=Request::instance();
		$where=$condition==''?'%%':'%'.$condition.'%';
		$data = Db::table('product')->where("p_name|p_id|p_brand","like",$where)->paginate(1,false,['query'=>request()->param()]); 
		// dump($data);die;
		$category = Db::table('product_cate')->select();
		// dump($category);die;
		$this->assign('list',$data);
		if ($request->isAjax()) {
			 $msg=$this->fetch('product/base');
             return   json(['code'=>1,'msg'=>$msg]);
		}
		else
		{
		   return	$this->fetch('product/read');
		}
        
	}
	public function read()
	{
		// $data = Db::table('product')->join('product_cate','product.c_id=product_cate.id')->select();
	   $category = Db::table('product_cate')->where('id','<>',1)->select();
	   // dump( $category);die;
		$this->assign('result',$category);
	    return $this->fetch();
	}
	public function add(Request $request)
	{
		 $id=$request->post();
		$category = Db::table('product_cate')->select();
	   $data = Db::table('product')->select();
		$this->assign('list',$data);
		$this->assign('category',$category);
	    return $this->fetch();
	}
	public function edit(Request $request){
		if ($request->isPost())
		{   
			// dump($request->post());die;

			$p_id = $request->post()['id'];
			$product = new pm();
			$product->allowField(true)->save($request->post(),['p_id',$p_id]);

			dump($request->post());
		}
		else
		{   

			$id = $request->param()['id'];
			$name= $request->param()['name'];
			$info = Db::table('product_cate')->where('id',$id)->find();
			$category = $this->cate_tree('product_cate','c_name,f_id,id');
		// dump($name);die;
			$this->assign('id',$info);
			$this->assign('name',$info);
			$this->assign('category',$category);
			// $id=$request->param('id');
			// dump($id);die;
			
			// $data=  Db::table('product')->join('product_cate','product.c_id=product_cate.id')->where('product.p_id',$id)->find();
			// $data['p_content'] = htmlspecialchars_decode(base64_decode($data['p_content']));
			// dump($data);die;

			$this->assign('result',$category);
			return $this->fetch();
		}
		
	}
	public  function cate_tree($data=[],$len=0,$f_id=0)
    {
            static $data;
            $sql="select c_name,f_id,id from product_cate where f_id ={$f_id} ";
            // dump(233);die;
            $result = Db::table('product_cate')->query($sql);
            // dump($result);die;
            if (is_array($result)){
                $len+=1;
                $num=count($result);
                for ($i=0;$i<$num;$i++){
                     $result[$i]['c_name']=str_repeat('&nbsp&nbsp',$len-1).str_repeat('-|',$len-1). $result[$i]['c_name'];
                    $data[]=$result[$i];
                    $this->cate_tree($data,$len,$result[$i]['id']);
                }
            }
            return $data;
    }
	public function delete(Request $request)
	{
        if ($request->post()) {
        	    $ids = $request->post()['id'];
		        $pm= new pm();
		        $res=$pm->whereIn('p_id',$ids)->delete();
		        // dump($res);
		        if ($res) {
		        	  return   json(['code'=>1,'msg'=>'删除成功','url'=>'/admin/product/read']);
		        }
		        else
		        {
		        	 return   json(['code'=>0,'msg'=>'删除失败']);
		        }
		        }
       
	}
	public function look(Request $request)
	{   
		// $new = new Request;
		$id= $request->param('id');
		
	}
}