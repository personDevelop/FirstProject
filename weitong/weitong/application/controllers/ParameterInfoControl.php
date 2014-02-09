<?php
require_once (Model_PATH."Tree.php");
require_once (Model_PATH."parameterinfo.php");
require_once (SITE_PATH."\\db\\DbFactory.php");
class ParameterInfoControl{
	
	public function Save()
	{
		
		$Para= new ParameterInfo(); 
		if($_POST["_RecordStatus"]=="1")
		
		{
			/*新增时自动赋值*/
			$Para->ID=$_POST["ID"];
			/*主键赋值一定要放在_RecordStatus之前*/
		} 
		$Para->_RecordStatus=$_POST["_RecordStatus"];
		$Para->_set("ParentID",$_POST["ParentID"]);
		$Para->_set("Code",$_POST["Code"]);
		$Para->_set("Name",$_POST["Name"]);
		$Para->_set("Value",$_POST["Value"]);
		$Para->_set("IsSystem",$_POST["IsSystem"]);
		$Para->_set("IsEdit",$_POST["IsEdit"]);
		$Para->_set("IsDelete",$_POST["IsDelete"]);
		$Para->_set("IsEnable",$_POST["IsEnable"]);
		$Para->_set("IsCanHasLeaf",$_POST["IsCanHasLeaf"]);
		$Para->_set("OrderNo",$_POST["OrderNo"]);
		$Para->_set("Note",$_POST["Note"]); 
		$res=DbFactory::Submit($Para);
		if($res==1)
		{
			$treeEntity= new TreeEntity();
			$treeEntity->id=$Para->ID;
			$treeEntity->label=$Para->Name ."(".$Para->Code .")"; 
			$treeEntity->expanded=false;
			$treeEntity->items=array($treeEntity->GetLoadingItem());
			$tree[]=$treeEntity;
			echo json_encode($tree);
			
		}else
			{echo $res;}
		
	}
	
	
	public function FindOne($ID)
	{
		$res= 	DbFactory::ExecuteSqlQuery("select * from parameterinfo WHERE ID=? ",array($ID)); 
		echo json_encode($res);
	}
	public function QueryRoot( )
	{
		$res= 	DbFactory::ExecuteSqlQuery("select * from parameterinfo where parentid is null or parentid=''",null);
		
		$this->GetTree($res);
		
	}
	function GetTree($res )
	{
		if(count($res)==0)
		{
			echo "0";
		}else
		{
			foreach($res as $k=>$v )
			{
				$treeEntity= new TreeEntity();
				$treeEntity->id=$v["ID"];
				$treeEntity->label=$v["Name"]."(".$v["Code"].")"; 
				$treeEntity->expanded=false;
				$treeEntity->items=array($treeEntity->GetLoadingItem());
				$tree[]=$treeEntity;
			} 
			echo json_encode($tree);
		}
	}
	public function Query($parentid)
	{
		$res= 	DbFactory::ExecuteSqlQuery("select * from parameterinfo where parentid=? ",array($parentid));
		$this->GetTree($res);
	}
	
	public function Delete($ID)
	{
		$res= 	DbFactory::DeleteByID("ParameterInfo",$ID); 
		echo json_encode($res);
	}
}

?>