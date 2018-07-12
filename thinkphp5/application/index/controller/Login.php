<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use phpmailer\Phpmailer;
use app\index\controller\Basetemplate;

class Login  extends Basetemplate
{

	
    public function login(Request $request)

    {
    	if ($request->isPost()) {
    		 $data=$request->Post();
    		 // dump($data);
    		 if (!captcha_check($data['code']))
    		  {
    		 	 return json(['code'=>0,'msg'=>'验证码不对']);
    		  }
    		  else
    		  {
                 $find=Db::table('member')->where(['phone'=>$data['username'],'status'=>1])->find();
                 if (!$find)
                  {
                 	  return json(['code'=>0,'msg'=>'用户不存在']);
                 }
                 $salt='Random_KUGBJVY';
                 $data['password']=md5($data['password'].$salt);
                 // dump($data['password']);die;
                 $find2=Db::table('member')->where('phone',$data['username'])->where('password',$data['password'])->find();
                 if (!$find2)
                  {
                 	return json(['code'=>0,'msg'=>'密码错误']);
                 }

                    Session::set('user_id',$find['id']);
                    // dump(Session::get('user_id'));
                    Session::set('username',$data['username']);
                    // 查询购物车
                    $shopcar=Db::table('shop_car')->where('user_id',Session::get('user_id'))->count();
                    Session::set('shopcarnumber',$shopcar);
                     // $src_page = $_SERVER['HTTP_REFERER'];
                     // dump(Session::get('username'));die;
                  return json(['code'=>1,'msg'=>'登录成功','url'=>'/Index/index/index']);
    		  }
    	}
    	else
    	{  

    		return $this->fetch();
    	}
         
      
        

    }
    public function logout()
    {
          Session::delete('username');
          Session::delete('user_id');
          Session::delete('shopcarnumber');

          return $this->fetch('/Index/index');

          
    }
}
