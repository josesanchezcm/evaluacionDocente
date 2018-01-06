<?php 
	session_start();
	require_once "connect.php";
	sleep(2);
	$cveAlu=$_POST['cveAlu'];
	$pasAlu=$_POST['pasAlu'];
	$query=("SELECT * FROM alumno WHERE cveAlu='$cveAlu' AND pasAlu='$pasAlu'");
	$alumnos=consultarSQL($query);
	if ($alumnos->num_rows==1):
		$datos=$alumnos->fetch_assoc();
		$_SESSION['cveAlu']=$datos['cveAlu'];
		echo json_encode(array('error'=>false));
	else:
		echo json_encode(array('error'=>true));	
	endif;
 ?>