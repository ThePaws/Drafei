<?php


namespace app\admin\model;

use think\Model;

class User extends Model
{
    protected $field=true;//过滤掉数据库中不存在的字段
    protected $insert = ['create_time'];
    protected $update = ['update_time'];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    function setCreateTimeAttr()
    {
        return time();
    }

    function setUpdateTimeAttr()
    {
        return time();
    }
    
}
