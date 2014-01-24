<?php
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
require_once("../db/DbFactory.php");
function __autoload($className)
{
	require_once("../Module/".$className."_class.php");
}
switch($_GET["action"])
{
	case "qry":
		echo '订单信息';
		$code='%'.$_POST["searchcode"].'%' ;
		$name='%'.$_POST["searchname"] .'%' ;
		$pagesize=$_POST["pagesize"] ;
		echo $code.$name;
		$result=DbFactory::GetPageData(1,$pagesize,"select * from orderinfo where code like ? and name like  ? ",array($code,$name));
		if(is_array($result)){
			echo	"<table align='center' border='1' width='90%'";
			echo '<caption><h2>订单信息</h2></caption>';
			echo '<th>id</th><th>编号</th><th>名称</th><th>价格</th><th>数量</th><th>总价</th><th>描述</th>';
			foreach	($result as $k=>$v)
			
			{
				echo '<Tr>';
				foreach($v as $kk=>$vv)	{ 
					echo '<Td>';
					echo "<input name='$kk' value='$vv'>"	;
					echo '</Td>';
					
				}
				echo '<Td>';
				echo "<input type='submit' name='btn$kk' value='修改'>"	;
				echo '</Td>';
				echo '</Tr>';
			}
			echo '</table>';
			
		}else{ echo $result;}
	break;
	case "add":
		$d=new  OrderInfo();
		$d->ID=$_POST["ID"] ;
		$d->Code=$_POST["Code"]  ;
		$d->Name=$_POST["Name"] ;
		$d->Price=$_POST["Price"] ;
		$d->Num=$_POST["Num"]  ;
		$d->Total=$_POST["Total"] ;
		$d->Describe=$_POST["Describe"] ;
		$result=DbFactory::Insert($d);
		if($result==1)
		{
			echo "新增成功一条记录";
		}else
		{
			echo "$result";
		}
		break;
	}






?>