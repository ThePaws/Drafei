<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
/**
* 
*/
class Banner extends Controller
{
  
 public function read()
 {
    $bannerImg=Db::table('banner')->field('id,thumb_path')->select();
      // dump($bannerImg);die;
    $this->assign('bannerImg',$bannerImg);
    return  $this->fetch();
 }
 public function edit(Request $request)
 {  
    if ($request->isPost())
      {
        // dump($request->post());
             $file=$request->file('img');

             if (empty($file)) { 
               return   json(['code'=>0,'msg'=>'请上传文件']);
             } 
             //移动到框架应用根目录/public/uploads/ 目录下 
             $info = $file->move(ROOT_PATH . 'public' . DS . 'bannerImg');
              if ($info) { 
                  $img=Db::table('banner')->where('id',$request->post('id'))->find();
                  if(is_file('.'.$img['path'])||is_file('.'.$img['thumb_path'])){
                       unlink('.'.$img['path']);
                       unlink('.'.$img['thumb_path']);
                   }
                  //批量生成缩略图
                 $new_img_path['path']='/bannerImg/'.$info->getSaveName();
                        $image = \think\Image::open('.'. $new_img_path['path']);
                    // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
                          $new_img_path['thumb_path']=dirname( $new_img_path['path']).'/'.'thumb'.md5(uniqid()).basename($new_img_path['path']);//缩略图;
                         $image->thumb(50, 50)->save('.'.$new_img_path['thumb_path']);
                 $insert=Db::table('banner')->where('id',$request->post('id'))->update($new_img_path);
                 // dump($new_img_path);die;
                if($insert){
                  return json(['code'=>1,'msg'=>'banner更新成功','url'=>'/admin/banner/read']);
                 }
                 else
                 {
                  return json(['code'=>1,'msg'=>'banner更新失败']);
                 }
             } else { 
               //上传失败获取错误信息 
               return   json(['code'=>0,'msg'=>$file->getError()]);
             } 
    }
    else
    {
       $img=Db::table('banner')->where('id',input('id'))->find();
         // dump($img);die;
         $this->assign('result',$img);
     return  $this->fetch();
    }
 }
}