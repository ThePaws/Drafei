<?php
namespace app\admin\controller;
use  think\Db;
use  think\Session;
use  app\admin\controller\Base;
use  think\Request;
class Index extends Base
{       
         //手机验证码
	   
	    public function welcome()
	    {
	      return	$this->fetch();
	    }
	    public  function index()
	    {        
	    	$menu_list= $this->menu_list();
	    	$this->assign('list',$menu_list);
	    	// var_dump($menu_list);die;
	    	
	    	$owener_list=$this->owener_list();
	    	
	    	$this->assign('owener_list',$owener_list);

	    	// var_dump($owener_list);die;
		    return $this->fetch();
	    }
			/**
	     *  
	     *
	     * 
	     * @return array 返回所有的菜单的表
	     */
	    public function menu_list()
	    {
	    	// $menu= new Menu();
		//列出所有的菜单menu_id;但是在权限管理里面,会根据当前用户的等级来选择性显示菜单
		    $data =Db::table('menu')->field('m_id,m_name,fun,fl')->where(['p_id'=>0,'display'=>1])->select(); //父级数据
		    foreach ($data as $key => $value)
		     {
		        if(is_array($value)){
		            $sql = "select m_id,m_name,fun,fl from menu where p_id={$value['m_id']} and status = 1";
		            $data[$key]['next'] = Db::table('menu')->query($sql); //子级数据
		        }
		     }
		     return $data;

	    }
	    	/**
	     *  
	     * @return array 返回当前用户拥有的菜单表
	     */
	    public function owener_list()
	    {
	    	   $u_id=Db::table('user')->field('id')->where('name',Session::get('login')['name'])->find();
               $r_id=Db::table('user_role')->field('r_id')->where('u_id',$u_id['id'])->find();
               if ($r_id['r_id']==0) {
               	   Session::set('role','super');
               	return $m_id=[0];
               }
               $m_id=Db::table('role_menu')->field('m_id')->where('r_id',$r_id['r_id'])->find();
               $m_id=json_decode($m_id['m_id']);
               return $m_id;


	    }
}