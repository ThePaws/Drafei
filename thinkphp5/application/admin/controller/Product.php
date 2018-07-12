<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\Product as pm;
use org\Upload;
use think\Session;
// use app\admin\model\ProductPic;
use app\admin\validate\Product as PV;
        ini_set("display_errors", "On");
        error_reporting(E_ALL || E_STRICT);
class Product extends Controller
{   
	//无限极分类获取所有分类
	protected function cateTree($data=[],$len=0,$f_id=0)
	{
		 static $data;
            $sql="select name,f_id,id from product_cate where f_id ={$f_id} ";
            $result = Db::table('product_cate')->query($sql);
              // dump($result);die;
            if (is_array($result)){
                $len+=1;
                $num=count($result);
                for ($i=0;$i<$num;$i++){
                     $result[$i]['name']=str_repeat('&nbsp&nbsp',$len-1).str_repeat('-|',$len-1). $result[$i]['name'];
                    $data[]=$result[$i];
                    $this->cateTree($data,$len,$result[$i]['id']);
                }
            }
            return $data;
       
	}
	//前端分类-总分类
	public function classify(Request $request)
	{
		
		  if($request->isGet())
		  {
			$listTop=Db::table('product_cate')->select();
            return  json($listTop);
            // dump($listTop);
		  }
	}
	public function classify_Cate(Request $request)
	{

		    $id=$request->param('id');//包含post和get方式传递的参数
			$list=Db::table('product')->where('c_id',$id)->paginate(
				2,false,['query' =>$request->param()]);
              	 // dump($list);
		if ($request->isPost()) 
		{      
			$this->assign('list',$list);

		   // dump($list);die;
                 $msg=$this->fetch('product/base');
              	 return   json(['code'=>1,'msg'=>$msg]);
		}
		else
		 {
			$this->assign('list',$list);

             // dump($list);die;
		   return	$this->fetch('read');
              	 
		 	// // dump(111);die;
		  //  	 return $this->fetch('product/base');
		 }
	}
	
