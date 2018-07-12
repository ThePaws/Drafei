<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\controller\Basetemplate;

class Goorder  extends Basetemplate
{

  public function goorder()
  { 
     if (Session::has('username'))
		 {   
  		    $address=Db::table('address')->select();
  		    // dump($address);die;
  		    $this->assign('address',$address);  
		 	 $shopcar=Db::table('shop_car')->where('user_id',Session::get('user_id'))->count();
             Session::set('shopcarnumber',$shopcar);
             if ($shopcar==0)
              {
              	$shopcar_list=[];
              	$this->assign('shopcar_list',json_encode($shopcar_list));
             	return  $this->fetch(); 
             }
			 $shopcar_arry=Db::table('shop_car')->where('user_id',Session::get('user_id'))->select();
			 // dump($shopcar_arry);
			 $totalPrice=0;
			 foreach ($shopcar_arry as $k => $v)
			  {  

			 	 $shopcar_list[$k]=Db::table('product')->field('p_name,show_price,p_id')->where('p_id',$v['pro_id'])->find();
			 	 $shopcar_list[$k]['number']=$v['number'];
			  	 // dump($shopcar_list);
			  	 $attr_id_list=explode(',', $v['attr_id']);
           $shopcar_thumb_path=Db::table('product_pic')->field('p_thumb_path')->where('pro_id',$v['pro_id'])->limit(1)->order('id desc')->select();
         
         $shopcar_list[$k]['p_thumb_path']=$shopcar_thumb_path[0]['p_thumb_path'];
			  	 // dump($attr_id_list);
			  	 $att_name_list='';
			  	 $attr_group_list=Db::table('product_attr_group')->where(['attr_id'=>$v['attr_id'],'pro_id'=> $shopcar_list[$k]['p_id']])->field('price,stock,id')->find();
			  	 // dump($attr_group_list);
			  	  $shopcar_list[$k]['price']=$attr_group_list['price'];
			  	  $shopcar_list[$k]['stock']=$attr_group_list['stock'];
			  	  $shopcar_list[$k]['shopcar_id']=$v['id'];
			  	  $shopcar_list[$k]['product_attr_group_id']=$attr_group_list['id'];
			  	  $totalPrice+= $shopcar_list[$k]['number']*$shopcar_list[$k]['price'];
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
			 // dump($shopcar_list);
			  // dump($shopcar_list);
			 // dump($totalPrice);
			 $this->assign('totalPrice',$totalPrice);
			 // $this->assign('shopcar_list_json',json_encode($shopcar_list,true));
			 $this->assign('shopcar_list',$shopcar_list);
		}
		else
		{     $address=[];
			  $shopcar_list=[];
			 $this->assign('shopcar_list',$shopcar_list);
			 $this->assign('address',$address);
		}
		// dump($address);die;
	    return  $this->fetch();
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
  // public function toinput()
  // {
  //   return	$this->fetch();
  // }
  public function address(Request $request)
  {
  	// echo 222;die;
  	if ($request->isPost()) {
  		// echo 'post';die;
  		$data= $request->post();
  		// dump($data);die;
  		if (!Session::has('user_id'))
  		 {
  			return json(['code'=>0,'msg'=>'请先登录']);
  		}
  		$data['u_id']=Session::get('user_id');
  		// dump($data);die;
  		$insert=Db::table('address')->insert($data);
  		// dump($insert);die;
  		$validate= new \app\index\validate\Address();
  		if (!$validate->check($data)) {
  			 return json(['code'=>0,'msg'=>$validate->getError()]);
  		}
  		if ($insert)
  		 {
  		// dump($insert);die;
  		 	return json(['code'=>1,'msg'=>'成功','url'=>'/Index/Goorder/goorder']);
  			// return  $this->fetch('');
  		}
  		else
  		{
  			echo '添加失败';
  		}
  		
  	}
  	else
  	{

  		return  $this->fetch('/Goorder/address');
  	}
  	
  }
  public function commitOrder(Request $request)
  {
  	// return json(['code'=>1,'msg'=>$request->post()]);
  	
  	$post=$request->post();
    // dump($post);die;

    if (!Session::has('user_id'))
     {
      return json(['code'=>0,'msg'=>'请先登录','url'=>'/Index/Goorder/pay']);
       
    }//查询该用户的购物车
     $shopcar_arry=Db::table('shop_car')->where('user_id',Session::get('user_id'))->select();
  	// dump($shopcar_arry);die;
  	 // dump($shopcar_arry);die;
  	$post['order_id']=mt_rand(1000,2000).time();
     foreach ($shopcar_arry as $key => $value)
      {     
      	
     	    $attr_id_list=explode(',', $value['attr_id']);
			  	 // dump($attr_id_list);die;
			  	 $post['per_price']=Db::table('product_attr_group')->where(['attr_id'=>$value['attr_id'],'pro_id'=> $value['pro_id']])->field('price')->find()['price'];
			  	 // dump($value);die;
     	  	$post['pro_id']=$value['pro_id'];
     	  	$post['attr_id']=$value['attr_id'];
     	  	$post['user_id']=$value['user_id'];
     	  	 	// dump($post);die;
  	        $post['number']=$value['number'];
     	  	$post['pay']=0;
     	  	$post['subtotal']=$post['per_price']*$value['number'];
            $insert=Db::table('order_form_details')->insert($post);
     	  	// dump($insert);die;
            if ($insert)
             {
            	 Db::table('shop_car')->where('user_id',Session::get('user_id'))->delete();
            }
     	 	 
     }
  	// dump($insert);die;

  	if ($insert)
  	 {//已经存在,就不更新了
  	// dump($check);die;
     // dump($post['order_id']);
  	  $order_form=Db::table('order_form_details')->where(['order_id'=>$post['order_id'],'user_id'=>Session::get('user_id'),'pay'=>0])->field('subtotal,order_id')->select();
  	  // dump($order_form);die;
  	  $data['total_price']=0;
  	  foreach ($order_form as $key => $value) 
  	  {
  	  	 $data['total_price']+=$value['subtotal'];
  	  	 $data['order_id']=$value['order_id'];
  	  }
  	  // dump($data['total_price']);die;
  	  	 $data['pay']=0;
  	  	 $data['user_id']=Session::get('user_id');

  	  $insert_order_form=Db::table('order_form')->insert($data);
  	  // dump($insert_order_form);die;
  	  if ($insert_order_form)
  	   {
  	  	  return json(['code'=>1,'msg'=>'已经提交','url'=>'/Index/Goorder/pay']);
  	  }
  	  
  		// dump($check);die;
  	}
    
  	
  	
  	

  }
  public function pay(Request $request)
  {
    
    if ($request->param('order_id')) {
      //如果是从我的订单详情页传过来order_id
       // dump($request->param('order_id'));
       $order_id=$request->param('order_id');
       // dump($order_id);die;
      $total_price=Db::table('order_form')->field('total_price')->where(['order_id'=>$order_id,'pay'=>0])->select();
     $this->assign('total_price',$total_price[0]['total_price']);
     $this->assign('order_id',$order_id);
      return $this->fetch('/goorder/pay');

    }
    else
    {
      $order_id='';
      $total_price=Db::table('order_form')->field('total_price')->where(['user_id'=>Session::get('user_id'),'pay'=>0])->order('id desc')->limit(1)->select();
  	   $this->assign('total_price',$total_price[0]['total_price']);
       $this->assign('order_id',$order_id);
       return $this->fetch('/goorder/pay');
    }
    
    // dump($total_price);die;
  }

}