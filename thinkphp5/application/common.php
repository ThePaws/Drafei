<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
  * 制作水印图片
  * @param  tpye  int    水印方式：0：文字水印 1：图片水印
  * @param  path string 原图路径
  * @param  water 	  string 水印图片
  * @param  location  int    水印位置
  * @return thumbName string 成功返回文件路径
  */


	function waterImg($tpye,$path,$water='',$location=8)
	{
		// 水印位置
		if($location == '') $location = 8;
		// 打开图片
		// dump($path);
		$image = \org\Image::open($path);
		// 判断水印方式
		if( $tpye == 0 ){
			// 文字水印
			$image->text('麦斯威尔','ziti.otf',100,'#ffffff',$location)->save($path);
		}else{
			// 图片水印
			$image->water($water,$location)->save($path);
		}

	}
	 

