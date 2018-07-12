<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Productcate extends Controller
{
	protected function cateTree($data=[],$len=0,$f_id=0)
	{
		 static $data;
            $sql="select name,f_id,id from product_cate where f_id ={$f_id} ";
            $result = Db::table('product_cate')->query($sql);
              // dump($result);die;
            if (is_array($result)){
                $len+=1;
                $num=count($result);
                for ($i=0;$i<$num;$i++){
                     $result[$i]['name']=str_repeat('&nbsp&nbsp',$len-1).str_repeat('-|',$len-1). $result[$i]['name'];
                    $data[]=$result[$i];
                    $this->cateTree($data,$len,$result[$i]['id']);
                }
            }
            return $data;
       
	}
	public function read()
	{
		$cate=Db::table('product_cate')->order('id desc')->paginate(10);
		 $page = $cate->render();
	   // dump($cate);die;
	    $cate=$cate->all();
		$this->assign('list',$cate);
		$this->assign('page',$page);
		return $this->fetch();
	}
	public function delete(Request $request)
	{
		$id=$request->post('id');
		// dump($ids);
		$query=Db::table('product')->where('c_id',$id)->count();
		if ($query>=1) {
			 return   json(['code'=>0,'msg'=>'该类别有数据不能删除']);
		}
		$delete=Db::table('product_cate')->delete($id);
		if ($delete) {
			 return   json(['code'=>1,'msg'=>'删除成功']);
		}
	}
	public function add(Request $request)
	{
		if ($request->isPost()) {
			$data=$request->post();
			if (empty($data['name'])) {
				 return   json(['code'=>0,'msg'=>'名字不能空']);
			}
			$insert=Db::table('product_cate')->insert($data);
			if ($insert) {
				 return   json(['code'=>1,'msg'=>'添加成功','url'=>'/admin/Productcate/read']);
			}
			else{
				return   json(['code'=>0,'msg'=>'添加失败']);
			}
		}
		else
		{   
			$cate=$this->cateTree();
			$this->assign('cate',$cate);
			return $this->fetch();
		}
	}
	public function edit(Request $request)
	{
		 if ($request->isPost()) {
		     $data=$request->post();
		     // dump($data);die;
		     if (empty($data['name'])) {
		     	return   json(['code'=>0,'msg'=>'名字不能空']);
		     }
		     $update=Db::table('product_cate')->where('id',$data['id'])->update($data);
		      return   json(['code'=>1,'msg'=>'编辑成功','url'=>'/admin/Productcate/read']);
		 }
		 else
		 {
		 	$id=input('id');
		 	$data=Db::table('product_cate')->where('id',$id)->find();
		 	$cate=$this->cateTree();
			$this->assign('data',$data);
			$this->assign('cate',$cate);
		 	return $this->fetch();
		 }
	}
  
}

