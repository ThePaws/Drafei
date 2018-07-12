<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\admin\validate\Product as PV;
class Member extends Controller
{ 
     public function read()
     {  
     	$member=Db::table('member')->order('id desc')->paginate(3);
	   $page = $member->render();

     	$this->assign('page',$page);
     	$this->assign('result',$member);
     	return $this->fetch();
     }
     public function change_password(Request $request)
     { 
        if ($request->isGet()){
        	$id=$request->param('id');
	     	$count=Db::table('member')->where('id',$id)->find();
	     	$this->assign('count',$count);
	     	return $this->fetch();
        }
        else
        {   
        	if ($request->isPost()) {
        		$password['password']=$request->post('password');
        		 if (empty($password['password'])) {
        		 	return json(['code'=>0,'msg'=>'密码不能为空']);
        		 }
        		$phone=$request->post('phone');
        		 $salt='Random_KUGBJVY';
                 $data['password']=md5($password['password'].$salt);
                 $data['update_time']=time();
        		$update=Db::table('member')->where('phone',$phone)->update($data);
        		// dump($update);
        		if ($update) {
        			return json(['code'=>1,'msg'=>'修改成功']);
        		}
        		else{
        			return json(['code'=>0,'msg'=>'修改失败']);
        		}

        		
        	}

        }
     	
     }
     public function change_status(Request $request)
     {
     	$data=$request->post();
     	// dump($data);die;
     	$update=Db::table('member')->where('id',$data['id'])->update($data);
     	if ($update) {
     		 return json(['code'=>1,'msg'=>'修改成功']);
     	}
     	else
     	{
     		 return json(['code'=>0,'msg'=>'修改失败']);
     	}
     }
}
