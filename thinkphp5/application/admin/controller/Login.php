<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use think\Db;
class Login extends Controller
{

    // $request=Request::instance;
    // dump($request->isPost());die;
    public function logout(Request $request)
    {
            Session::delete('login');
            Session::delete('role');

            $this->redirect('/admin/Login/login');
    }
    public function login(Request $request)
    {
         if (!$request->isPost()) 
        {
            return $this->fetch();
        }
        else
        {
            $data=$request->post();
            isset($data['k_online'])?$data['k_online']:$data['k_online']=0;
            $user['name']=$data['name'];
            $salt='Random_KUGBJVY';
            $user['password']=md5($data['password'].$salt);
   		// dump($user['password']);die;
            if ($data['name']=='') {
                $info=[
                    'code'=>0,
                    'msg'=>'名字不能为空',
                ];
                exit(json_encode($info));
            }
            if ($data['password']=='') {
                $info=[
                    'code'=>0,
                    'msg'=>'密码不能为空',
                ];
                exit(json_encode($info));
            }
            if ($data['vcode']=='') {
                $info=[
                    'code'=>0,
                    'msg'=>'验证码不能为空',
                ];
                exit(json_encode($info));
            }
            //验证码正确,则验证用户名和密码
            if (captcha_check($data['vcode'])) {
                $result = Db::table('user')->where($user)->find();
                if ($result) {
                    Session::set('login',$user);
                   
                    $info=[ 'code'=>1,
                        'msg'=>'登录成功',
                        'url'=>'/admin/Index/index'
                    ];
                    exit(json_encode($info));
                }else
                {
                    $info=[
                        'code'=>0,
                        'msg'=>'用户/密码不正确',
                    ];
                    exit(json_encode($info));
                }
            }else
            {
                $info=[
                    'code'=>0,
                    'msg'=>'验证码不正确',
                ];
                exit(json_encode($info));
            }

        }
       
       

    }
}