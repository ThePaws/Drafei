<?php
namespace app\admin\model;
use think\Model;
use think\Db;
/**
* 
*/
class Product extends Model
{
    protected $field=true;
    protected $autoWriteTimestamp = true;     // 自动写入时间戳
    protected $insert = ['create_time'];
    // 默认的字段为create_time 和 update_time
    protected $update = ['update_time'];
    // public function create(){

    // }
    public function getSpecInput($goods_id, $spec_arr)
    {
        // <input name="item[2_4_7][price]" value="100" />
        //<input name="item[2_4_7][name]" value="蓝色_S_长袖" />        
        /*$spec_arr = array(         
            20 => array('7','8','9'),
            10=>array('1','2'),
            1 => array('3','4'),
            
        );  */        
        // 排序
        // dump($spec_arr); 
        foreach ($spec_arr as $k => $v)
        {
            $spec_arr_sort[$k] = count($v);
        }
        asort($spec_arr_sort);  
          // dump($spec_arr_sort);   
        foreach ($spec_arr_sort as $key =>$val)
        {
            $spec_arr2[$key] = $spec_arr[$key];
        }
     
        
         $clo_name = array_keys($spec_arr2);
             
         $spec_arr2 = $this->dikaer($spec_arr2); //  获取 规格的 笛卡尔积                 
               // dump($spec_arr2); 

          //属性的分类的名字和id      
         $spec = Db::table('product_attr_cate')->field('id,name')->select(); 
          //属性表的id ,属性名字,属性的分类id     
         $specItem = Db::table('product_attr')->field('id,attr,attr_cate_id')->select();
         $keySpecGoodsPrice_first =  Db::table('product_attr_group')->where('pro_id = '.$goods_id)->field('id,attr_id,price,stock')->select();//规格项
          // dump($keySpecGoodsPrice);die;
         foreach ($keySpecGoodsPrice_first as $key => $value) {
                  $keySpecGoodsPrice[$key]['attr_id']=str_replace(',', '_',$value['attr_id']);
                  $keySpecGoodsPrice[$key]['price']=$value['price'];
                  // dump($value['attr_id']);
         }
         // dump(array_keys($keySpecGoodsPrice));die;
         foreach ($keySpecGoodsPrice as $key => $value) {
         //      $keySpecGoodsPrice[$key];
               $arr_value[$value['attr_id']]['price']=$value['price'];
         }
          $keySpecGoodsPrice=$arr_value;
       $str = "<table class='table table-bordered' id='spec_input_tab'>";
       $str .="<tr>";       
       // 显示第一行的数据 
       // dump($clo_name);
       // dump($spec);
       foreach ($clo_name as $k => $v) 
       {  
        // echo '$v:'.$v;
        //    echo '$spec[$k][id]:'. $spec[$k]['id'];
        //    //echo '$spec[$k][id]:'.$spec[$k]['name'];echo "<br/>";
        //    if ($v==$spec[$k]['id']) {
        //      echo $v.':'.$spec[$k]['id'];
        //       //$k-1因为$k从1开始,要变成从1开始
            
        //    }
          foreach ($spec as $key => $value) {
            if ($v==$value['id']) {
                $str .=" <td><b></b></td>";
            }
          }
       }    
        $str .="<td><b>价格</b></td>
             </tr>";
       // 显示第二行开始
          // dump($spec_arr2);
        // dump($specItem);
       foreach ($spec_arr2 as $k => $v) 
       {
       	
       	  // dump($v);
            $str .="<tr>";
            $item_key_name = array();
        
        // dump($spec_arr2);

        // dump($v);// dump($v);
            foreach($v as $k2 => $v2)
            {  
              foreach ($specItem as $key => $value) {
                   if ($value['id']==$v2) {
                     $str .="<td>{$value[attr]}</td>";
                     $item_key_name[$v2] = $value[attr];
                //$v2-1因为$v2从1开始,要变成从0开始
                   }
                 }
                // $str .="<td>{$specItem[$v2-1][attr]}</td>";//$v2-1因为$v2从1开始,要变成从0开始

                // $item_key_name[$v2] =$specItem[$v2-1]['attr'];


            }   
               // dump($item_key_name);
               //array(2) {
                                          //[1] =&gt; string(7) ":灰色"
                                          //[6] =&gt; string(5) ":66cm"
                                    //}

            // die;
            ksort($item_key_name); 
            $item_key = implode('_', array_keys($item_key_name));
            // $item_name = implode(' ', $item_key_name);
            // dump([$item_key]);
			$keySpecGoodsPrice[$item_key][price] ? false : $keySpecGoodsPrice[$item_key][price] = 0; // 价格默认为0
			$keySpecGoodsPrice[$item_key][stock] ? false : $keySpecGoodsPrice[$item_key][stock] = 0; //库存默认为0
            $str .="<td><input name='item[$item_key][price]' value='{$keySpecGoodsPrice[$item_key][price]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")' /></td>";
            // $str .="<td><input name='item[$item_key][stock]' value='{$keySpecGoodsPrice[$item_key][stock]}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'/></td>";            
           
            // $str .="<td><button type='button' class='btn btn-default delete_item'>无效</button></td>";
            $str .="</tr>";
       }
        $str .= "</table>";
       return $str;   
    }
    public  function dikaer($arr){
		  $arr1 = array();
		  $result = array_shift($arr);
		  while($arr2 = array_shift($arr)){
		    $arr1 = $result;
		    $result = array();
		    foreach($arr1 as $v){
		      foreach($arr2 as $v2){
		        if(!is_array($v))$v = array($v);
		        if(!is_array($v2))$v2 = array($v2);
		        $result[] = array_merge_recursive($v,$v2);
		      }
		    }
		  }
		  foreach ($result as $key => $value) {
		  	   sort($value);//重新排序,按照数值从小到大,键值也重新从小到大
		  	   $result2[$key]=$value;
		  }
     // dump($result2);
       if (count($result2) == count($result2, 1))
       {
       // 如果进来if中则$arr'是一维数组';如 $arr=[0=>'1',1=>2];则变成二维数组
          foreach ($result2 as $key => $value) {
                $result3[$key]=[$key=>$result2[$key]];
                
                 
          }
         return $result3;
      } 
		  return $result2;
     }
  
}