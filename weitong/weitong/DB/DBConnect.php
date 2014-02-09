<?php

function GetConn()
{
	$db_host="localhost";
	$db_user="root";
	$db_password="";
	$db_name="imicro";
	$mysqli=new mysqli($db_host, $db_user, $db_password, $db_name); 
	$mysqli->query("SET NAMES utf8"); 
	return $mysqli;
}

?>