<?php 
	session_start();
	require_once "connect.php";
	sleep(2);
	$cvePro=$_POST['cvePro'];
	$pasPro=$_POST['pasPro'];
	$query=("SELECT * FROM profesor WHERE cvePro='$cvePro' AND pasPro='$pasPro'");
	$profes=consultarSQL($query);
	if ($profes->num_rows==1):
		$datos=$profes->fetch_assoc();
		$_SESSION['cvePro']=$datos['cvePro'];
		echo json_encode(array('error'=>false));
	else:
		echo json_encode(array('error'=>true));	
	endif;
 ?>