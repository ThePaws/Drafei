<?php
 namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\validate\Address as v_Address;
use app\index\controller\Basetemplate;

class Address  extends Basetemplate
{
	public function read(Request $request)
	{
		$user_id=Session::get('user_id');
		// dump($user_id);
		$add_array=Db::table('address')->where('u_id',$user_id)->select();
		$this->assign('address',$add_array);
		return $this->fetch();
	}
	public function edit(Request $request)
	{
		if ($request->isAjax()) {
			$post=$request->post();
			 $update=Db::table('address')->where('id',$post['id'])->update($post);
			 if($update!==false){
                     return json(['code'=>1,'msg'=>'编辑成功']); 
			 }
			 else
			 {
                  return json(['code'=>0,'msg'=>'编辑失败']); 
			 }
		}
		else
		{
			$address_id=input('id');
			// dump($address_id);
			$address=Db::table('address')->where('id',$address_id)->find();
			// dump($address);die;
			$this->assign('address',$address);
		    return	$this->fetch();
		}
		
	}
	public function dele(Request $request)
	{
		$address_id=input('id');
		// dump($address_id);
		$dele=Db::table('address')->delete($address_id);
		if ($dele) {
		 return json(['code'=>1,'msg'=>'删除成功']); 
	    }
	    else
		{
          return json(['code'=>0,'msg'=>'删除失败']); 
		}
	}
	public function add(Request $request)
	{
		 if ($request->isPost()) {
		 	 $post=$request->post();
		 	 $v_Address=new v_Address();
		 	 if (!$v_Address->check($post)) {
		 	 	 return json(['code'=>0,'msg'=>$v_Address->getError()]); 
		 	 }
		 	 $post['u_id']=Session::get('user_id');
		 	 $insert=Db::table('address')->insert($post);
		 	 if ($insert) {
		 	 	 return json(['code'=>1,'msg'=>'添加地址成功']); 
		 	 	
		 	 }
		 	 else
		 	 {
		 	 	 return json(['code'=>0,'msg'=>'添加地址失败']); 

		 	 }
		 }
		 else
		 {
            return $this->fetch();
		 }
		
	}
}