<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** 关键字消息*/
class KeyWordMsg  extends BaseModule
{
	

	function __construct()
	{
		$this->TableName="KeyWordMsg";
		$this->_PK= "ID";
		if($this->_PKIsGuid)
		{
			$pk=$this->_PK;
			$this->$pk = GetGuid(); 
		}
	}
	

	

	/** 主键*/
	public $ID;
	
	/** 公众号ID*/
	public $WXAccount;
	
	/** 规则名*/
	public $Name;
	
	/** 关键字*/
	public $KeyWord;
	
	/** 匹配类型*/
	public $PiPeiType;
	
	/** 回复文本内容*/
	public $Content;
	
	/** 状态*/
	public $Status;
	
}
?>
