<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\admin\validate\Product as PV;
class Orderform extends Controller
{ 
    public function read(Request $request)
   {
   	    // Db::table('order_form')->select();
   	$list=Db::table('order_form')->order('id desc')->paginate(5,false,
					[
					    'type'     => 'Bootstrap',
					    'var_page' => 'page',
					'query' =>$request->param(),
					 ]);
	   $page = $list->render();
	   $list=$list->all();
	   foreach ($list as $key => $value) {
	   	  $query=Db::table('member')->field('phone')->where('id',$value['user_id'])->find();
	   	  $list[$key]['count']=$query['phone'];
	   	  // dump($value['count']);
	   }
   	    // dump($page);die;
    
     	$this->assign('page',$page);
     	$this->assign('list',$list);
     	return $this->fetch();
   }
   public function change_send_status(Request $request)
   {
   	  // dump($request->post());
   	  $data=$request->post();
   	  // if ($data) {
   	  // 	# code...
   	  // }
   	  $update=Db::table('order_form')->where('id',$data['id'])->update($data);
   	  if ($update) {
   	  	  return json(['code'=>1,'msg'=>'已经发货']);
   	  }
   	  else
   	  {
   	  	return json(['code'=>0,'msg'=>'发货失败']);
   	  }
   }
   public function details(Request $request)
   {
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
   	  	$data[$key]['send']=$order_form['send'];
   	  	$data[$key]['pay']=$order_form['pay'];
   	  	$data[$key]['p_thumb_path']=Db::table('product_pic')->field('p_thumb_path')->where('pro_id',$value['pro_id'])->find();
   	  	$data[$key]['p_name']=Db::table('product')->field('p_name')->where('p_id',$value['pro_id'])->find();
   	  	$data[$key]['total_price']=$order_form['total_price'];
   	  }
   	  // dump($data);
   	  $this->assign('list',$data);
   	  return $this->fetch();
   	 
   }
}