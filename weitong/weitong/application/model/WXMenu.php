<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** 微信菜单*/
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
       

        

	/** 主键*/
	public $ID;
 
	/** 公众号ID*/
	public $WXAccount;
 
	/** 父ID*/
	public $ParentID;
 
	/** 菜单标题*/
	public $name;
 
	/** 响应动作类型*/
	public $type;
 
	/** 菜单KEY值*/
	public $keyVal;
 
	/** 状态*/
	public $status;
 
	/** 网页链接*/
	public $url;
  
}
?>
