<?php
namespace message;

 /**
 这个类,要先new ,之后调用这个对象的rand(),然后把rand()的返回值存进 session中,再把这个
 返回值$randnumber作为send($phone,$nubmer)的一个参数
 * 
 */
 class Msg
 {
  
  // return  随机的6位数
    public function rand()
    {
      return rand(100000,999999);
    }
    protected function config($randNumber){
   
       return [               
                      'url' =>'https://api.miaodiyun.com/20150822/industrySMS/sendSMS',
                      'header'=>'Content-type:application/x-www-form-urlencoded',
                        'accountSid'=>'f69fb141d01540518b66bce3b44f5272',
                        'smsContent'=>'【大国科技】登录验证码：'.$randNumber.'，如非本人操作，请忽略此短信。',
                        'to'=>'',//接收短信的手机号
                        'timestamp'=>date('YmdHis',time()),
                        'authToken'=>'bfbaaabcdaad4750aced17d59cd99ba4',
                        'respDataType'=>'JSON'
        ];
     }
    public function dataUnit($phone,$randNumber)
   
    {  
        // $smsContent='【Music电台】您的验证码为951478，请于2分钟内正确输入，如非本人操作，请忽略此短信。';
        // dump($randNumber);die;
        // $smsContent='【大国科技】登录验证码：'.rand(100000,999999).'，如非本人操作，请忽略此短信。';
        $config=$this->config($randNumber);
      $data=[
                  'accountSid'=>$config['accountSid'],
                    'smsContent'=>$config['smsContent'],
                    'to'=>$phone,
                    'timestamp'=>$config['timestamp'],
                    'sig'=>md5($config['accountSid'].$config['authToken'].$config['timestamp']),
                    'respDataType'=>$config['respDataType']
            ];
            // return $data;
      $result = '';
          // $this->$data['timestamp']=date('YmdHis',time());
              foreach ($data as $key => $value) {
                 $result.=$key.'='.$value.'&';
              }
                 $result = rtrim($result,'&');
                 return $result;
    }
  public function send($phone,$randNumber)
  {
    $config=$this->config($randNumber);
    $url=$config['url'];
        //注释:$header必须是数组形式或者对象形式
    $header=[$config['header']];
    $data=$this->dataUnit($phone,$randNumber);
    $cur=curl_init();
         curl_setopt($cur,CURLOPT_URL,$url);
         curl_setopt($cur,CURLOPT_SSL_VERIFYHOST,0);//关闭验证
         curl_setopt($cur,CURLOPT_SSL_VERIFYPEER,false);//关闭验证
         curl_setopt($cur,CURLOPT_HTTPHEADER,$header);
         curl_setopt($cur,CURLOPT_POST,1);
         curl_setopt($cur,CURLOPT_POSTFIELDS,$data);
         curl_setopt($cur,CURLOPT_RETURNTRANSFER,1);
         $result=curl_exec($cur);
         curl_close($cur);
         // return $result;
         $code=json_decode($result,true);
       
         if ($code['respCode']==0000)
          {
              return  true;      
          }
          else
          {
             return  false;
          }        
                       
       
     
   }
 }
