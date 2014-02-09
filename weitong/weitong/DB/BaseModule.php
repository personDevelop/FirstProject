<?php
class BaseModule{
	public $TableName="";
	public $_RecordStatus=0;/*0：新增   1：修改   2：删除  3，其他*/ 
	
	public $_PK="ID";/*主键字段*/
	public $_PKIsAuto=false;/*是否自增主键*/
	public $_PKIsGuid=true;/*主键是否取guid ,和自增只能二选一*/
	private $_AutochangedStatus=false; /*是否自动改变状态，从数据库中获取的数据会自动将状态改成修改*/
	private $_ChangeField=array();/*值发生变化的属性*/
	private  $_VirtualFields=   array("TableName","_RecordStatus","_PK","_PKIsAuto","_PKIsGuid");/*虚字段*/
	
	protected function _AddVirtualField($virtualField){
		/*在子类的构造函数中调用*/
		$this->_VirtualFields[]= $virtualField ;
	}
	/**
	 * 是否是虚字段
	*/
	public function IsVirtualField($field){
		
		return in_array($field,$this->_VirtualFields,true);
		
	}
	
	
	/**
	 * 设置字段值，并将字段自动存储在已更改值的数组中，由于php没有自动赋值属性，
	 * 为了调用DBFactory的修改方法，需要通过该方法赋值
	 * @param mixed $name 属性名称，区分大小写
	 * @param mixed $value 要设置的属性值 
	 */	
	public function  _set($name,$value)
	{
		if	($this->_RecordStatus==1  )
		{
			if	(!($this->_AutochangedStatus && $value==$this->$name)  )
			{ 	 
				$this->_ChangeField[$name]=$value;
			} 
		}
		$this->$name=$value;
	}
	 
	/**
	 * 清空属性改变值的数组，一般保存成功后，自动调用 
	 */	
	public function _ClearChange()
	{
		unset($this->_ChangeField);
		$this->_ChangeField=array();
	}
	
	/**
	 * 批量设置属性值改变数组
	 *
	 * @param mixed $columnArray 属性名称数组，区分大小写
	 * @param mixed $valueArray  属性值数组，注意顺序 
	 */	
	public function _SetChange($columnArray,$valueArray)
	{
		$this->_ClearChange();
		foreach	($columnArray as $name =>$value)
		{
			$this->_set($name,$value) ;
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