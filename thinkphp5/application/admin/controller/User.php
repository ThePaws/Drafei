<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\validate\User as validate;
use app\admin\model\User as us;
use app\admin\model\User_role as user_role;

class User extends Controller
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function read()
    {  
        $query='select user.id id, user.name name ,role.name r_name from user,user_role,role where user.id = user_role.u_id and user_role.r_id = role.id';
        $list = Db::query($query);
        // dump($list); die;
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add(Request $request)
    {
        if ($request->isPost()) {
            $data=$request->post();
            // dump($data);die;
             $validate=new validate();
             $user=new us();
             $user_role=new User_role();

            if (!$validate->check($data)) {
                
               return json(['code'=>0,'msg'=>$validate->getError()]);
            }
            else
            {      
                    
                    $user->save($data);
                    $insertId=$user->id;
                    $insertData=['u_id'=>$insertId,'r_id'=>$data['r_id']];
                    $insert=$user_role->save($insertData);
                if ($insertId&&$insert)
                 {
                      return json(['code'=>1,'msg'=>'添加成功','url'=>'/admin/user/read']);
                }
                else
                {
                     return json(['code'=>1,'msg'=>'添加失败']);
                }
              
            }   
        }
        else
        {
            $role_list=Db::table('role')->select();
            $this->assign('role_list',$role_list);
          return  $this->fetch();
        }
        
    }
     /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return json
     */
    public function delete(Request $request)
    {
        $ids=$request->post('items');
         $user = new us();
         $user_role=new User_role();
         // $user->fetchSql(true)->whereIn('id',$ids)->delete();
         $user->whereIn('id',$ids)->delete();
         $result=$user_role->whereIn('u_id',$ids)->delete();
         if ($result) {
              exit(json_encode(['code'=>1,'msg'=>'删除成功','url'=>'/admin/user/read']));
         }
         else
         {
              exit(json_encode(['code'=>0,'msg'=>'删除失败'])); 
         }      
    }
     /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Request $request)
    {
        if ($request->isPost()) {
            $validate=new validate();
            $data=$request->param();
            // dump($data);die;
            if (!$validate->check($data)) {
                return  json(['code'=>0,'msg'=>$validate->getError()]);
            }
            if (!empty($data['password'])) {
                 $salt='Random_KUGBJVY';
                 $data['password']=md5($data['password'].$salt);
            }
            else
            {
                   unset($data['password']);
            }
                $user=new us();
                $exec= $user->update($data); 
                $user_role=Db::table('user_role')->where('u_id',$data['id'])->update(['r_id'=>$data['r_id']]);
            
            if ($user) 
            {
               exit(json_encode(['code'=>1,'msg'=>'修改成功','url'=>'/admin/user/read']));
            }
            else
            {
                 exit(json_encode(['code'=>0,'msg'=>'修改失败']));
            }
           
        }
        else
        {
            // dump($request->param()['id']);
            $u_id=$request->param()['id'];
            $sql='select user.* from user where id= '.$u_id;
            $sql2='select role.id r_id from user,user_role,role where user.id = user_role.u_id and user_role.r_id = role.id and user.id='.$u_id;
            $user_info=Db::query($sql);
            $user_role=Db::query($sql2);
            $user_info[0]['r_id']=$user_role[0]['r_id'];
            $role=Db::table('role')->select();
            $this->assign('category',$role);
            $this->assign('result',$user_info[0]);
            // dump($user_info); 
            // dump($role);die;
           return $this->fetch();
        }
        
    }

   
}
