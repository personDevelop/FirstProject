<?php
require_once("../db/BaseModule.php");
require_once("../Utils/Common.php");
class OrderInfo extends BaseModule
{
	function __construct()
	{ 
		$this->TableName="OrderInfo" ;
		$this->_PK= "ID";
		if($this->_PKIsGuid)
		{
			$pk=$this->_PK;
			$this->$pk = GetGuid(); 
		}
	}  
 
	public $ID;
	public $Code;
	public $Name;
	public $Price;
	public $Num; 
	public $Total;
	public $Describe;
	 
	
}
?>
