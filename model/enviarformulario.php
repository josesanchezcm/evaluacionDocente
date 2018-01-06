<?php 
	
	require_once "connect.php";
	sleep(2);
	foreach($_POST as $key => $valor){
		if ($key == "cveImp" ) {
   			$cveImp = $valor;
   			   			
   		}
   		if ($key == "cveAlu" ) {
   			$cveAlu = $valor;
   			  			
   		}
   		if ($key == "coment" ) {
   			$coment = $valor;
   			 			
   		}
	}

	$fecha=date("Y-m-d");
	$addEva="INSERT INTO evaluacion (fecEva,comEva,cveImp,cveAlu,status) VALUES('$fecha','$coment','$cveImp','$cveAlu',1)";

	$newEva=consultarSQL($addEva);
	
	$getId="SELECT * FROM evaluacion WHERE cveImp='$cveImp' AND cveAlu='$cveAlu'";

	$newId=consultarSQL($getId);

	$rest=$newId->fetch_array(MYSQLI_ASSOC);
	$id=intval($rest['cveEva']);
	$cval='calPre'; 
	$val='cvePre';

	foreach($_POST as $key => $valor){		
		
		if ($key != "cveImp" && $key != "cveAlu" && $key != "coment" && $key != "btnEnviarForm") {

		   	if (strncmp($key,$val,4)===0) {
		   		$cvePre=intval($valor);
		   	}else{
		   		$calPre=intval($valor);
		   	}

		   	if (strncmp($key,$cval,4)===0){
		   		$addEvaPre="INSERT INTO evaluacionpregunta (cveEva,cvePre,calPre) VALUES ('$id','$cvePre','$calPre')";
		   		$result=consultarSQL($addEvaPre); 			
	   		}		
	   	}
	}
	if ($newId&&$result):
		echo json_encode(array('error'=>false));
	else:
		echo json_encode(array('error'=>true));	
	endif;
?>