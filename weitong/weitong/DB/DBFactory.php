<?php
header('Content-type:text/html;Charset=utf-8');
require_once("BaseModule.php");
require_once("DBConnect.php");
class DbFactory{
	
	/*private $mysqli=false;*/
	public static function Insert($moudle)
	{ 
		
		$class_vars = get_class_vars(get_class($moudle));
		$cloumn=""; 
		$cloumnholder=""; 
		$i=0   ;
		$refs   ;
		foreach ($class_vars as $name => $value) {
			if( $moudle->IsVirtualField($name) || ($moudle->_PK==$name && $moudle->_PKIsAuto)  )
			{
				continue;
			}
			
			if	(! is_null($moudle->$name) ){
				
				if(!empty($cloumn)){
					$cloumn.=","; 
					$cloumnholder.=",";  
				}
				$cloumn.="`$name`";
				$cloumnholder.="?" ; 
				$refs[$i++]= ($moudle->$name);  
			} 
		} 
		$sql=  "INSERT INTO `".$moudle->TableName."` ($cloumn ) value($cloumnholder)";
		$result= DbFactory::ExecuteSqlNoQuery($sql,$refs);
		if($result==1){
			$moudle->_AutoChange();
		}
		return $result;
		
	}
	
	public static function Update($moudle){
		
		$cloumn="";  
		$i=0   ;
		$refs   ;
		foreach ($moudle->_GetChange() as $name => $value) { 
			if(!empty($cloumn)){
				$cloumn.=",";  
			}
			$cloumn.=$name;
			$cloumnholder.="=?" ; 
			$refs[$i++]= $value;   
		} 
		$refs[$i]= $moudle->_get($moudle->_PK);   
		$sql=  "UPDATE ".$moudle->TableName." SET  $cloumn  WHERE ".$moudle->_PK."=?";
		$result= DbFactory:: ExecuteSqlNoQuery($sql,$refs);
		if($result==1){
			$moudle->_RecordStatus=1;
		}
		return $result;
	} 
	
	public static function UpdateByWhere($moudle,$where,$paraArray){
		
		$cloumn="";  
		$i=0   ;
		$refs   ;
		foreach ($moudle->_GetChange() as $name => $value) { 
			if(!empty($cloumn)){
				$cloumn.=",";  
			}
			$cloumn.=$name;
			$cloumnholder.="=?" ; 
			$refs[$i++]= $value;   
		} 
		foreach($paraArray as $name => $value)
		{
			$refs[$i++]= $value;  
		} 
		$sql=  "UPDATE ".$moudle->TableName." SET  $cloumn  WHERE ".$where;
		$result= DbFactory::ExecuteSqlNoQuery($sql,$refs);
		if($result==1){
			$moudle->_RecordStatus=1; 
		}
		return $result;
	} 
	public static function DeleteByID($ClassName,$id)
	{
		$refs   ;
		$tem=new $ClassName();
		$sql="delete FROM ".$tem->TableName." where ".$tem->_PK; 
		$i=0;
		if(is_array($id))
		{
			$sql.=" in (";
			
			foreach($id as $oneID=>$value)
			{
				
				if($i==0)
				{
				$sql.='?';}
				else {
				$sql.=',?';}
				$refs[$i++]=  $value ; 
			}
			$sql.=")";
		}
		else
		{
			$sql.="=?";
			$refs[$i++]= ($id); 
		}
		return DbFactory::ExecuteSqlNoQuery($sql,$refs);
	}
	public static function DeleteByWhere($ClassName,$where,$paraArray){
		$refs   ;
		$tem=new $ClassName();
		$sql="delete FROM ".$tem->TableName." where ".$where; 
		
		if(!is_null($paraArray) && !empty($paraArray))
		{
			$i=0;
			if(is_array($paraArray))
			{
				
				
				foreach($paraArray as $oneID=>$value)
				{ 
					$refs[$i++]= ($value); 
				}
				
			}
			else
			{ 
				$refs[$i++]= ($id); 
			}
		}else
			{$refs=null;}
		
		return  DbFactory::ExecuteSqlNoQuery($sql,$refs);
		
		
	} 
	
	
	
