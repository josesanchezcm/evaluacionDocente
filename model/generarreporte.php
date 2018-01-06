<?php 
	session_start();
	require_once "connect.php";
	sleep(2);
	header('Content-Type: application/json');
    $cveGru=$_POST['cveGru'];
    $cveMat=$_POST['cveMat'];
    $cvePro=$_POST['cvePro'];
	$query=("SELECT evaluacion.cveEva AS cveEva, pregunta.cvePre AS cvePre, evaluacionpregunta.calPre AS calPre, evaluacion.comEva AS comEva FROM evaluacion INNER JOIN evaluacionpregunta ON evaluacion.cveEva=evaluacionpregunta.cveEva INNER JOIN pregunta ON evaluacionpregunta.cvePre=pregunta.cvePre INNER JOIN imparte ON evaluacion.cveImp=imparte.cveImp WHERE imparte.cveGru='$cveGru' AND imparte.cveMat='$cveMat' AND imparte.cvePro='$cvePro'");
	$result=consultarSQL($query);

	

 	if ($result->num_rows>1):
 		$data = array();
		foreach ($result as $row) {
		$data[] = $row;
		} 
 		$_SESSION['cveGru']=$cveGru;
    	$_SESSION['cveMat']=$cveMat;
    	$_SESSION['cvePro']=$cvePro;		
		echo json_encode($data);
	else:
		echo json_encode(array('error'=>true));	
	endif;

?>