<?php
/**
 自己封装 微信 开发api
*/
header('Content-type: text/html; charset=utf-8');#设置头信息

class zhphpWeixinApi{
	  //定义属性
	  private $userPostData; #微信反馈给平台的数据集
	  private $fromUserName; #发微信用户姓名
	  private $toUserName; #接受微信用户姓名
	  private $keyword; #接受用户发的微信信息
	  private $createTime; #创建时间
	  private $requestId;#获取接收消息编号
	  private $msgType; #用户发的微信的类型

	  
	  public $token; #api token
	  private $appid;#开发者 id
	  private $appSecret;# 开发者的应用密钥
	  
	  private $access_token;#微信平台返回的access_token
	  private $expires_in=0;#权限的期限
	  
	  public  $weixinConfig=array();#微信全局配置
	  public  $debug=false;
	  private $saveFilePath; //缓存文件保存路径

      public  $oauthAccessToken; ##第三方网页授权accecctoken
      public  $oauthOpenId;##授权后的用户id
	  
	  /**
	    $wx_msgType为数组,可以依据账号的权限补充
	  */
	  private  $wx_msgType=array(
	    'text',#文本消息内容类型
		'image',#图片消息内容类型
		'voice',#语音消息内容类型
		'video',#视频消息内容类型
		'link',#链接消息内容类型
		'location',#本地地理位置消息内容类型
		'event',#事件消息内容类型
		'subscribe',#是否为普通关注事件
		'unsubscribe',#是否为取消关注事件
		'music',#音乐消息内容类型
		'news',#新闻消息内容
		);
		
