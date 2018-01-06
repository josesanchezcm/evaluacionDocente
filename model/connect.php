<?php 
	#error_reporting(E_ERROR);
	#error_reporting(E_ALL ^ E_NOTICE);
	function consultarSQL($query){

		$mysqli= new mysqli("localhost","root","","db_evaluacion");

		if (mysqli_connect_errno()) {
			# code...
			echo "Error de conexion con la base de datos <br>";	
		}else{

			$mysqli-> set_charset("utf8");
			$mysqli-> autocommit(FALSE);

			$mysqli-> begin_transaction(MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
			if($consulta=$mysqli->query($query)){
				$mysqli->commit();
				#echo "Datos guardados";
			}else{
				$mysqli->rollback();
				#echo "No se proceso la petición";
			}
			return $consulta;
		}
	}	

 ?>