	public static function ExecuteSqlNoQuery($sql,$refs)
	{
		$rowcount=-1;
		$error="";
		$mysqli= GetConn();
		
		$stms =$mysqli->prepare($sql ); 
		if (  !$stms) {
			$mysqli->close(); 
			$error='错误:sql语句预编译有错误：'.$sql;
			die($error);
			return $error;

		}
		if(!is_null($refs) && !empty($refs))
		{ 
			call_user_func_array(array($stms, 'bind_param'),DbFactory::arr2refer($refs)); 
		}
		try{
			$issuccess=$stms->execute();
			if($issuccess)
			{ 
				$rowcount=	$stms->affected_rows; 
				
			} 
			else{
				$error="【sql语句】:".$sql."【mysql错误码】：".$stms->errno.";【详细信息】：".$stms->error; 
				
			}
		}catch(Exception $e){   $error=$e->getMessage();}
		
		$stms->close();  
		
		$mysqli->close(); 
		if($issuccess)
		{
			echo $rowcount; 
			return $rowcount; 
			
		} else
		{  
			echo $error;
		return $error; }
	}
	
	public static function ExecuteSqlQuery($sql,$refs)
	{
		$rowcount=-1;
		$error="";
		
		
		$mysqli= GetConn();;
		$stms =$mysqli->prepare($sql); 
		if (  !$stms) {
			$mysqli->close(); 
			$error='错误:sql语句预编译有错误：'.$sql;
			die($error);
			return $error;

		}
		if(!is_null($refs) && !empty($refs))
		{
			try{
				call_user_func_array(array($stms, 'bind_param'),DbFactory::arr2refer($refs)); 
				
			}catch(Exception $e){ 
				$error=$e->getMessage(); 
			echo $error;}
			
			
		}
		try{
			$issuccess=$stms->execute();
			
			$stms->store_result();   
			
			if($issuccess)
			{ 
				$rowcount=	$stms->num_rows; 
				
			} 
			else{
				$error="mysql错误码：".$stms->errno.";详细信息：".$stms->error; 
				
			}
		}catch(Exception $e){   $error=$e->getMessage();}
		
		
		
		$res=DbFactory::GetDataTable($stms);
		$stms->free_result();
		$stms->close();
		$mysqli->close();
		
		if($issuccess)
		{
			echo $rowcount; 
			return $res; 
			
		} else
		{  
			echo $error;
		return $error; }
	}
	
	
	
	public static function GetPageData($currentPage,$pageSize,$sql,$paraArray )
	{  
		/*截取第一个select 和from */ 
		$selectpix=strstr($sql, 'select', true);
		$frompix=strstr($sql, 'from');
		$sqlcount=trim($selectpix." select count(1) as RecourdCount ".$frompix).';';
		$count=	DbFactory::ExecuteScalar($sqlcount,$paraArray);
		if(is_bool($count)&&!$count){
			echo $sql;
			return "获取总数时报错";
		}else
		{
			$start=$pageSize*($currentPage-1);
			$end=$pageSize*($currentPage);
			$sql=trim($sql)." limit  $start ,$end";
			return DbFactory::ExecuteSqlQuery($sql,$paraArray); 
			
		}
		
	}
	
	
	public static function ExecuteScalar($sql,$paraArray){
		
		$result=	DbFactory::	ExecuteSqlQuery($sql,$paraArray);
		if(is_string($result))
		{
			return false;
		}else
		{
			foreach	($result[0] as $v )
			{
				echo "总属性".$v;
			return $v;}
		}
	}
	
	 
	private static function arr2refer($value) {
		$refs = array();
		$paramholder="";
		foreach ($value as $k => $v) {
			if (is_int($v)) {

				$paramholder.="i";

			} else
				if (is_double($v) || is_float($v)) {

					$paramholder.=  "d";

				} else
					if (is_string($v)) {

						$paramholder.="s";

					} else
						{$paramholder.="s";}
			$refs[$k] =  &$value[$k]; 
		}
		array_unshift( $refs,$paramholder );
		return $refs;
	}
	
	private  static function GetDataTable($stmts)
	{
		$res=array();
		$field=$stmts->result_metadata()->fetch_fields();
		
		$fields=array();
		$i=0;
		$out=array();
		foreach($field as $val)
		{
			$fields[$i]= &$val->name ;
			$out[$i++]= $val->name ;
		}
		call_user_func_array(array($stmts,'bind_result'),$fields);
		while($stmts->fetch()){
			$t=array();
			foreach($fields as $key=>$val)
			{
				$t[$out[$key] ]=$val;
			} 
			$res[]=$t;
		}
		foreach	($res as $d=>$val)
		{
			
			foreach($val as $j=>$k)
			{
				echo "<pre>";
				echo $d.'-'.$val.'-'.$j.'-'.$k;
			}
		}
		
		return $res;
	}
}



?>