	public function search(Request $request)
	{ 
		$condition=input('name');
		// dump($condition);die;
		$data=Request::instance();
		$where=$condition==''?'%%':'%'.$condition.'%';
		$data = Db::table('product')->where("p_name|p_id|summary","like",$where)->paginate(1,false,['query'=>request()->param()]); 
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
	public function read(Request $request)
	{
		// $data = Db::table('product')->join('product_cate','product.c_id=product_cate.id')->select();
	   $data = Db::table('product')->order('p_id desc')->paginate(5,false,
					[
					    'type'     => 'Bootstrap',
					    'var_page' => 'page',
					'query' =>$request->param(),
					 ]);
	   $page = $data->render();
	   // dump($data);die;
	   $data=$data->all();
	   foreach ($data as $key => $value) {
	   	  $data[$key]['p_thumb_path']=Db::table('product_pic')->where('pro_id',$value['p_id'])->field('p_thumb_path')->find()['p_thumb_path'];
	   	// dump($value);

	       
	   }
		$this->assign('list',$data);
		$this->assign('page',$page);
	    return $this->fetch();
	}
	//提交图片
	public function add(Request $request)
	{   
		if ($request->isPost())
		 {
			    $upload = new Upload();// 实例化上传类
		        $upload->maxSize   =     3145728 ;// 设置附件上传大小
		        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		        $upload->rootPath  =     './upload/'; // 设置附件上传根目录
		        $upload->savePath  =     ''; // 设置附件上传（子）目录
		        // 上传文件 
		        $info   =   $upload->upload();
				if($info)
				 {// 上传成功
					Session::set('img_arr',$info);
	    		     return  $this->success('上传成功！');
	    		   
		        }
		        else
		        {// 比如没有上传文件上传,等等错误提示错误信息
		          return   $this->error($upload->getError());
		        }  
		         
		          
		}
		else
	    {   
	    	$category = $this->cateTree();
		    $data = Db::table('product')->select();
		    $product_attr_color=Db::table('product_attr')->where('attr_cate_id',1)->select();
		    $product_attr_size=Db::table('product_attr')->where('attr_cate_id',2)->select();
		    // dump($product_attr_color);
		    // dump($product_attr_size);
			$this->assign('product_attr_color',$product_attr_color);
			$this->assign('product_attr_size',$product_attr_size);
			$this->assign('list',$data);
			$this->assign('category',$category);
	    	return $this->fetch();
	    }
		 
	}
	//表单提交
	public function formAdd(Request $request)
	{
		 //检查表单信息
             $pro_data=$request->post();
		     $pv=new PV(); 
	         if(!$pv->check($pro_data))
	         {
	          return json(array('code'=>0,'msg'=>$pv->getError()));
	         }
	         if (!Session::has('img_arr'))
	         {
	         	 return json(array('code'=>0,'msg'=>'请上传图片'));
	         }
	         $img_arr = Session('img_arr');
	    	foreach ($img_arr as $key => $value)
	    	 {
	    		
	    		$arr[$key] = '/upload/'.$value['savepath'].$value['savename'];
	    	}
        	 // dump($pro_data);die;
    	     //判断是否要加水印,如果是则..
    	     if ($pro_data['water']) {
    	             
    	          foreach ($arr as $key => $value) {
    	          	// dump($value);die;
    	          	$img= \think\Image::open('.'.$value);
                      $water_img=Db::table('watermark')->find();
                         // dump($water_img);die;
    	          	$img->water('./'.$water_img['img'],$pro_data['position'],$pro_data['percentage'])->save('.'.$value);

    	          }
    	     	  
    	     }
    	     //批量生成缩略图
    	     foreach ($arr as $key => $value) {
        	    $image = \think\Image::open('.'.$arr[$key]);
					// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
               $path[$key]['p_thumb_path']=dirname($arr[$key]).'/'.'thumb'.md5(uniqid()).basename($arr[$key]);//缩略图;
               $image->thumb(50, 50)->save('.'.$path[$key]['p_thumb_path']);
               $path[$key]['path']=$value;
    	     }
        	  // $pro_data['p_thumb_path']=$path[0]['p_thumb_path']; 
        	  // $pro_data['p_path']=$path[0]['path']; 
	    	   //多图转换成json
        	  if (!$pro_data['item']) {
        	  	 return json(array('code'=>0,'msg'=>'请设置商品属性'));
        	  }
				               // dump($path);die;
        	         $insert =new pm;//实例化
			         $res=$insert->save($pro_data);
			         $p_id=$insert->p_id;
			    foreach ($path as $key => $value) {
			    	$value['pro_id']=$p_id; 
			    	Db::table('product_pic')->insert($value);
			    }
			   
			    
			    foreach ($property as $key => $value) {
			    	$key=str_replace('_',',',$key);
			    	Db::table('product_attr_group')->insert(['pro_id'=>$p_id,'attr_id'=>$key,'price'=>$value['price']]);
			    }
			    Session::delete('img_arr');
			    return   json(['code'=>1,'msg'=>'添加成功','url'=>'/admin/Product/read']);
			    
         
 	        
          
	}
	public function deleImg(Request $request)
	{//编辑页面的删除图片
	   if ($request->isPost()) {
			if($request->post('id')){
				$img_id=$request->post('id');
				$delImg=Db::table('product_pic')->where('id',$img_id)->delete();
				if ($delImg) {
					 return json(['code'=>1,'msg'=>'删除图片成功','url'=>'/admin/product/read']);
				}
			}
			
		        
	   }
	}
	public function edit(Request $request){
		if ($request->file()['img']) {
				$upload = new Upload();// 实例化上传类
		        $upload->maxSize   =     3145728 ;// 设置附件上传大小
		        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		        $upload->rootPath  =     './upload/'; // 设置附件上传根目录
		        $upload->savePath  =     ''; // 设置附件上传（子）目录
		        // 上传文件 
		        $info   =   $upload->upload();
				if(!$info)
				{// 上传失败
					return   $this->error($upload->getError());
	    		   
		        }
                foreach ($info as $key => $value)
	    	   {
	    		
	    		$arr[$key] = '/upload/'.$value['savepath'].$value['savename'];
	    	   }
		       
              Session::set('edit_img_path',$arr);
              // dump($this->img_path);
              return true;
		    }
		if ($request->isPost())
		{   
			$pro_data=$request->post();
		     $pv=new PV(); 
	         if(!$pv->check($pro_data))
	         {
	          return json(array('code'=>0,'msg'=>$pv->getError()));
	         }
			   if (Session::has('edit_img_path')) {
			   	    $arr=Session::get('edit_img_path');
					 //判断是否要加水印,如果是则..
		    	    // dump($pro_data);die;
		    	     //判断是否要加水印,如果是则..
		    	     if ($pro_data['water']) {
		    	             
		    	          foreach ($arr as $key => $value) {
		    	          	// dump($value);die;
		    	          	$img= \think\Image::open('.'.$value);

		    	          	$img->water('./upload/waterImg/shui.jpg',$pro_data['position'],$pro_data['percentage'])->save('.'.$value);

		    	          }
		    	     	  
		    	     }
		    	     //批量生成缩略图
		    	     foreach ($arr as $key => $value) {
		        	    $image = \think\Image::open('.'.$arr[$key]);
							// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
		               $path[$key]['p_thumb_path']=dirname($arr[$key]).'/'.'thumb'.md5(uniqid()).basename($arr[$key]);//缩略图;
		               $image->thumb(50, 50)->save('.'.$path[$key]['p_thumb_path']);
		               $path[$key]['path']=$value;
		    	     }
		    	     // Session::delete('edit_img_path');
			   }
			 $p_id = $pro_data['p_id'];
			foreach ($path as $key => $value) {
			    	$value['pro_id']=$p_id; 
			    	Db::table('product_pic')->insert($value);
			    }
			 $property=input('item/a');
			 // 添加属性的价格
			 if(!empty($property)){
			 	//先清除该商品的规格
			 	Db::table('product_attr_group')->where(['pro_id'=>$p_id])->delete();
                   foreach ($property as $key => $value) {
			    	$key=str_replace('_',',',$key);
			    	
			    	Db::table('product_attr_group')->insert(['pro_id'=>$p_id,'attr_id'=>$key,'price'=>$value['price']]);
			    }
			 }
			  
			 // dump($property);
			
			$update =new pm;//实例化
			$update->update($pro_data);
			 return   json(['code'=>1,'msg'=>'编辑成功','url'=>'/admin/Product/read']);
		}
		else
		{
			$p_id = input('param.p_id');
			$p_name=input('param.p_name');
			// dump($p_name);die;
			$category = $this->cateTree();
			$data=  Db::table('product')->join('product_cate','product.c_id=product_cate.id')->where('product.p_id',$p_id)->find();
			// dump($data);die;
			$product_attr_color=Db::table('product_attr')->where('attr_cate_id',1)->select();
		    $product_attr_size=Db::table('product_attr')->where('attr_cate_id',2)->select();
		    $img_arr=Db::table('product_pic')->where('pro_id',$p_id)->select();
		    // dump( $img_arr);die;
		    // dump($product_attr_color);
		    // dump($product_attr_size);
			// $start_time=$data['start_time'];
			// $over_time=$data['over_time'];
			$this->assign('product_attr_color',$product_attr_color);
			$this->assign('product_attr_size',$product_attr_size);
			$this->assign('img_arr',$img_arr);
			// $this->assign('over_time',$over_time);
			$this->assign('category',$category);
			$this->assign('data',$data);
			return $this->fetch();
		}
		
	}
	public function delete(Request $request)
	{
        if ($request->post())
         {
        	    $ids = $request->post()['id'];
		        $pm= new pm();
		        $img=Db::table('product_pic')->whereIn('pro_id',$ids)->select();
		        // dump($img);die;
		        foreach ($img as $key => $value)
		         {
				        		if (is_file('.'.$value['p_thumb_path']))
				        	    {
					                unlink('.'.$value['p_thumb_path']);
					               
		                        }
		                        if (is_file('.'.$value['path'])) {
		                        	 unlink('.'.$value['path']);
		                        }
		                         
		          }  
		        // die;
		        $res=$pm->whereIn('p_id',$ids)->delete();
		        // dump($res);
		        if ($res)
		        {
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
	//spec= specification 规格；说明书；详述
	public function ajaxGetSpecInput(Request $request)
	{
		$data=$request->post();
		$GoodsLogic = new pm();
		 $goods_id = input('goods_id/d') ? input('goods_id/d') : 0;
         $str = $GoodsLogic->getSpecInput($goods_id ,input('post.spec_arr/a',[[]]));
         // dump($str);
         return $str;
		// dump($data);die;
		// $product_attr_color=Db::table('product_attr')->field('id')->where('attr_cate_id',1)->select();
		// $product_attr_size=Db::table('product_attr')->field('id')->where('attr_cate_id',2)->select();
		// // dump($product_attr_size);
		// foreach ($data as $key => $value) {
			
		// 	if (in_array( $value,$product_attr_color)) {
				 
		// 	}
		// }
		// if (empty($data['color_id'])&&empty($data['size_id'])) {
		// 	 return ;
		// }
		// if(empty($data['size_id'])&&$data['color_id']){
             
  //            $str="<>";die;
			
		// }
		// if (empty($data['color_id'])&&$data['size_id']) {
			 
		// }
		// else{
			
		// }
	
	}
}