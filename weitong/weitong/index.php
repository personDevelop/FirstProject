<?php   
//�������ļ�   
require 'smarty/Smarty.class.php';   
require 'Utils/Common.php';
$smarty = new Smarty;   

//���ø���Ŀ¼��·���������ǰ�װ���ص�   
$smarty->template_dir = "smarty/templates/templates";   

$smarty->compile_dir = "smarty/templates/templates_c";   

$smarty->config_dir = "smarty/templates/config";   
$smarty->cache_dir = "smarty/templates/cache";    


//smartyģ���и��ٻ���Ĺ��ܣ����������true�Ļ�����caching�����ǻ������ҳ���������µ����⣬��ȻҲ����ͨ�������İ취���   
$smarty->caching = false;   

$hello = "Hello World!";   
//��ֵ   
$smarty->assign("hello",$hello);   

//����ģ���ļ�   
$smarty->display('index.tpl');   

?>