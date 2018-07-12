<?php
 namespace app\index\controller;
use think\Controller;
use think\Config;
use app\index\controller\Base;
use app\admin\model\Msg;
use think\Db;
use app\index\controller\Basetemplate;
// use phpmailer\Phpmailer;
use app\index\model\Mail;
class Index  extends Basetemplate
{   
	public function mobile_vcode()
	{
            $msg= new Msg();
            $result=$msg->send('18124749003');
            // dump($result['respCode']);
	    	
	}
	
    public function index()

    {
      $newst_product=Db::table('product')->limit(10)->order('p_id desc')->select();
      foreach ($newst_product as $key => $value) {
          $newst_product[$key]['path']=Db::table('product_pic')->field('path')->limit(1)->order('id desc')->where('pro_id',$value['p_id'])->select();
      }
      // $maxID=DB::table('product')->query('select max(p_id) from product');
      // dump($subBanner);
        // dump(233);die;
      $this->assign('subBanner',$newst_product);
      return $this->fetch();
        

    }
    public function mail()
    {
          $send = new Mail();
          
    }
}
