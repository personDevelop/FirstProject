<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** �ؼ�����Ϣ*/
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
	

	

	/** ����*/
	public $ID;
	
	/** ���ں�ID*/
	public $WXAccount;
	
	/** ������*/
	public $Name;
	
	/** �ؼ���*/
	public $KeyWord;
	
	/** ƥ������*/
	public $PiPeiType;
	
	/** �ظ��ı�����*/
	public $Content;
	
	/** ״̬*/
	public $Status;
	
}
?>
