<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** ΢����Ϣ��*/
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
       

        

	/** ����*/
	public $ID;
 
	/** �������ں�ID*/
	public $WXAccountID;
 
	/** ��������*/
	public $TranfType;
 
	/** ������*/
	public $FromUserName;
 
	/** ������*/
	public $ToUserName;
 
	/** ��Ϣ����*/
	public $MsgType;
 
	/** �¼�����*/
	public $Event;
 
	/** �¼�KEYֵ*/
	public $EventKey;
 
	/** ����*/
	public $Title;
 
	/** ����*/
	public $Description;
 
	/** ��Ϣ����*/
	public $Content;
 
	/** ����*/
	public $MusicURL;
 
	/** ��������������*/
	public $HQMusicUrl;
 
	/** ��ý���ļ�id*/
	public $MediaId;
 
	/** ����ͼ��ý��id*/
	public $ThumbMediaId;
 
	/** ͼ����Ϣ����*/
	public $ArticleCount;
 
	/** ����ͼ����Ϣ��Ϣ*/
	public $Articles;
 
	/** ͼƬ����*/
	public $PicUrl;
 
	/** ���ͼ����Ϣ��ת����*/
	public $Url;
 
	/** ����λ��γ��*/
	public $Latitude;
 
	/** ����λ�þ���*/
	public $Longitude;
 
	/** ����λ�þ���*/
	public $Precisions;
 
	/** ��ά���ticket*/
	public $Ticket;
 
	/** ��Ϣ����ʱ�� �����ͣ�*/
	public $CreateTime;
 
	/** ״̬*/
	public $status;
  
}
?>
