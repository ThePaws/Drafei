<?php
namespace app\index\model;
use phpmailer\Phpmailer;
/**
* 
*/
class Mail 
{

	public function __construct__($to_add='18124749003@163.com',$title='PHPMailer发送邮件的示例',$content="这是一个<b style=\"color:red;\">PHPMailer</b>发送邮件的一个测试用例")
    {
           $mail=new Phpmailer();
           $toemail = '18124749003@163.com';//定义收件人的邮箱  
            $mail->SMTPDebug = 1;
 
            //使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
            //可以参考https://phpmailer.github.io/PHPMailer/当中的详细介绍
            $mail->isSMTP();
            //smtp需要鉴权 这个必须是true
            $mail->SMTPAuth=true;
            //链接qq域名邮箱的服务器地址
            $mail->Host = 'smtp.163.com';
            //设置使用ssl加密方式登录鉴权
            $mail->SMTPSecure = 'ssl';
            //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
            $mail->Port = 587;
            //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
            $mail->CharSet = 'UTF-8';
            //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
            $mail->FromName = '中国官方';
            //smtp登录的账号 登录到邮箱的用户名
            $mail->Username ='18124749003@163.com';
            //smtp登录的密码 第三方登录的授权码，在邮箱里面设置
            $mail->Password = 't185483123456';
            //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
            $mail->From = '18124749003@163.com';
            //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
            $mail->isHTML(true); 
            //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
            // $mail->addAddress('18124749003@163.com');
            // //添加多个收件人 则多次调用方法即可
            // $mail->addAddress('18124749003@163.com','晶晶在线用户2');
            //添加多个/一个收件人
            if(is_array($to_add)){
            foreach ($to_add as $key => $value) {
                $mail -> AddAddress($value);
            }
	        }else{
	            $mail -> AddAddress($to_add);    //收人的邮件地址
	        }
	        //添加该邮件的主题
            $mail->Subject = 'PHPMailer发送邮件的示例';
            //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
            $mail->Body = "这是一个<b style=\"color:red;\">PHPMailer</b>发送邮件的一个测试用例";
            // //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
            // $mail->addAttachment('./d.jpg','mm.jpg');
            // //同样该方法可以多次调用 上传多个附件
            // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
             
             
            //发送命令 返回布尔值 
            //PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
            $status = $mail->send();
             
            //简单的判断与提示信息
            if($status) {
             echo '发送邮件成功';
            }else{
             echo '发送邮件失败，错误信息未：'.$mail->ErrorInfo;
            }
            
    }
}