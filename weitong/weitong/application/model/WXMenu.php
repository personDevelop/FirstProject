<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** ΢�Ų˵�*/
     class WXMenu  extends BaseModule
    {
         

        function __construct()
        {
          $this->TableName="WXMenu";
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
 
	/** ��ID*/
	public $ParentID;
 
	/** �˵�����*/
	public $name;
 
	/** ��Ӧ��������*/
	public $type;
 
	/** �˵�KEYֵ*/
	public $keyVal;
 
	/** ״̬*/
	public $status;
 
	/** ��ҳ����*/
	public $url;
  
}
?>
