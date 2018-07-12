<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\controller\Basetemplate;

class Decidepay  extends Basetemplate
{
  public function decidepay_with_order(Request $request)
  {
     $order_id=$request->param('order_id');
     $query=Db::table('order_form')->field('total_price,order_id')->where(['order_id'=>$order_id])->order('id desc')->limit(1)->select();
     // dump($query);die;
    // $total_price=Db::table('order_form')->field('total_price')->where(['user_id'=>Session::get('user_id'),'pay'=>0])->order('id desc')->limit(1)->select();
    $params['subject']='支付宝付款';
    $params['out_trade_no']=$query[0]['order_id'];
    $params['total_amount']=$query[0]['total_price'];
    \alipay\Pagepay::pay($params);
    
  }
  public function decidepay()
  {
  	// echo 'd';die;
  	$query=Db::table('order_form')->field('total_price,order_id')->where(['user_id'=>Session::get('user_id'),'pay'=>0])->order('id desc')->limit(1)->select();
    // $total_price=Db::table('order_form')->field('total_price')->where(['user_id'=>Session::get('user_id'),'pay'=>0])->order('id desc')->limit(1)->select();
  	$params['subject']='支付宝付款';
  	$params['out_trade_no']=$query[0]['order_id'];
  	$params['total_amount']=$query[0]['total_price'];
  	


  	\alipay\Pagepay::pay($params);
    // if ($pay) {
    //       return  $this->fetch('/Paysuccess/paysuccess');
    //       // return  $this->fetch();
    // }
    // else
    // {
    //     echo "<script>windows.history.go(-2)</script>";
    // }
   
  }


  public function notify(Request $request)
  {
    /* $params['out_trade_no'] 商户单号
     * $params['total_amount'] 订单金额
     * $params['app_id']       app_id号
     */
    // $notify_data=$request->get();
    // $query=Db::table('order_form')->field('total_price,order_id')->where(['user_id'=>Session::get('user_id'),'pay'=>0])->find();
    // $order_form["out_trade_no"]=$query["order_id"];
    // $order_form["total_amount"]=$query["total_price"];
    // $data=json_decode($query['data'],true);
    // $pay=\alipay\Pagepay::pay($order_form);
    // if ($pay)
    //  {
         //  启动事务
        // Db::startTrans();
        // try{
        //     foreach ($data as $key => $value)
        //      { 
        //        $number=$value['number'];
        //        $product_attr_group_id=$value['product_attr_group_id'];
        //         //修改库存
        //        $update_stock=Db::table('product_attr_group')->where('id',$product_attr_group_id)->setInc('stock',-$number);
        //        //修改支付状态
        //        $update_pay_state=Db::table('order_form')->where('id',$order_form["out_trade_no"])->update(['pay',1]);
        //         Db::commit();
        //      }
       
        //    }
        // catch (\PDOException $e)
        //  {
        //     Db::rollback();
        //  }
         //
       
    // }
  }


}