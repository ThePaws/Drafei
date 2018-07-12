<?php
 namespace app\index\model;
use think\Model;
class Registe  extends Model
{  
    protected $table='member';
    protected $field=true;//过滤掉数据库中不存在的字段
    // protected $createTime='create_time';
    // protected $updateTime = 'update_time';

    // protected $insert = ['cre_time'];
    // protected $update = ['up_time'];
    // *
    //  * 显示资源列表
    //  *
    //  * @return \think\Response
     
    // function setCreateTimeAttr()
    // {
    //     return time();
    // }

    // function setUpdateTimeAttr()
    // {
    //     return time();
    // }
}