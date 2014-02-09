<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** 参数表*/
     class ParameterInfo  extends BaseModule
    {
         

        function __construct()
        {
          $this->TableName="ParameterInfo";
$this->_PK= "ID";
		if($this->_PKIsGuid)
		{
			$pk=$this->_PK;
			$this->$pk = GetGuid(); 
		}
        }
       

	 

	/** 主键*/
	public  $ID;
	
	/** 父ID*/
	public  $ParentID;
	
	/** 编码*/
	public  $Code;
	
	/** 名称*/
	public  $Name;
	
	/** 对应值*/
	public  $Value;
	
	/** 对应值2*/
	public  $Value2;
	
	/** 分级码*/
	public  $ClassCode;
	
	/** 明细*/
	public  $IsDetails;
	
	/** 级数*/
	public  $Series;
	
	/** 系统参数*/
	public  $IsSystem;
	
	/** 可编辑*/
	public  $IsEdit;
	
	/** 可删除*/
	public  $IsDelete;
	
	/** 可用*/
	public  $IsEnable;
	
	/** 备注*/
	public  $Note;
	
	/** 顺序*/
	public  $OrderNo;
	
	/** 值1类型*/
	public  $V1Type;
	
	/** 值2类型*/
	public  $V2Type;
	
	/** 图片1*/
	public  $Img1;
	
	/** 图片2*/
	public  $Img2;
	
	/** 图片3*/
	public  $Img3;
	
	/** 值3*/
	public  $Value3;
	
	/** 值3类型*/
	public  $V3Type;
	
	/** 值4类型*/
	public  $V4Type;
	
	/** 值4*/
	public  $Value4;
	
	/** 值5类型*/
	public  $V5Type;
	
	/** 值5*/
	public  $Value5;
	
	/** 可有叶子节点*/
	public  $IsCanHasLeaf;
	
	/** 值1说明*/
	public  $V1Note;
	
	/** 值2说明*/
	public  $V2Note;
	
	/** 值3说明*/
	public  $V3Note;
	
	/** 值4说明*/
	public  $V4Note;
	
	/** 值5说明*/
	public  $V5Note;
 
	
}
?>
