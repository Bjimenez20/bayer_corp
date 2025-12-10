<?php

if(!isset($_SESSION)) 
{ 
	session_start();
	//unset($_SESSION['usuarios']);  
	$usua = $_SESSION["usuarios"];
	$privilegios = $_SESSION["privilegios"];
	$id_usu = $_SESSION["id"];

} 

?>