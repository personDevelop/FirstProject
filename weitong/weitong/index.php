<?php  
header("Content-type: text/html; charset=utf-8");

// $Para =$_POST["Code"];
////$Para = iconv("utf-8","gbk",$Para);
//$Para =iconv("UTF-8","GB2312//IGNORE",$Para);

//$encode =mb_detect_encoding ( $Para, array ("ASCII", "UTF-8", "GB2312", "GBK", "BIG5" ) );

//引用类文件  
define('SITE_PATH',str_replace('','/',dirname(__FILE__)));//定义系统目录 
define('contro_PATH',SITE_PATH."\\application\\controllers\\");//定义系统目录 
define('Model_PATH',SITE_PATH."\\application\\model\\");//定义系统目录 

require_once("application/controllers/BaseController.php");

BaseController::RunApp();
?>