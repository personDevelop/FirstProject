<?php   
//引用类文件   
require 'smarty/Smarty.class.php';   
require 'Utils/Common.php';
$smarty = new Smarty;   

//设置各个目录的路径，这里是安装的重点   
$smarty->template_dir = "smarty/templates/templates";   

$smarty->compile_dir = "smarty/templates/templates_c";   

$smarty->config_dir = "smarty/templates/config";   
$smarty->cache_dir = "smarty/templates/cache";    


//smarty模板有高速缓存的功能，如果这里是true的话即打开caching，但是会造成网页不立即更新的问题，当然也可以通过其他的办法解决   
$smarty->caching = false;   

$hello = "Hello World!";   
//赋值   
$smarty->assign("hello",$hello);   

//引用模板文件   
$smarty->display('index.tpl');   

?>