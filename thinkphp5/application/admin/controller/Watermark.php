<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use org\Upload;
use think\Session;
class Watermark extends Controller
{
   public function edit(Request $request)
   {
           if ($request->isPost())
            {
             $file=$request->file('img');
             // dump($_FILES);
             if (empty($file)) { 
               return   json(['code'=>0,'msg'=>'请选择上传文件']);
             } 
             //移动到框架应用根目录/public/uploads/ 目录下 
             $info = $file->move(ROOT_PATH . 'public' . DS . 'waterIMg2');
              if ($info) { 
                 $img=Db::table('watermark')->limit(1)->order("id desc")->select();
               //
                  if(is_file($img[0]['img'])){
                       unlink($img[0]['img']);
                   }
               // echo $info->getSaveName();die;
                 $new_img_path['img']='/waterIMg2/'.$info->getSaveName();
                 $update=Db::table('watermark')->where('id',$img[0]['id'])->update($new_img_path);
                 // dump($new_img_path);die;
                if($update){
                  return json(['code'=>1,'msg'=>'文件上传成功','url'=>'/admin/Watermark/edit']);
                 }
                 else
                 {
                  return json(['code'=>1,'msg'=>'文件上传失败']);
                 }
             } else { 
               //上传失败获取错误信息 
               return   json(['code'=>0,'msg'=>$file->getError()]);
             } 
        }
        else
        {
          // Db::name('User')->limit(1)->order("id desc")->select();
         $img=Db::table('watermark')->limit(1)->order("id desc")->select();
         // dump($img[]);die;
         $this->assign('img',$img[0]['img']);
         return $this->fetch();
        }
   }

}