	  /**
	      配置文件
		   $config=array(
		    'token'=>'',
			'appid'=>'开发者 id ',
			'appSecret'=>'应用密钥'
		    )
	   */
	   public function setConfig($config){
		    if( ! empty( $config ) ){
				$this->weixinConfig=$config;
			}elseif( empty($config) && ! empty($this->weixinConfig) ){
				$config=$this->weixinConfig;
            }
			     #配置参数属性,这里使用 isset进行了判断,目的是为后续程序判断提供数据
			     $this->token=isset($config['token'])?$config['token']:null;
			     $this->appid=isset($config['appid'])?$config['appid']:null;
				 $this->appSecret=isset($config['appSecret'])?$config['appSecret']:null;
		}
		/**
		 获取config
		*/
		public function getConfig(){
			return $this->weixinConfig;
		}
	   /**
	     检验 token
	   */
	  public function  validToken(){
          if(empty($this->token)){  //如果 不存在 token  就抛出异常
			 return false;
		    }else{
                if($this->checkSignature()){//检查签名,签名通过之后,就需要处理用户请求的数据
                   return  true;
                }else{
					return  false;
				}
			}
	   }
	  /**
	    检查签名
	  */
	  private function checkSignature(){
		   try{ # try{.....}catch{.....} 捕捉语句异常
			 $signature = isset($_GET["signature"])?$_GET["signature"]:null;//判断腾讯微信返回的参数 是否存在 
             $timestamp = isset($_GET["timestamp"])?$_GET["timestamp"]:null;//如果存在 就返回 否则 就 返回 null
             $nonce = isset($_GET["nonce"])?$_GET["nonce"]:null;
			  ######下面的代码是--微信官方提供代码
		     $tmpArr = array($this->token, $timestamp, $nonce);
		     sort($tmpArr, SORT_STRING);
		     $tmpStr = implode( $tmpArr );
		     $tmpStr = sha1( $tmpStr );
		     if( $tmpStr == $signature ){
			     return true;
		     }else{
			     return false;
		    }
			######上面的代码是--微信官方提供代码  
		   }catch(Exception $e){
			   echo $e->getMessage();
			   exit();
		   }
	}
	 /**
	   处理用户的请求
	 */
	 private function handleUserRequest(){
         if(isset($_GET['echostr'])){ //腾讯微信官方返回的字符串  如果是存在 echostr 变量 就表明 是微信的返回 我们直接输出就可以了
			   $echoStr = $_GET["echostr"];
			   echo $echoStr;
			   exit;
		  }else{//否则 就是用户自己回复 的
             $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//用户所有的回复,腾讯微信都是放在这个变量的
			  if (!empty($postStr)){
                 libxml_disable_entity_loader(true); //由于微信返回的数据 都是以xml 的格式，所以需要将xml 格式数据转换成 对象操作
              	 $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
				 $this->fromUserName=$postObj->FromUserName; //得到发送者 姓名  一般为微信人的账号
				 $this->toUserName=$postObj->ToUserName;//得到 接受者的 姓名  获取请求中的收信人OpenId，一般为公众账号自身
				 $this->msgType=trim($postObj->MsgType); //得到 用户发的数据的类型
				 $this->keyword=addslashes(trim($postObj->Content));//得到 发送者 发送的内容
				 $this->createTime=date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);//当前的时间,我们这里是服务器的时间
				 $this->requestId=$postObj->MsgId;//MsgId  获取接收消息编号
				 $this->userPostData=$postObj;
				//$this->responseMessage('text','返回:'.$this->msgType);
			}
          }
      }
	  /**
	    获取用户的数据对象集
	  */
	  public function getUserPostData(){
		  return $this->userPostData;
	  }
	  /**
       检查类型 方法
        依据不同的数据类型调用不同的模板
		判断一下 微信反馈回来的数据类型 是否存在于 wx_msgType 数组中
     */
     private function isWeixinMsgType(){
         if(in_array($this->msgType,$this->wx_msgType)){
			     return true;
			}else{
				  return false;
            }
       }
     
	
	  /**
	    文本会话
	  */
	 private function textMessage($callData){
		    if(is_null($callData)){
			   return 'null';
		    }
			 $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>5</FuncFlag>
					</xml>";
			 if(is_string($callData)){
				 $resultStr = sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'text',$callData);			
			 }else if(is_array($callData)){
                 $content='';
				 foreach($callData as $key => $value){
                     $content.=$value;
					}
				 $resultStr= sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'text',$content);
			 }
			 return $resultStr;
	 }
	 /**
	   图片会话
	 */
	 private function imageMessage($callData){
		 if(is_null($callData)){
			   return 'null';
		    }
         $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                      <Image>
                       <MediaId><![CDATA[%s]]></MediaId>
                      </Image>
                  </xml>";
         $resultStr = sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'image', $callData); 
         return $resultStr;
	}
	 /**
	  语音会话
	 */
	 private function voiceMessage($callData){
		  if(is_null($callData)){
			   return 'null';
		    }
		$textTpl = "<xml>
          <ToUserName><![CDATA[%s]]></ToUserName>
          <FromUserName><![CDATA[%s]]></FromUserName>
          <CreateTime>%s</CreateTime>
          <MsgType><![CDATA[%s]]></MsgType>
            <Voice>
              <MediaId><![CDATA[%s]]></MediaId>
		    </Voice>
        </xml>";
	  $resultStr = sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'voice',$callData['MediaId']);
	   return $resultStr;
	 }
	 /**
	  视频会话
	 */
	 private function videoMessage($callData){
		 if(is_null($callData)){
			   return 'null';
		    }
		$textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <Video>
        <MediaId><![CDATA[%s]]></MediaId>
		<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        </Video>
        </xml>";
		$resultStr = sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'video',$callData['MediaId'],$callData['ThumbMediaId'],$callData['Title'],$callData['Description']);
		return $resultStr;
	 }
	 /**
	  音乐会话
	 */
	 private function musicMessage($callData){ //依据文本 直接调用
		  if(is_null($callData)){
			   return 'null';
		    }
		$textTpl = '<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <Music>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <MusicUrl><![CDATA[%s]]></MusicUrl>
        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
        </Music>
        </xml>';
        $resultStr = sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'music',$callData['Title'],$callData['Description'],$callData['MusicUrl'],$callData['HQMusicUrl']);
		return $resultStr;
	 }
	 /**
	   回复图文消息
	   $items 必须是数组 必须是二维数组
	     $items=array(
		     array('Title'=>'','Description'=>'','PicUrl'=>'','Url'=>'')
		 
		 )
	 */
	 private function newsMessage($items){
		 if(is_null($items)){
			   return 'null';
		    }
		//##公共部分 图文公共部分
		 $textTpl = '<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <ArticleCount>%d</ArticleCount>
        <Articles>%s</Articles>
        </xml>';
       //##新闻列表部分模板
        $itemTpl = '<item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>';
         $articles = '';
		 $count=0;
	    if(is_array($items)){
			 $level=$this->arrayLevel($items);//判断数组的维度
		     if($level == 1){ //是一维数组的情况下
			   $articles= sprintf($itemTpl, $items['Title'], $items['Description'], $items['PicUrl'], $items['Url']); 
			   $count=1;
		     }else{
				foreach($items as $key=>$item){
				 if(is_array($item)){
					   $articles.= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
				    }
				 }
			   }
			   $count=count($items);
			 }
			 $resultStr = sprintf($textTpl,$this->fromUserName,$this->toUserName,$this->createTime,'news',$count, $articles);
			 return $resultStr;
	 }
	
	 /**
	  debug调试
	 */
     public function debug($data){
         echo '<pre>';
          print_r($data);
         echo '</pre>';
      }
	  	 /**
	    得到数组的维度
	  */
  private function arrayLevel($vDim){
	if(!is_array($vDim)){
		return 0; 
	 }else{ 
         $max1 = 0; 
             foreach($vDim as $item1){ 
                $t1 = $this->arrayLevel($item1); 
                if( $t1 > $max1) {
					$max1 = $t1; 
				}
             } 
        return $max1 + 1; 
       } 
  }
  	 
	  /**
	    订阅号需要初始化
	  */
	  public function  weixinBaseApiMessage($args=array()){
		       $this->setConfig($args);
		       //检查配置文件
			   if(empty($this->weixinConfig)){
				  return false;
				}
				$this->handleUserRequest(); //处理用户 请求
				return true;
		}
		public function weixinHighApiMessage($args=array()){
			   $this->setConfig($args);
			//检查配置文件
			   if(empty($this->weixinConfig)){
				   return false;
				}
				return true;
				
		}
      /**
	    通过同的类型调用不同的微信模板
		 回复微信内容信息
		  $wxmsgType 参数是 数据类型 微信规定的类型
		  $callData  参数是  数据库查询出来的数据或者指定数据
		   小机器人 被动回复 
	 */
	 public function responseMessage($wxmsgType,$callData=''){
            // if($this->isWeixinMsgType()){
				$method=$wxmsgType.'Message';//类型方法组装
                $CallResultData=$this->$method($callData);//把程序的数据传递给模板,并返回数据格式
                if (!headers_sent()){//判断是否有发送过头信息,如果没有就发送,并输出内容
                 header('Content-Type: application/xml; charset=utf-8');
                 echo $CallResultData;
                 exit;
               } 
			 //}
     }
	  /**
	   事件消息内容类型
	  */
	  public function responseEventMessage($message=''){
		   $content = "";
		   $event=$this->userPostData->Event;
		   if($event == 'subscribe'){
			   return  $content = $message;
		   }elseif($event == 'unsubscribe'){
			   return  $content = "取消关注";
		   }elseif($event == 'scan' || $event=='SCAN'){
			   return $this->getUserEventScanRequest();
		   }elseif($event == 'click' || $event == 'CLICK'){
			    switch ($this->userPostData->EventKey)
                {
                    case "company":
                        $content =$message.'为你提供服务!';
                        break;
                    default:
                        $content =$this->getUsertEventClickRequest();//返回点击的字符串
                        break;
                }
				return $content;
		   }elseif($event == 'location' || $event=='LOCATION'){
			    return $this->getUserLocationRequest();//本地地理位置分享后 返回x 、y坐标，并返回经度和维度
		   }elseif($event == 'view' || $event == 'VIEW'){
			    return $this->userPostData->EventKey; //返回跳转的链接
		   }elseif($event == 'masssendjobfinish' || $event == 'MASSSENDJOBFINISH'){
			   return $this->getUserMessageInfo();//返回会话的所有信息
		   }else{
			 return "receive a new event: ".$$this->userPostData->Event;  
		   }
		   return false;
        }
	
	  
      /**
	   获取微信端 返回的数据类型
	 */
	 public function  getUserMsgType(){
		 return strval($this->msgType);
	 }
	
     /**
       获取用户发送信息的时间
     */
     public function getUserSendTime(){
        return $this->createTime;
     }
     /**
      获取用户的微信id
     */
     public function getUserWxId(){
         return  strval($this->fromUserName);
     }
     /**
      获取到平台的微信id
     */
     public function getPlatformId(){
         return strval($this->toUserName);
     }
	  /**
	   获取用户在客户端返回的数据,文本数据
	 */
	 public function getUserTextRequest(){
		 return  empty($this->keyword)?null:strval($this->keyword);
	 }
	 /**
	   获取接收消息编号,微信平台接收的第几条信息
	 */
	 public  function getUserRequestId(){
		 return strval($this->requestId);
	 }
	 /**
	  获取图片信息的内容
	 */
	 public function getUserImageRequest(){
		 $image = array(); 
        $image['PicUrl'] = strval($this->userPostData->PicUrl);//图片url地址
        $image['MediaId'] = strval($this->userPostData->MediaId);//图片在微信公众平台下的id号
        return $image; 
	 }
	 /**
	  获取语音信息的内容
	 */
     public function getUserVoiceRequest(){
		$voice = array();
        $voice['MediaId'] = $this->userPostData->MediaId;//语音ID
        $voice['Format'] = $this->userPostData->Format;//语音格式
		$voice['MsgId']=$this->userPostData->MsgId;//id
        if (isset($this->userPostData->Recognition) && !empty($this->userPostData->Recognition)){
		 $voice['Recognition'] = $this->userPostData->Recognition;//语音的内容;;你刚才说的是: xxxxxxxx
		}
		return $voice;
	 }
	 /**
	  获取视频信息的内容
	 */
	 public function getUserVideoRequest(){
		$video = array();
		$video['MediaId'] =$this->userPostData->MediaId;
        $video['ThumbMediaId'] = $this->userPostData->ThumbMediaId;
		return $video;
	 }
	 /**
	   获取音乐消息内容
	 */
	 public function getUserMusicRequest(){
		  $music=array();
		  $music['Title'] =$this->userPostData->Title;//标题
		  $music['Description']=$this->userPostData->Description;//简介
		  $music['MusicUrl']=$this->userPostData->MusicUrl;//音乐地址
		  $music['HQMusicUrl']=$this->userPostData->HQMusicUrl;//高品质音乐地址
		  return $music;
	 }
	 
	 /**
	  获取本地地理位置信息内容
	 */
	  public function getUserLocationRequest(){
		$location = array();
        $location['Location_X'] = strval($this->userPostData->Location_X);//本地地理位置 x坐标
        $location['Location_Y'] = strval($this->userPostData->Location_Y);//本地地理位置 Y 坐标
        $location['Scale'] = strval($this->userPostData->Scale);//缩放级别为
        $location['Label'] = strval($this->userPostData->Label);//位置为
		$location['Latitude']=$this->userPostData->Latitude;//维度
		$location['Longitude']=$this->userPostData->Longitude;//经度
		return $location;  
	  }
	  /**
	    获取链接信息的内容
	  */
	  public function getUserLinkRequest(){ //数据以文本方式返回 在程序调用端 调用 text格式输出
		$link = array();
		$link['Title'] = strval($this->userPostData->Title);//标题
        $link['Description'] = strval($this->userPostData->Description);//简介
        $link['Url'] = strval($this->userPostData->Url);//链接地址
        return $link;  
	  }
	  /**
	    二维码扫描事件内容
	  */
	  public function getUserEventScanRequest(){
		  $info = array();
          $info['EventKey'] = $this->userPostData->EventKey;
          $info['Ticket'] = $this->userPostData->Ticket;    
          $info['Scene_Id'] = str_replace('qrscene_', '', $this->userPostData->EventKey);
          return $info;
	  }
	  /**
	    上报地理位置事件内容
	  */
	  public function getUserEventLocationRequest(){
		  $location = array();
          $location['Latitude'] = $this->userPostData->Latitude;
          $location['Longitude'] =$this->userPostData->Longitude;
          return $location;
	  }
	  /**
	    获取菜单点击事件内容
	  */
	  public function getUsertEventClickRequest(){
	    return strval($this->userPostData->EventKey);
	  }
	  /**
	    获取微信会话状态info
	  */
	    public function  getUserMessageInfo(){
			$info=array();
			$info['MsgID']=$this->userPostData->MsgID;//消息id
			$info['Status']=$this->userPostData->Status;//消息结果状态
			$info['TotalCount']=$this->userPostData->TotalCount;//平台的粉丝数量
			$info['FilterCount']=$this->userPostData->FilterCount;//过滤
			$info['SentCount']=$this->userPostData->SentCount;//发送成功信息
			$info['ErrorCount']=$this->userPostData->ErrorCount;//发送错误信息
			return $info;
		}
		/**
	    向第三方请求数据，并返回结果
	 */
	public  function relayPart3($url, $rawData){
	   $headers = array("Content-Type: text/xml; charset=utf-8");
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	   curl_setopt($ch, CURLOPT_POST, 1);
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
	   $output = curl_exec($ch);
	   curl_close($ch);
	   return $output;
	}
	/**
	字节转Emoji表情
	"中国：".$this->bytes_to_emoji(0x1F1E8).$this->bytes_to_emoji(0x1F1F3)."\n仙人掌：".$this->bytes_to_emoji(0x1F335);
	*/
	public function bytes_to_emoji($cp){
		if ($cp > 0x10000){       # 4 bytes
		    return chr(0xF0 | (($cp & 0x1C0000) >> 18)).chr(0x80 | (($cp & 0x3F000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
		}else if ($cp > 0x800){   # 3 bytes
		    return chr(0xE0 | (($cp & 0xF000) >> 12)).chr(0x80 | (($cp & 0xFC0) >> 6)).chr(0x80 | ($cp & 0x3F));
		}else if ($cp > 0x80){    # 2 bytes
		    return chr(0xC0 | (($cp & 0x7C0) >> 6)).chr(0x80 | ($cp & 0x3F));
		}else{                    # 1 byte
		    return chr($cp);
		}
	}
	  
	#############################################################高级接口################################
   	/**
		   微信api 接口地址
		*/
	   private  $weixinApiLinks = array(
	        'message' => "https://api.weixin.qq.com/cgi-bin/message/custom/send?",##发送客服消息
            'group_create' => "https://api.weixin.qq.com/cgi-bin/groups/create?",##创建分组
            'group_get' => "https://api.weixin.qq.com/cgi-bin/groups/get?",##查询分组
            'group_getid' => "https://api.weixin.qq.com/cgi-bin/groups/getid?",##查询某个用户在某个分组里面
            'group_rename' => "https://api.weixin.qq.com/cgi-bin/groups/update?",##修改分组名
            'group_move' => "https://api.weixin.qq.com/cgi-bin/groups/members/update?",## 移动用户分组
            'user_info' => "https://api.weixin.qq.com/cgi-bin/user/info?",###获取用户基本信息
            'user_get' => 'https://api.weixin.qq.com/cgi-bin/user/get?',##获取关注者列表
            'menu_create' => 'https://api.weixin.qq.com/cgi-bin/menu/create?',##自定义菜单创建
            'menu_get' => 'https://api.weixin.qq.com/cgi-bin/menu/get?',##自定义菜单查询
            'menu_delete' => 'https://api.weixin.qq.com/cgi-bin/menu/delete?',##自定义菜单删除
            'qrcode' => 'https://api.weixin.qq.com/cgi-bin/qrcode/create?',##创建二维码ticket
            'showqrcode' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode?',##通过ticket换取二维码
            'media_download' => 'http://file.api.weixin.qq.com/cgi-bin/media/get?',
            'media_upload' => 'http://file.api.weixin.qq.com/cgi-bin/media/upload?',##上传媒体接口
            'oauth_code' => 'https://open.weixin.qq.com/connect/oauth2/authorize?',##微信oauth登陆获取code
            'oauth_access_token' => 'https://api.weixin.qq.com/sns/oauth2/access_token?',##微信oauth登陆通过code换取网页授权access_token
            'oauth_refresh' => 'https://api.weixin.qq.com/sns/oauth2/refresh_token?',##微信oauth登陆刷新access_token（如果需要）
            'oauth_userinfo' => 'https://api.weixin.qq.com/sns/userinfo?',##微信oauth登陆拉取用户信息(需scope为 snsapi_userinfo)
            'api_prefix'=>'https://api.weixin.qq.com/cgi-bin?',##请求api前缀
			'message_template'=>'https://api.weixin.qq.com/cgi-bin/message/template/send?',##模板发送消息接口
           'message_mass'=>'https://api.weixin.qq.com/cgi-bin/message/mass/send?',##群发消息
           'upload_news'=>'https://api.weixin.qq.com/cgi-bin/media/uploadnews?',##上传图片素材
	);
	  /**
	    curl 数据提交
	  */
	public function curl_post_https($url='', $postdata='',$options=FALSE){
		$curl = curl_init();// 启动一个CURL会话
		 curl_setopt($curl, CURLOPT_URL, $url);//要访问的地址
		 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);//对认证证书来源的检查
		 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);//从证书中检查SSL加密算法是否存在
		 curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);//模拟用户使用的浏览器
		 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);//使用自动跳转
		 curl_setopt($curl, CURLOPT_AUTOREFERER, 1);//自动设置Referer
		 if(!empty($postdata)){
			curl_setopt($curl, CURLOPT_POST, 1);//发送一个常规的Post请求
			 if(is_array($postdata)){
				curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($postdata,JSON_UNESCAPED_UNICODE));//Post提交的数据包  
			 }else{
				curl_setopt($curl, CURLOPT_POSTFIELDS,$postdata);//Post提交的数据包 
			 }
		 }
		//curl_setopt($curl, CURLOPT_COOKIEFILE, './cookie.txt'); //读取上面所储存的Cookie信息
		 // curl_setopt($curl, CURLOPT_TIMEOUT, 30);//设置超时限制防止死循环
		  curl_setopt($curl, CURLOPT_HEADER, $options);//显示返回的Header区域内容  可以是这样的字符串 "Content-Type: text/xml; charset=utf-8"
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//获取的信息以文件流的形式返回
		 $output = curl_exec($curl);//执行操作
		 if(curl_errno($curl)){
			  if($this->debug == true){
				   $errorInfo='Errno'.curl_error($curl);
			       $this->responseMessage('text',$errorInfo);//将错误返回给微信端
			  }
		}
		 curl_close($curl);//关键CURL会话
		 return $output;//返回数据
   }
    /**
	  本地缓存token
	*/
     private function setFileCacheToken($cacheId,$data,$savePath='/'){
		   $cache=array();
		   $cache[$cacheId]=$data;
		   $this->saveFilePath=$_SERVER['DOCUMENT_ROOT'].$savePath.'token.cache';
		   file_exists($this->saveFilePath)?chmod($this->saveFilePath,0775):chmod($this->saveFilePath,0775);//给文件覆权限
		   file_put_contents($this->saveFilePath,serialize($cache));
		  
	}
	 
	 /**
	   本地读取缓存
	 */
	 private function getFileCacheToken($cacheId){
		 $fileDataInfo=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/token.cache');
		 $token=unserialize($fileDataInfo);
		  if(isset($token[$cacheId])){
			  return $token[$cacheId];
		  }
	 }
   
   
	  /**
	     检查高级接口权限 tokenc
		*/
	 public  function checkAccessToken(){
		if($this->appid && $this->appSecret){
             $access=$this->getFileCacheToken('access');
            if(isset($access['expires_in'])){
                 $this->expires_in= $access['expires_in'];
             }
             if( ( $this->expires_in  - time() ) <  0 ){//表明已经过期
					 $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appSecret}";
			         $access = json_decode($this->curl_post_https($url));
			         if(isset($access->access_token) && isset($access->expires_in)){
                      $this->access_token = $access->access_token;##得到微信平台返回得到token
                      $this->expires_in=time()+$access->expires_in;##得到微信平台返回的过期时间
                      $this->setFileCacheToken('access',array('token'=>$this->access_token,'expires_in'=>$this->expires_in));##加入缓存access_token
					   return true;
                      }
				}else{
					 $access=$this->getFileCacheToken('access');
                     $this->access_token=$access['token'];
					 return true;
				}
		  }
		 return false;
    }
	/**
	  获取access_token
	*/
	public function getAccessToken(){
		return strval($this->access_token);
	}
	 /**
	   得到时间
	 */
	public function getExpiresTime(){
	   return $this->expires_in;
	}
	/**
	  获取用户列表
	   $next_openid 表示从第几个开始,如果为空 默认从第一个用户开始拉取
	*/
	public function getUserList($next_openid=null){
		$url=$this->weixinApiLinks['user_get']."access_token={$this->access_token}&next_openid={$next_openid}";
	    $resultData=$this->curl_post_https($url);		
	    return json_decode($resultData,true);
	}
	/**
	 获取用户的详细信息
	*/
	public function getUserInfo($openid){
		 $url=$this->weixinApiLinks['user_info']."access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
		 $resultData=$this->curl_post_https($url);
	     return json_decode($resultData,true);
	}
	/**
	 创建用户分组
	*/
	public function createUsersGroup($groupName){
		 $data = '{"group": {"name": "'.$groupName.'"}}';
		 $url=$this->weixinApiLinks['group_create']."access_token=".$this->access_token;
		 $resultData=$this->curl_post_https($url,$data);
	     return json_decode($resultData,true);
	}
	/**
	  移动用户分组
	*/
	public function moveUserGroup($toGroupid,$openid){
		$data = '{"openid":"'.$openid.'","to_groupid":'.$toGroupid.'}';
		$url=$this->weixinApiLinks['group_move']."access_token=".$this->access_token;
		$resultData=$this->curl_post_https($url,$data);
	    return json_decode($resultData,true);
	}
	/**
	  查询所有分组
	*/
	public function getUsersGroups(){
		$url=$this->weixinApiLinks['group_get']."access_token=".$this->access_token;
		$resultData=$this->curl_post_https($url);
	    return json_decode($resultData,true);
	}
	/**
	 查询用户所在分组
	*/
	public function getUserGroup($openid){
		$data='{"openid":"'.$openid.'"}';
		$url=$this->weixinApiLinks['group_getid']."access_token=".$this->access_token;
		$resultData=$this->curl_post_https($url,$data);
	    return json_decode($resultData,true);
	}
	/**
	 修改分组名
	*/
	public function updateUserGroup($groupId,$groupName){
		$data='{"group":{"id":'.$groupId.',"name":"'.$groupName.'"}}';
		$url=$this->weixinApiLinks['group_rename']."access_token=".$this->access_token;
		$resultData=$this->curl_post_https($url,$data);
	    return json_decode($resultData,true);
	}
	/**
	 生成二维码
	*/
	public function createQrcode($scene_id=0,$qrcodeType=1,$expire_seconds=1800){
          $scene_id=($scene_id == 0)?rand(1,9999):$scene_id;
          if($qrcodeType == 1){
			  $action_name='QR_SCENE';##表示临时二维码
			   $data='{"expire_seconds":'.$expire_seconds.',"action_name": "QR_SCENE","action_info":{"scene":{"scene_id": '.$scene_id.'}}}';
		   }else{
			  $action_name='QR_LIMIT_SCENE';
			  $data='{"action_name": "QR_LIMIT_SCENE", "action_info":{"scene":{"scene_id": '.$scene_id.'}}}';
		   }
		   $url=$this->weixinApiLinks['qrcode']."access_token=".$this->access_token;
		   $resultData=$this->curl_post_https($url,$data);
		   $result=json_decode($resultData,true);
		   return $this->weixinApiLinks['showqrcode']."ticket=".urlencode($result["ticket"]);
	 }
	 /**
	  上传多媒体文件
	  type 分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb） 
	 */
		public function uploadMedia($type, $file){
			$data=array("media"  => "@".dirname(__FILE__).'\\'.$file);
			$url=$this->weixinApiLinks['media_upload']."access_token=".$this->access_token."&type=".$type;
			$resultData=$this->curl_post_https($url, $data);
			return json_decode($resultData, true);
		}
		/**
		创建菜单
		*/
		public function createMenu($menuListdata){
			$url =$this->weixinApiLinks['menu_create']."access_token=".$this->access_token;
			$resultData = $this->curl_post_https($url, $menuListdata);
			$callData=json_decode($resultData, true);
			 if($callData['errcode'] > 0){#表示菜单创建失败
				 return $callData;
			 }
             return true;
		}
		/**
		  查询菜单
		*/
		public function queryMenu(){
			$url = $this->weixinApiLinks['menu_get']."access_token=".$this->access_token;
			$resultData = $this->curl_post_https($url);
			return json_decode($resultData, true);
		}
		/**
		 删除菜单
		*/
		public function deleteMenu(){
			$url = $this->weixinApiLinks['menu_delete']."access_token=".$this->access_token;
			$resultData = $this->curl_post_https($url);
			return json_decode($resultData, true);
		}
	/**
	  给某个人发送文本内容
	*/
	public function sendMessage($touser, $data, $msgType = 'text'){
             $message = array();
			 $message['touser'] = $touser;
             $message['msgtype'] = $msgType;
			 switch ($msgType){
				 case 'text':  $message['text']['content']=$data; break;
				 case 'image': $message['image']['media_id']=$data; break;
				 case 'voice': $message['voice']['media_id']=$data; break;
				 case 'video': 
				     $message['video']['media_id']=$data['media_id'];
					 $message['video']['thumb_media_id']=$data['thumb_media_id'];
				 break;
				 case 'music':  
					$message['music']['title'] = $data['title'];// 音乐标题
					$message['music']['description'] = $data['description'];// 音乐描述
					$message['music']['musicurl'] = $data['musicurl'];// 音乐链接
					$message['music']['hqmusicurl'] = $data['hqmusicurl'];// 高品质音乐链接，wifi环境优先使用该链接播放音乐
					$message['music']['thumb_media_id'] = $data['title'];// 缩略图的媒体ID
                 break;
				 case 'news':
				   $message['news']['articles'] = $data; // title、description、url、picurl
				   break;
			 }
			 $url=$this->weixinApiLinks['message']."access_token={$this->access_token}";
             $calldata=json_decode($this->curl_post_https($url,$message),true);
			  if(!$calldata || $calldata['errcode'] > 0){
				  return false;
			  }
			  return true;
		}

    /**
     *  群发
     * */

    public  function  sendMassMessage($sendType,$touser=array(),$data){
          $massArrayData=array();
          switch($sendType){
              case 'text':##文本
                  $massArrayData=array(
                      "touser"=>$touser,
                      "msgtype"=>'text',
                      "text"=>array('content'=>$data),
                  );
                  break;
              case 'news':##图文
                  $massArrayData=array(
                      "touser"=>$touser,
                      "msgtype"=>'mpnews',
                      "mpnews"=>array('media_id'=>$data),
                  );
                  break;
              case 'voice':##语音
                  $massArrayData=array(
                      "touser"=>$touser,
                      "msgtype"=>'voice',
                      "voice"=>array('media_id'=>$data),
                  );
                  break;
              case 'image':##图片
                  $massArrayData=array(
                      "touser"=>$touser,
                      "msgtype"=>'image',
                      "media_id"=>array('media_id'=>$data),
                  );
                  break;
              case 'wxcard': ##卡卷
                  $massArrayData=array(
                      "touser"=>$touser,
                      "msgtype"=>'wxcard',
                      "wxcard"=>array('card_id'=>$data),
                  );
                  break;
          }
         $url=$this->weixinApiLinks['message_mass']."access_token={$this->access_token}";
         $calldata=json_decode($this->curl_post_https($url,$massArrayData),true);
         return $calldata;
     }
    /**
     发送模板消息
     */	
	 public function  sendTemplateMessage($touser,$template_id,$url,$topColor,$data){
		 $templateData=array(
		    'touser'=>$touser,
			'template_id'=>$template_id,
			'url'=>$url,
			'topcolor'=>$topColor,
			'data'=>$data,
		  );
		   $url=$this->weixinApiLinks['message_template']."access_token={$this->access_token}";
		   $calldata=json_decode($this->curl_post_https($url,urldecode(json_encode($templateData))),true);
		   return $calldata;
	 }

    /**
     * @param $type
     * @param $filePath 文件根路径
     */
    public  function  mediaUpload($type,$filePath){
        $url=$this->weixinApiLinks['media_upload']."access_token={$this->access_token}&type=".$type;
        $postData=array('media'=>'@'.$filePath);
        $calldata=json_decode($this->https_request($url,$postData),true);
        return $calldata;
    }

    /**
     * @param $data
     * @return mixed
     *   上传图片资源
     */
    public  function  newsUpload($data){
       $articles=array( 'articles'=>$data );
       $url=$this->weixinApiLinks['upload_news']."access_token={$this->access_token}";
       $calldata=json_decode($this->curl_post_https($url,$articles),true);
        return $calldata;
    }
    /**
     * 获取微信授权链接
     *
     * @param string $redirect_uri 跳转地址
     * @param mixed $state 参数
     */
    public function getOauthorizeUrl($redirect_uri = '', $state = '',$scope='snsapi_userinfo'){
        $redirect_uri = urlencode($redirect_uri);
        $state=empty($state)?'1':$state;
        $url=$this->weixinApiLinks['oauth_code']."appid={$this->appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
        return $url;
    }
    /**
     * 获取授权token
     *
     * @param string $code 通过get_authorize_url获取到的code
     */
    public function getOauthAccessToken(){
        $code = isset($_GET['code'])?$_GET['code']:'';
        if (!$code) return false;
        $url=$this->weixinApiLinks['oauth_access_token']."appid={$this->appid}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code";
        $token_data=json_decode($this->curl_post_https($url),true);
        $this->oauthAccessToken=$token_data['access_token'];
        return $token_data;
    }

    /**
     * 刷新access token并续期
     */
    public  function  getOauthRefreshToken($refresh_token){
        $url=$this->weixinApiLinks['oauth_refresh']."appid={$this->appid}&grant_type=refresh_token&refresh_token={$refresh_token}";
        $token_data=json_decode($this->curl_post_https($url),true);
        $this->oauthAccessToken=$token_data['access_token'];
        return $token_data;
    }
    /**
     * 获取授权后的微信用户信息
     *
     * @param string $access_token
     * @param string $open_id 用户id
     */
    public function getOauthUserInfo($access_token='', $open_id = ''){
       $url=$this->weixinApiLinks['oauth_userinfo']."access_token={$access_token}&openid={$open_id}&lang=zh_CN";
       $info_data=json_decode($this->curl_post_https($url),true);
       return $info_data;
    }
    /**
     * 登出当前登陆用户
     */
    public function logout($openid='',$uid=''){
        $url = 'https://wx.qq.com/cgi-bin/mmwebwx-bin/webwxlogout?redirect=1&type=1';
        $data=array('uin'=>$uid,'sid'=>$openid);
        $this->curl_post_https($url,$data);
        return true;
    }
    public  function https_request($url, $data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

}
