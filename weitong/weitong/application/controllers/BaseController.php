<?php

class BaseController
{
	public function index(){}
	public static function RunApp()
	{
		
		$control="";
		
		if(isset( $_GET["c"])){
			$control=$_GET["c"];
		}
		
		if( empty($control))
		{
			//返回首页
		} 
		$mothod="";
		if(isset( $_GET["m"])){
			$mothod=	$_GET["m"];
		}
		if(  empty($mothod))
		{
			$mothod="index";
			//使用默认方法
		}
		
		$para="";
		if(isset( $_GET["p"])){
			$para= $_GET["p"];
		}
		
		
		require_once( $control.".php");
		$c=new $control();
		if(is_null($para)||  empty($para) )
		{
			
			$c->$mothod();
		}else
		{
			$c->$mothod($para);
			
		}
		
		
	}
	
	
	
}


