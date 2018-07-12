<?php

namespace app\admin\model;

use think\Model;

class Menu extends Model
{
    public function cate_tree($data=[],$len=0,$p_id=0)
    {
	    global $mysql;
	    static $data;
	    $sql="select m_name,p_id,m_id from menu where p_id ={$p_id} ";
	    $result = $mysql->select_list($sql);
	    if (is_array($result))
	    {
	        $len+=1;
	        $num=count($result);
	        for ($i=0;$i<$num;$i++)
	        {
	             $result[$i]['m_name']=str_repeat('&nbsp&nbsp',$len-1).str_repeat('-|',$len-1). $result[$i]['m_name'];
	            $data[]=$result[$i];
	            cate_tree($data,$len,$result[$i]['m_id'],$len);
	        }

	    }
	    return $data;
    }

}
