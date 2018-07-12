<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\controller\Basetemplate;

class Shopcar  extends Basetemplate
{
  public function shopcar()
	{
		if (Session::has('username'))
		 {  
		 	 $shopcar=Db::table('shop_car')->where('user_id',Session::get('user_id'))->count();
             Session::set('shopcarnumber',$shopcar);
             if ($shopcar==0)
              {
			   

              	$shopcar_list='';
              	$this->assign('shopcar_list',$shopcar_list);
             	return  $this->fetch(); 
             }
			 $shopcar_arry=Db::table('shop_car')->where('user_id',Session::get('user_id'))->select();
			 // dump($shopcar_arry);die;
			 	 // dump($shopcar_list);
			 foreach ($shopcar_arry as $k => $v)
			  {  

			 	 $shopcar_list[$k]=Db::table('product')->field('p_name,show_price')->where('p_id',$v['pro_id'])->find();
			 	 $shopcar_list[$k]['number']=$v['number'];
			  	 // dump($attr_id_list);die;
			  	 //获取图片
			  	 $shopcar_thumb_path=Db::table('product_pic')->field('p_thumb_path')->where('pro_id',$v['pro_id'])->limit(1)->order('id desc')->select();
			 	 // dump($shopcar_thumb_path);die;
			 	 $shopcar_list[$k]['p_thumb_path']=$shopcar_thumb_path[0]['p_thumb_path'];
			  	 $att_name_list='';
			  	 $attr_group_list=Db::table('product_attr_group')->where(['attr_id'=>$v['attr_id'],'pro_id'=>$v['pro_id']])->field('price,stock,id')->find();
			  	 // dump($attr_group_list);die;
			  	  $shopcar_list[$k]['price']=$attr_group_list['price'];
			  	  $shopcar_list[$k]['stock']=$attr_group_list['stock'];
			  	  $shopcar_list[$k]['shopcar_id']=$v['id'];
			  	 
			  	 $attr_id_list=explode(',', $v['attr_id']);
			  	 foreach ($attr_id_list as $key => $value)
			  	 {   
			  	 	//取出属性组合中的价格和库存

			  	 	 $attr=Db::table('product_attr')->field('attr')->where('id',$value)->find();
			  	 	  // dump($attr['attr']);
			  	 	 $att_name_list.=$attr['attr'].'|';
			  	 }
			  	   $att_name_list=rtrim($att_name_list,"|");
			  	    $shopcar_list[$k]['att_name_list']= $att_name_list;
			 	
			 } 
			 
			  // dump($shopcar_list);die;
			 $this->assign('shopcar_list',$shopcar_list);
			 return  $this->fetch();
		}
		else
		{
			  $shopcar_list=[];
			  // dump($shopcar_list);die;
			 $this->assign('shopcar_list',$shopcar_list);
			 return  $this->fetch();
		}
	    
	}
	public function editshopcar(Request $request)
	{
		if ($request->isAjax())
		 {
		    $data=$request->post();

		    $shopcar_update=Db::table('shop_car')->where(['id'=>$data['id'],'user_id'=>Session::get('user_id')])->update($data);
		    // dump($shopcar_update);
		    return json(['code'=>1]);
		  		}
	}
	public function delete(Request $request)
	{
		if ($request->isAjax())
		 {
		 	 // dump($request->post());
		    $data=$request->post();
		    $shopcar_delete=Db::table('shop_car')->where(['id'=>$data['id'],'user_id'=>Session::get('user_id')])->delete($data);
		    $shopcar=Db::table('shop_car')->where('user_id',Session::get('user_id'))->count();
                Session::set('shopcarnumber',$shopcar);
                // dump($shopcar_delete);die;
		    return json(['code'=>1]);
		    // return json(['code'=>0,'msg'=>'验证码不对']);
		 }
	}

}	 