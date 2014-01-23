 <?php require_once('head.php'); ?>

<?php

function __autoload($className)
{
	require_once("Module/$className.php");
}
require_once("db/DbFactory.php");
//
//$test= new imicroaccess();
//$test->role_id =rand(1,1000);
//$test->node_id ="2";
//$test->pid="3";
//$test->level="4";
//$dbf=new DbFactory();
//
//$dbf->Insert($test);
//
//$s=$dbf->GetPageData(1,100,"select * from imicro_access  ",null);

?>
 <form name="query" action="Control/orderControl.php?action=qry"  method="POST">
<table><tr>
<td>编号</td>
<td><td><input type="text" name="searchcode" value=""></td></td>
</tr>
<tr>
<td>名称</td>
<td><td><input type="text" name="searchname" value=""></td></td><td><select name="pagesize">
<option value="3" selected="selected">3</option>
<option value="5">5</option>
<option value="10">10</option>
<option value="20">20</option>
</select><input type="submit" value="查询"/></td>
</tr></table>
<?php

?>
</form>
<form name="ADD" action="Control/orderControl.php?action=add" method="POST">

<table>
<tr>
<td>id</td>
<td><input type="text" name="ID" value=""</td>
</tr>
<tr>
<td>编号</td>
<td><td><input type="text" name="Code" value=""</td></td>
</tr>
<tr>
<td>名称</td>
<td><td><input type="text" name="Name" value=""</td></td>
</tr>
<tr>
<td>价格</td>
<td><td><input type="text" name="Price" value=""</td></td>
</tr>
<tr>
<td>数量</td>
<td><td><input type="text" name="Num" value=""</td></td>
</tr>
<tr>
<td>总价</td>
<td><td><input type="text" name="Total" value=""</td></td>
</tr>
<tr>
<td>描述</td>
<td><td><input type="text" name="Describe" value=""</td></td>
</tr>
<tr>
<td colspan="2"> <input type="submit" value="提交"/><input type="reset" value="重置"/></td>
</tr>
</table>

</form>
<?php require_once('footer.php');?>