<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** 微信消息表*/
     class WXMsgInfo  extends BaseModule
    {
         

        function __construct()
        {
          $this->TableName="WXMsgInfo";
$this->_PK= "ID";
		if($this->_PKIsGuid)
		{
			$pk=$this->_PK;
			$this->$pk = GetGuid(); 
		}
        }
       

        

	/** 主键*/
	public $ID;
 
	/** 所属公众号ID*/
	public $WXAccountID;
 
	/** 传递类型*/
	public $TranfType;
 
	/** 发信人*/
	public $FromUserName;
 
	/** 收信人*/
	public $ToUserName;
 
	/** 信息类型*/
	public $MsgType;
 
	/** 事件类型*/
	public $Event;
 
	/** 事件KEY值*/
	public $EventKey;
 
	/** 标题*/
	public $Title;
 
	/** 描述*/
	public $Description;
 
	/** 消息内容*/
	public $Content;
 
	/** 链接*/
	public $MusicURL;
 
	/** 高质量音乐链接*/
	public $HQMusicUrl;
 
	/** 多媒体文件id*/
	public $MediaId;
 
	/** 缩略图的媒体id*/
	public $ThumbMediaId;
 
	/** 图文消息个数*/
	public $ArticleCount;
 
	/** 多条图文消息信息*/
	public $Articles;
 
	/** 图片链接*/
	public $PicUrl;
 
	/** 点击图文消息跳转链接*/
	public $Url;
 
	/** 地理位置纬度*/
	public $Latitude;
 
	/** 地理位置经度*/
	public $Longitude;
 
	/** 地理位置精度*/
	public $Precisions;
 
	/** 二维码的ticket*/
	public $Ticket;
 
	/** 消息创建时间 （整型）*/
	public $CreateTime;
 
	/** 状态*/
	public $status;
  
}
?>
