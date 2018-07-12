<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\controller\Basetemplate;

class Paysuccess  extends Basetemplate
{

	public function  paysuccess(Request $request)
	{
		 $notify_data=$request->get();
		 // dump($notify_data);die;
		 // $notify_data['out_trade_no']=13351530004608;
		  $query=Db::table('order_form')->field('total_price,order_id')->where(['user_id'=>Session::get('user_id'),'pay'=>0,'order_id'=>$notify_data['out_trade_no']])->find();
		  // dump($query);die;

		  // if ($query['total_price']== $notify_data['total_amount']) 
		  // {
		  	//查询订单详情表
		  	$details=Db::table('order_form_details')->where('order_id',$query['order_id'])->select();
		  	 //  启动事务
		        Db::startTrans();
		        try{
		            foreach ($details as $key => $value)
		             {
                       $product_attr_group['pro_id']=$value['pro_id'];
                       $attr_id_list=explode(',', $value['attr_id']);
                       // dump($attr_id_list);die;
		               $number=$value['number'];
		                //修改库存
		               // $update_stock=Db::table('product_attr_group')->where(['pro_id'=>$product_attr_group['pro_id'],'color_id'=>$attr_id_list[0],'size_id'=>$attr_id_list[1]])->setDec('stock',$number);
		               // dump($update_stock);die;
		               //修改支付状态
		               $update_pay_state=Db::table('order_form')->where('order_id',$query['order_id'])->update(['pay'=>1]);
		               $update_pay_state2=Db::table('order_form_details')->where('order_id',$query['order_id'])->update(['pay'=>1]);
		               // dump($update_stock);die;
		                Db::commit();
		             }
		       
		           }
		        catch (\PDOException $e)
		         {
		            Db::rollback();
		         }
		  	 
		  // }
		  $check_pay_state=Db::table('order_form')->field('pay,total_price')->where('order_id',$query['order_id'])->find();
		  // dump($check_pay_state);die;
	    if ($check_pay_state['pay']==1)
	    {    $this->assign('total_price',$check_pay_state['total_price']);
			 return $this->fetch();
		}
	}
}