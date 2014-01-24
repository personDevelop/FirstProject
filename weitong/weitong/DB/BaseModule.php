<?php
class BaseModule{
	public $TableName="";
	public $_RecordStatus=0;/*0：新增   1：修改   2：删除  3，其他*/ 
	
	public $_PK="ID";/*主键字段*/
	public $_PKIsAuto=false;/*是否自增主键*/
	public $_PKIsGuid=true;/*主键是否取guid ,和自增只能二选一*/
	
	private  $_VirtualFields=   array("TableName","_RecordStatus","_PK","_PKIsAuto","_PKIsGuid");
	
	protected function _AddVirtualField($virtualField){
		
		$this->_VirtualFields.push($virtualField);
	}
	
	public function IsVirtualField($field){
		
		return in_array($field,$this->_VirtualFields,true);
		
	}
	
	private $_AutochangedStatus=false;
	private $_ChangeField=array();
	
	public function __set($name,$value)
	{
		if	($_AutochangedStatus   )
		{
			if	($value!=$this->$name)
			{
				$_ChangeField[$name]=$value;
			}
		}else
		{
			$_ChangeField[$name]=$value;
			
		} 
		$this->$name=$value;
	}
	 
	public function _ClearChange()
	{
		unset($_ChangeField);
		$_ChangeField=array();
	}
	
	public function _SetChange($columnArray,$valueArray)
	{
		$this->_ClearChange();
		foreach	($columnArray as $name =>$value)
		{
			$this->_set($name,$value);
		}
	}
	
	public function _GetChange()
	{
		return $this->_ChangeField;
	}
	
	public function _AutoChange()
	{
		
		$this->_AutochangedStatus=true;
		$this->_RecordStatus=1;
	}
}

?>