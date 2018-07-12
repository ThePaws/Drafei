<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\index\validate\Registe as RG;
use think\Session;
use message\Msg;
use app\index\model\Registe as RGM;
use app\index\controller\Basetemplate;

class Registe extends Basetemplate
{   
    //发送手机验证码
	public function sendMobileCode(Request $request)
	{     
        if ($request->isPost()) {
            $data=$request->post();//'13510491821'
            // dump($phone);die;
            $validate=new RG();
             if (!$validate->scene('sendMobileCode')->check($data))
            {
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }
              $phone=$data['phone'];
              $msg= new Msg();
              $randNumber=$msg->rand();
              Session::set('phoneCode',$randNumber);
              Session::set('sendCode_time',time());
              $result=$msg->send($phone,$randNumber);
              // dump($randNumber);die;
            if($result)
            {
                return json(['code'=>1,'msg'=>'成功']);
            }

            
        }
        // else
        // {

        // }
 
            
    
            
	    	
	}
	
    public function registe(Request $request)

    {
       if ($request->isPost()) {
            // dump($request->param());die;
            $data=$request->post();
            $validate=new RG();
            $phoneCode=$data['phoneCode'];
            if (Session::get('registe_token'!=$data['registe_token']))
            { 
               return ;
            }
           if (!$validate->scene('registe')->check($data))
            {
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }
            if (  (time()-Session::get('sendCode_time'))>60  )
             {
                 return json(['code'=>0,'msg'=>'验证码超过60秒了']);
            }
            if (Session::get('phoneCode')!=$phoneCode)
            {
              return json(['code'=>0,'msg'=>'验证码不正确']);
                   
            }
            // elseif(Session::get('phoneCode')==$phoneCode)
            // {
            //     Session::delete('phoneCode');
            //     Session::delete('sendCode_time');
            // }
            
                 
            if ($data['password']!=$data['repassword'])
            {   
                return json(['code'=>0,'msg'=>'2次密码不一致']);
            }
            if (Db::table('member')->where('phone',$data['phone'])->find())
             {
               return json(['code'=>0,'msg'=>'手机号已经注册']);
            }

            $salt='Random_KUGBJVY';
            $data['password']=md5($data['password'].$salt);
             
            $data['create_time'] = time();
            $registe=new RGM();
                  // die;
            $insert=$registe->save($data);
            if ($insert)
             {
                   Session::delete('phoneCode');
                   Session::delete('sendCode_time');
                   Session::delete('registe_token');
               return json(['code'=>1,'msg'=>'注册成功','url'=>'/Index/Login/login']);
            }

       }
       else
       {
        $token=mt_rand(100,999);
        Session::set('registe_token',$token);
        $this->assign('registe_token',$token);
        return view();
       }
        // dump(233);die;
      
        

    }
}
