<?php
namespace app\admin\controller;
use  think\Controller;
use  think\Request;
use  think\Session;
class Base extends Controller{
//判断是否有cookie登录,没有登录就登录
       function __construct(Request $request ){
    	  
	      parent::__construct();
	      if (!Session::has('login'))
	       {
	           return $this->redirect('admin/Login/login');
	          
	       }
	      
	       
    }
}