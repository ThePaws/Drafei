<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\controller\Basetemplate;

class Myorder  extends Basetemplate
{
	public function myorder()
	{   
		$user_id=Session::get('user_id');
   	  	$order_form=Db::table('order_form')->where('user_id',$user_id)->order('id desc')->paginate(3);
   	  	$page=$order_form->render();
   	  	$order_form=$order_form->all();
   	  	// dump($order_form);die;
   	  	foreach ($order_form as $kk => $vv) {
   	  		 $data[]=Db::table('order_form_details')->where('order_id',$vv['order_id'])->order('id desc')->limit(1)->select();
   	  	}
   	  	// dump($data);die;
		
   	  foreach ($data as $key => $value) {
   	  	//
   	  	// dump($value);die;
   	  	 
   	  	  foreach ($value as $key2 => $value2) {
   	  	  	  $attr_id_list=explode(',', $value2['attr_id']);
               $att_name_list='';
			  	 foreach ($attr_id_list as $k => $v)
			  	 {   
			  	 	 $attr=Db::table('product_attr')->field('attr')->where('id',$v)->find();
			  	 	 $att_name_list.=$attr['attr'].'|';
			  	 }
			  	   $att_name_list=rtrim($att_name_list,"|");
			  	    $data[$key][$key2]['att_name_list']= $att_name_list;
			  	 	 // dump($key2);
			  	 	 // foreach ($order_form as $key => $value) {
			  	 	 // 	# code...
			  	 	 // }
	   	  	$data[$key][$key2]['send']=$order_form[$key]['send'];
	   	  	// $data[$key][$key2]['pay']=$order_form['pay'];
	   	  	$data[$key][$key2]['p_thumb_path']=Db::table('product_pic')->field('p_thumb_path')->where('pro_id',$value2['pro_id'])->find();
	   	  	$data[$key][$key2]['p_name']=Db::table('product')->field('p_name')->where('p_id',$value2['pro_id'])->find();
	   	  	$data[$key][$key2]['show_price']=Db::table('product')->field('show_price')->where('p_id',$value2['pro_id'])->find();
	   	  	$data[$key][$key2]['total_price']=$order_form[$key]['total_price'];
   	  	  }
          // dump($data);die;
   	  	//
			  	    // dump($att_name_list);die;
   	  }
          // dump($data);die;

	   	  $this->assign('page',$page);
	   	  $this->assign('list',$data);
		return $this->fetch();
	}
	public function delete(Request $request)
	{
		$id=$request->post('id');
		// dump($id);
		$delete=Db::table('order_form')->where('order_id',$id)->delete();
		$delete_details=Db::table('order_form_details')->where('order_id',$id)->delete();
		if ($delete_details) {
			return json(['code'=>1,'msg'=>'删除订单成功']); 
		}
		else
		{
			return json(['code'=>0,'msg'=>'删除订单失败']);
			// 12191531100077
		}
		 
	}
	public function details(Request $request)
	{
		// $id=$request->param('order_id');
		// dump($id);die;
		 $order_id=$request->param('order_id');
   	  $data=Db::table('order_form_details')->where('order_id',$order_id)->select();
   	  	$order_form=Db::table('order_form')->where('order_id',$order_id)->find();
   	  foreach ($data as $key => $value) {
   	  	//
   	  	  $att_name_list='';
          $attr_id_list=explode(',', $value['attr_id']);
			  	 foreach ($attr_id_list as $k => $v)
			  	 {   
			  	 	 $attr=Db::table('product_attr')->field('attr')->where('id',$v)->find();
			  	 	 $att_name_list.=$attr['attr'].'|';

			  	 }
			  	   $att_name_list=rtrim($att_name_list,"|");
			  	    $data[$key]['att_name_list']= $att_name_list;
			  	 	  // dump($data);die;
   	  	//
			  	    // dump($att_name_list);die;
   	  	$data[$key]['add']=Db::table('address')->field('person,phone,add')->where('id',$value['add_id'])->find();
   	  	$data[$key]['send']=$order_form['send'];
   	  	$data[$key]['pay']=$order_form['pay'];
   	  	$data[$key]['p_thumb_path']=Db::table('product_pic')->field('p_thumb_path')->where('pro_id',$value['pro_id'])->find();
   	  	$data[$key]['p_name']=Db::table('product')->field('p_name')->where('p_id',$value['pro_id'])->find();
   	  	$data[$key]['show_price']=Db::table('product')->field('show_price')->where('p_id',$value['pro_id'])->find();
   	  	$data[$key]['total_price']=$order_form['total_price'];
   	  }
   	  // dump($data);
   	  $this->assign('list',$data);
   	  return $this->fetch();
	}
}