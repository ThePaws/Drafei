<?php

namespace app\admin\model;

use think\Model;
use think\Db;
class Cate_tree extends Model
{

public  function cate_tree($data=[],$len=0,$f_id=0,$table='product',$field='c_name,f_id,id')
        {
            static $data;
            $sql="select $field from $table where f_id ={$f_id} ";
            $result = Db::table($table)->query($sql);
            if (is_array($result)){
                $len+=1;
                $num=count($result);
                for ($i=0;$i<$num;$i++){
                     $result[$i]['c_name']=str_repeat('&nbsp&nbsp',$len-1).str_repeat('-|',$len-1). $result[$i]['c_name'];
                    $data[]=$result[$i];
                    cate_tree($data,$len,$result[$i]['id'],$len);
                }
            }
            return $data;
        }
}