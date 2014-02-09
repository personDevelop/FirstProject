<?php

class TreeEntity{
	
	public $id ;
	public 	$label ;
	public 	$value ;
	public 	$disabled ;
	public $checked ;
	public $expanded ;
	public $selected ;
	public $items ;
	public $icon;
	public $iconsize;
	public $html ;
	
	public function GetLoadingItem()
	{
		$loading=new TreeEntity();
		$loading->label="loading";
		return $loading;
	}
}