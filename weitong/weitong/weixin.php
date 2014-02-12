<?php
/**
  * wechat php  
  */

//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapi();
$wechatObj->responseMsg();

class wechatCallbackapi
{
	
	
	public function responseMsg()
	{
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

		//extract post data
		if (!empty($postStr)){
			
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			if (!empty($postObj->MsgType))
			{
				switch ($postObj->MsgType)
				{
					case"text":
						$textmsg=sprintf("您刚才发送的文本信息是【%s】,消息id是【%s】,开发者微信号是【%s】,发送方帐号是【%s】,消息创建时间 （整型）【%s】",
						$postObj->Content,$postObj->MsgId,$postObj->ToUserName,$postObj->FromUserName,$postObj->CreateTime);
						$this->sendTextMsg($textmsg,$postObj);
						break;
					case"event":
						if (!empty($postObj->Event))
						{
							switch ($postObj->Event)
							{
								case"subscribe"://subscribe(订阅)
									//分两种，一直是普通关注。一直是扫描二维码关注
									$this->OnSubscribe($postObj);
									break;
								case"unsubscribe"://、unsubscribe(取消订阅
									$this->OnUnSubscribe($postObj);
									break;
								case"SCAN"://用户已关注时,扫描二维码的事件推送
									$this->OnScan($postObj);
									break;
								case"LOCATION"://上报地理位置事件
									$this->OnLocation($postObj); 
									break;
								case"CLICK"://自定义菜单事件
									$this->OnKeyWordClick($postObj); 
									break;  
							}
						}else
						{
							$this->sendTextMsg();
						}
						break;
					default:
				}
			}
		}else
		{
			echo   "sdasds";
		}
		
	}
	private function sendTextMsg( $contentStr,$postobject)
	{
		if (!empty($contentStr))
		{
			
			
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>"; 
			$msgType = "text";
			$time = time();
			$resultStr = sprintf($textTpl, $postobject->FromUserName, $postobject->ToUserName, $time, $msgType, $contentStr);
			echo $resultStr;
			
		}else
		{
			echo   "";
		} 
		exit;
	}
	 
	public function OnSubscribe($postObj)
	{
		//分两种，一直是普通关注。一直是扫描二维码关注
		//1.获取定义的关注消息
		//2.发送信息
		$msg="您好：欢迎您关注生活小帮手生活助手公众号";
		$this->sendTextMsg($msg,$postObj);
		//3.更新关注人员信息
	}
	public function OnUnSubscribe($postObj)
	{
		
		//1.获取定义的取消关注消息
		$msg="您好：感谢您的关注，如有不满意，请 联系我们【dianhua】,我们会尽快改进";
		//2.发送信息
		$this->sendTextMsg($msg,$postObj);
		//3.更新关注人员信息
	}
	public function OnScan($postObj)
	{
		//1.获取事件KEY值，是一个32位无符号整数，即创建二维码时的二维码scene_id
		//可根据key值发送不同的消息
		$key=$postObj->EventKey;
		//2.获取二维码的ticket，可用来换取二维码图片
		$ticket=$postObj->Ticket;
		$msg=sprintf("您好：感谢您扫描%s对应的%s", $key,$ticket); 
		//3.发送信息
		$this->sendTextMsg($msg,$postObj); 
	}
	
	public function OnLocation($postObj)
	{
		//1.获取地理位置纬度、经度、精度
		$Latitude=$postObj->Latitude;
		$Longitude=$postObj->Longitude;
		$Precision=$postObj->Precision; 
		 
		$ticket=$postObj->Ticket;
		$msg=sprintf("您好：您当前的经纬度是【经：%s、维：%s】", $Longitude,$Latitude); 
		//2.发送信息
		$this->sendTextMsg($msg,$postObj); 
	}
	public function OnKeyWordClick($postObj)
	{
		//1.获取菜单接口中KEY值
		$EventKey=$postObj->EventKey;
		 
		$msg=sprintf("您好：您刚才点击的是%s",$EventKey); 
		//2.发送信息
		$this->sendTextMsg($msg,$postObj); 
	}
	
}
//class msgEntity
//{
//	public $from;
//	public $to;
//	public $CreateTime;
//	public $MsgType;
//	public $Event;
//	public $EventKey;
//	public $Ticket;//二维码的ticket，可用来换取二维码图片
//	public $Latitude;//地理位置纬度
//	public $Longitude;//地理位置经度
//	public $Precision;//地理位置精度 
//}
?>