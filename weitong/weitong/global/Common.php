<?php
date_default_timezone_set('Asia/Shanghai');
 
 
function GetGuid()
{ 
	return uniqid().rand(100,999); 
}

function RunApp()
{
	$controller=(!empty($_GET['c']))?$_GET['c']:'index';//��ȡ������,Ĭ��index
	$action=(!empty($_GET['a']))?$_GET['a']:'index';//�������ƣ�Ĭ��index
	$controller_name=$controller.'Controller';
	$controller_file=SITE_PATH.'/application/controllers/'.$controller_name.'.class.php';//��ȡ�������ļ�
	if(file_exists($controller_file)){
		require_once($controller_file);
		$controller=new $controller_name();
		$controller->{$action.��Action��}();
	}else{
		//die(���Ҳ�����Ӧ�Ŀ���������);
	}
}


?>