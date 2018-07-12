<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\controller\Basetemplate;

class Prodetails  extends Basetemplate
{
	 
	
    public function prodetails(Request $request)
    {
        // dump(233);die;
      
      if (Session::has('username'))
      {
        // dump(Session::get('user_id'));die;
          $shopcar=Db::table('shop_car')->where('user_id',Session::get('user_id'))->count();
            // Session::delete('shopcarnumber');
          Session::set('shopcarnumber',$shopcar);
         // $this->assign('buynumber',$shopcar);
         
      }
      

        $color_group=Db::table('product_attr')->where('attr_cate_id',1)->select();
        $size_group=Db::table('product_attr')->where('attr_cate_id',2)->select();
        // dump($size_group);die;
      $id=$request->get('id');
      $details=Db::table('product')->where('p_id',$id)->find();
      $img=DB::table('product_pic')->where('pro_id',$id)->select();
      $product_attr_group=Db::table('product_attr_group')->field('attr_id')->where('pro_id',$id)->select();
      $attr_id='';
      // dump($product_attr_group);
      foreach ($product_attr_group as $key => $value) {
            $attr_id.=$value['attr_id'].',';
      }
      $attr_id=trim($attr_id,',');
      // dump($attr_id);
      $all_attr_id=explode(',', $attr_id);
      // dump($all_attr_id);
      $unique=array_unique($all_attr_id);
      sort($unique);
      foreach ($color_group as $key => $value) {
        if (!in_array($value['id'], $unique))
         {
          unset($color_group[$key]);
        }
      }
       foreach ($size_group as $key => $value) {
        if (!in_array($value['id'], $unique))
         {
            unset($size_group[$key]);
        }
      }
        // dump($size_group);
      // dump($product_attr_group);
      // dump($details);
        $this->assign('img',$img);
        $this->assign('details',$details);
        $this->assign('color_group',$color_group);
        $this->assign('size_group',$size_group);
       return $this->fetch();
    }
    public function addshopcar(Request $request)
    {
        $data= $request->post();
        // dump($data);die;
        $data['user_id']=Session::get('user_id');
        // unset($data['number']);
        $shopcar=Db::table('shop_car')->where('user_id',Session::get('user_id'))->count();
        // dump($shopcar);die;
        if (Session::has('username'))
        {
        // dump(Session::get('user_id'));die;
            $buydata=Db::table('shop_car')->where(['pro_id'=>$data['pro_id'],'attr_id'=>$data['attr_id'],'user_id'=>$data['user_id']])->count();
            // dump($buydata);die;
            if (!$buydata) {
              //没有这组属性的数据,就添加
               Db::table('shop_car')->insert($data);
                return json(['code'=>1,'msg'=>'添加购物车成功','addnumber'=>1]); 
            }
            else
            {//有这组属性的数据,就修改number
              $update=Db::table('shop_car')->where(['pro_id'=>$data['pro_id'],'attr_id'=>$data['attr_id'],'user_id'=>$data['user_id']])->setInc('number',$data['number'] );
                return json(['code'=>1,'msg'=>'添加购物车成功','addnumber'=>0]); 
            }
          
        }
        else
        {
          return json(['code'=>0,'msg'=>'请先登录','url'=>'/Index/Login/login']);
        }
     
          
    }
    public function queryPrice(Request $request)
    {
      $post=$request->post();
      $attr_id='';
      foreach ($post['id'] as $key => $value) {
         $attr_id.=$value.',';
      }
      $attr_id=trim($attr_id,',');
      $p_id=$post['p_id'];
       $queryPrice=Db::table('product_attr_group')->where(['pro_id'=>$p_id,'attr_id'=>$attr_id])->find();
       // dump($queryPrice);die;
       if ($queryPrice) {
        return json(['code'=>1,'msg'=>$queryPrice['price']]);
       }
       else
       {
          return json(['code'=>0,'msg'=>'不存在此种组合的价格']);

       }
    }
}
