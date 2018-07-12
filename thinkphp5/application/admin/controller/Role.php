<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\Request;
use app\admin\model\Role as RL;
use app\admin\model\Role_menu as RM;
use app\admin\validate\Role as Validate;
/**
* 
*/
class Role extends Controller
{
	public function read()
	{
		$data = Db::table('role')->select();
		$role_mid=Db::table('role_menu')->join('role','role.id=role_menu.r_id')->select();
			foreach ($role_mid as $key => $value) {
		        $level = json_decode($value['m_id']);
		        $str = '';
		            foreach ($level as $k => $val) {
		                    $res= Db::table('menu')->where('m_id',$val)->find();
		                    $str .= $res['m_name'].'|';
		            }
		            $str = rtrim($str,'|');
		            $data[$key]['m_name'] = $str;
		    }
		$this->assign('list',$data);
		return $this->fetch();
	}
    public function edit(Request $request)
    {
       if ($request->isPost())
       {
         // dump($request->param());
         $data= $request->param();
         $data['m_id']= json_encode($request->param()['m_id']);
         $role=new RL();
         $role_menu= new RM();
         $role->startTrans();
            try{
                $update= $role_menu->allowField(true)->update(['m_id'=>$data['m_id']],['r_id'=>$data['r_id']]);
                $update_name=$role->allowField(true)->update(['name'=>$data['r_name']],['id'=>$data['r_id']]);
				$update->commit();
				if ($update) {
					 $info=[
                        'code'=>1,
                        'msg'=>'修改成功',
                        'url'=>'/admin/role/read'
					 ];
					  exit(json_encode($info));
				}
				}
			catch(\Exception $e)
				{
					// dump($e->getMessage());
				    $role->rollback();
				}		    
       }
       else
       {
       	$id = $request->param('id');
       	// dump($id);die;
       	$role_mid=Db::table('role_menu')->join('role','role.id=role_menu.r_id')->where('r_id',$id)->find();
		    $role_has_mid['m_id'] = json_decode($role_mid['m_id']);
		    $menuAll=Db::table('menu')->where('p_id',0)->field('m_id,m_name')->select();
       	     //父级数据
	        foreach ($menuAll as $key => $value) 
	        {
	            if(is_array($value))
	            {
	                $menuSub=Db::table('menu')->where('p_id',$value['m_id'])->field('m_id,m_name')->select();
                    $menuAll[$key]['next']=$menuSub;
	            }
	        }
       	      // dump($menuAll);die;
       	$this->assign('r_id',$id);      
       	$this->assign('r_name', $role_mid['name']); 
       	$this->assign('role_has_mid',$role_has_mid['m_id']);     
       	$this->assign('list',$menuAll);      
         return	$this->fetch();
       }
    }
    public function delete(Request $request)
    {
    	$id=$request->param('items');
    	// dump($id);die;
    	$user_role= Db::table('user_role')->where('r_id','in',$id)->select();
    	// dump($user_role);
    	if ($user_role) {
    		exit(json_encode(['code'=>0,'msg'=>'该角色下对应有用户,请先取消用户角色']));
    	}
    	else
    	{  
    		$role_dele=Db::table('role')->where('id','in',$id)->delete();
    		$role_menu=Db::table('role_menu')->where('r_id','in',$id)->delete();
    		exit(json_encode(['code'=>1,'msg'=>'删除成功','url'=>'/admin/role/read']));
    	}
    }
    public function add(Request $request)
    {
    	if ($request->isPost())
       {
        $validate= new Validate;
        $post=$request->post();
         if (!$validate->check($post))
          {
            exit(json_encode(['code'=>0,'msg'=>$validate->getError()]));
          }
         
        $name=$request->post()['name'];

         $role_add = Db::table('role')->strict(true)->insert(['name'=>$name]);
         $getLastInsID= Db::table('role')->getLastInsID();
         // dump($getLastInsID);
         $data['r_id']=$getLastInsID;
         $data['m_id']=json_encode($request->param()['m_id']);
         $role_menu_add = Db::table('role_menu')->insert($data);
         if ($role_menu_add) {
            exit(json_encode(['code'=>1,'msg'=>'添加成功','url'=>'/admin/role/read']));
         }
         else
         {
           exit(json_encode(['code'=>0,'msg'=>'添加失败']));
         }
       }
        $menuAll=Db::table('menu')->where('p_id',0)->field('m_id,m_name')->select();
             //父级数据
          foreach ($menuAll as $key => $value) 
          {
              if(is_array($value))
              {
                  $menuSub=Db::table('menu')->where('p_id',$value['m_id'])->field('m_id,m_name')->select();
                    $menuAll[$key]['next']=$menuSub;
              }
          }
       $this->assign('data',$menuAll);   
    	return $this->fetch();
    }
}