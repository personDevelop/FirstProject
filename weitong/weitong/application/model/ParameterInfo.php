<?php
require_once(SITE_PATH."\\db\\BaseModule.php");
require_once(SITE_PATH."\\global\\Common.php");
/** ������*/
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
       

	 

	/** ����*/
	public  $ID;
	
	/** ��ID*/
	public  $ParentID;
	
	/** ����*/
	public  $Code;
	
	/** ����*/
	public  $Name;
	
	/** ��Ӧֵ*/
	public  $Value;
	
	/** ��Ӧֵ2*/
	public  $Value2;
	
	/** �ּ���*/
	public  $ClassCode;
	
	/** ��ϸ*/
	public  $IsDetails;
	
	/** ����*/
	public  $Series;
	
	/** ϵͳ����*/
	public  $IsSystem;
	
	/** �ɱ༭*/
	public  $IsEdit;
	
	/** ��ɾ��*/
	public  $IsDelete;
	
	/** ����*/
	public  $IsEnable;
	
	/** ��ע*/
	public  $Note;
	
	/** ˳��*/
	public  $OrderNo;
	
	/** ֵ1����*/
	public  $V1Type;
	
	/** ֵ2����*/
	public  $V2Type;
	
	/** ͼƬ1*/
	public  $Img1;
	
	/** ͼƬ2*/
	public  $Img2;
	
	/** ͼƬ3*/
	public  $Img3;
	
	/** ֵ3*/
	public  $Value3;
	
	/** ֵ3����*/
	public  $V3Type;
	
	/** ֵ4����*/
	public  $V4Type;
	
	/** ֵ4*/
	public  $Value4;
	
	/** ֵ5����*/
	public  $V5Type;
	
	/** ֵ5*/
	public  $Value5;
	
	/** ����Ҷ�ӽڵ�*/
	public  $IsCanHasLeaf;
	
	/** ֵ1˵��*/
	public  $V1Note;
	
	/** ֵ2˵��*/
	public  $V2Note;
	
	/** ֵ3˵��*/
	public  $V3Note;
	
	/** ֵ4˵��*/
	public  $V4Note;
	
	/** ֵ5˵��*/
	public  $V5Note;
 
	
}
?>
