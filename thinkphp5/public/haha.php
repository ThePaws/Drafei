 <?php
 header('Content-type: text/html; charset=utf-8');#设置头信息
     require_once('weixinapi.php');#加载微信接口类文件
	 $zhwx=new zhphpWeixinApi();//实例化
	 $configArr=array(
				'token'=>'wewantto',
				'appid'=>'wx33061d057a9b36b3',
				'appSecret'=>'2176e8104b648468d901f621b11dfa4f',
				'myweixinId'=>'gh_0915facb0554'
				);
        $zhwx->setConfig($configArr);
        if($zhwx->weixinBaseApiMessage()){ //基本微信接口会话 必须
		$keyword=$zhwx->getUserTextRequest();//得到用户发的微信内容, 这里可以写你的业务逻辑
		$msgtype=$zhwx->getUserMsgType();//得到用户发的微信数据类型, 这里可以写你的业务逻辑
		$SendTime=$zhwx->getUserSendTime();//得到用户发送的时间
		$fromUserName=$zhwx->getUserWxId();//用户微信id
		$pingtaiId=$zhwx->getPlatformId();//平台微信id
		$requestId=$zhwx->getUserRequestId(); //获取微信公众平台消息ID
		$userPostData=$zhwx->getUserPostData();//获取用户提交的post 数据对象集
	if( $msgtype == 'text' ){ //如果是文本类型
			 if($keyword == 'news'){ //新闻类别请求
				$callData=array(
					  array('Title'=>'第一条新闻的标题','Description'=>'第一条新闻的简介','PicUrl'=>'http://t12.baidu.com/it/u=1040955509,77044968&fm=76','Url'=>'http://wxphptest1.applinzi.com/'),
					  array('Title'=>'第二条新闻的标题','Description'=>'第一条新闻的简介','PicUrl'=>'http://images.cnitblog.com/blog2015/340216/201505/051316468603876.png','Url'=>'http://wxphptest1.applinzi.com/'),
					  array('Title'=>'第三条新闻的标题','Description'=>'第一条新闻的简介','PicUrl'=>'http://dimgcn2.s-msn.com/imageadapter/w60h60q85/stimgcn3.s-msn.com/msnportal/hp/2016/01/21/3e3ef7f07361b5211e2b155bb66fa6a9.jpg','Url'=>'http://wxphptest1.applinzi.com/'),
				 );
				$zhwx->responseMessage('news',$callData);
			}elseif($keyword == 'music'){ //音乐请求
			   $music=array(
				 "Title"=>"最炫民族风",
				 "Description"=>"歌手：凤凰传奇",
				 "MusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3",
				 "HQMusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3"
				);
				$zhwx->responseMessage('music',$music); 
			}else{
				$callData='这是zhphp 官方对你的回复：
						 你输入的内容是'.$keyword.'
						 你发数据类型是:'.$msgtype.'
						 你发的数据时间是:'.$SendTime.'
						 你的微信ID是:'.$fromUserName.'
						 平台的微信Id是:'.$pingtaiId.'
						 zhphp官方接收的ID是:'.$requestId;
				$zhwx->responseMessage('text',$callData);
			}
	}else if($msgtype == 'image'){ //如果是图片类型
			 $image=$zhwx->getUserImageRequest();//如果用户发的是图片信息,就去得到用户的图形 信息
			 $callData=$image['MediaId'];//mediaID 是微信公众平台返回的图片的id,微信公众平台是依据该ID来调用用户所发的图片
			 $zhwx->responseMessage('image',$callData);
			
		}else if($msgtype == 'voice'){ //如果是语音消息,用于语音交流
			$callData=$zhwx->getUserVoiceRequest(); //返回数组
			$zhwx->responseMessage('voice',$callData);
		}elseif($msgtype == 'event'){//事件,由系统自动检验类型
			$content='感谢你关注zhphp官方平台';//给数据为数据库查询出来的
			$callData=$zhwx->responseEventMessage($content);//把数据放进去，由系统自动检验类型，并返回字符串或者数组的结果
		    $zhwx->responseMessage('text',$callData); //使用数据
		}else{
			$callData='这是zhphp 官方对你的回复：
                       你发数据类型是:'.$msgtype.'
                       你发的数据时间是:'.$SendTime.'
                     zhphp官方接收的ID是:'.$requestId;
            $zhwx->responseMessage('text',$callData);
		}
	}
