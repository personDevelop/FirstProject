<?php
date_default_timezone_set('Asia/Shanghai');
 
 
function GetGuid()
{ 
	return uniqid().rand(100,999); 
}

function RunApp()
{
	$controller=(!empty($_GET['c']))?$_GET['c']:'index';//获取控制器,默认index
	$action=(!empty($_GET['a']))?$_GET['a']:'index';//方法名称，默认index
	$controller_name=$controller.'Controller';
	$controller_file=SITE_PATH.'/application/controllers/'.$controller_name.'.class.php';//获取控制器文件
	if(file_exists($controller_file)){
		require_once($controller_file);
		$controller=new $controller_name();
		$controller->{$action.’Action’}();
	}else{
		//die(‘找不到对应的控制器！’);
	}
}


?>