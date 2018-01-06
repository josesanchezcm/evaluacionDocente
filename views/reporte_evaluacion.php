<?php 
    session_start();
    $cveGru=$_SESSION['cveGru'];
    $cveMat=$_SESSION['cveMat'];
    $cvePro=$_SESSION['cvePro'];
    $cveImp=$_SESSION['cveImp'];
    require_once "../model/connect.php";
    $query="SELECT imparte.cveImp as cveImp, imparte.cvePro as cvePro, CONCAT(nomPro,' ',aPaPro,' ',aMaPro) as nombre, periodo.nomPer as periodo, periodo.year as year  FROM  profesor INNER JOIN imparte ON profesor.cvePro=imparte.cvePro INNER JOIN periodo ON imparte.cvePer=periodo.cvePer WHERE imparte.cvePro='$cvePro'";
    $profes=consultarSQL($query);
    $prof=$profes->fetch_array(MYSQLI_ASSOC);

    $repGru="SELECT * FROM grupo WHERE cveGru='$cveGru'";  
    $result=consultarSQL($repGru);
    $rgru=$result->fetch_array(MYSQLI_ASSOC);

    $repMat="SELECT * FROM materia WHERE cveMat='$cveMat'";  
    $result=consultarSQL($repMat);
    $rmat=$result->fetch_array(MYSQLI_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel Profesor</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../controller/generarreporte.js"></script>
    <script src="//cdn.zingchart.com/zingchart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>     

    <style>
        #tblheader {
            width: 100%;
        }
        #tblheader td{
            padding: 0.4em;
            text-align: center;
        }
        #tbltitle {
            width: 100%;
            border-collapse: separate;
            border-spacing: 20px 5px;
        }
        #tbltitle td{
            padding: 0.4em;
            text-align: left;
            
        }
        #tituloalumno{
            writing-mode: vertical-lr;
            transform: rotate(270deg);
        }
        #prompre p {
            border:1px solid;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }
        #promtot {
            width: 50%;
            border:1px solid;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }
        #gtotal {
            width: 100%;
            border:1px solid;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }
        #myChart {
      height: 100%;
      width: 100%;
    }

    </style>

</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=""><?php echo $prof['nombre']; ?></a>
            </div>            

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            
                        </li>
                        <li>
                            <a href="panelprofesor.php" id="generar"><i class="fa fa-reply fa-fw"></i> Regresar</a>
                        </li> 
                        <li>
                            <a href="reporte_evaluacion.php?pdf=1" id="generar"><i class="fa fa-print fa-fw"></i> Imprimir</a>
                        </li>                             
                        
                        <li>
                            <a href="#" id="generar"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </nav>

        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="page-header" id="tblheader">
                                <tr >
                                    <td><img src="../img/logoutng.jpg" alt="" style="width: 100px;"></td>
                                    <td><h2 >UNIVERSIDAD TECNOLOGICA DEL NORTE DE GUANAJUATO</h2></td>
                                    <td>
                                    <h4>
                                    <script>
                                         var f = new Date();
                                         document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
                                    </script>
                                    </h4> 
                                    </td>
                                </tr>
                        </table> 
                        <br>
                        <div class="row">
                            <div class="col-md-11">
                        <canvas id="myChart" width="400" height="150"></canvas>
                        <h4 align="center">Preguntas </h4>  
                            </div>
                            <div class="col-md-1">
                                <h4 style="font-weight: bold;">Promedio General</h4>
                                <h4 id="gtotal" style="font-weight: bold;"></h4>
                            </div>
                             
                         </div> 
                                       
                                                        
                        <hr>
                        <div>
                            <table id="tbltitle">
                                <tr>
                                    <td>Grupo</td>
                                    <td>Profesor</td>
                                    <td>Materia</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid;"><?php echo $rgru['nomGru']; ?></td>
                                    <td style="border: 1px solid;"><?php echo $prof['nombre']; ?></td>
                                    <td style="border: 1px solid;"><?php echo $rmat['nomMat']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive ">
                                        <table class="table table-hover" id="dataTableAlumnos">
                                            <thead>
                                                <tr>
                                                    <th id="tituloalumno">Alum</th>
                                                    <?php 
                                    require_once "../model/connect.php";
                                    $dataPre="SELECT cvePre FROM pregunta";    
                                    $consulta=consultarSQL($dataPre);
                                    while ($fila=$consulta->fetch_array(MYSQLI_ASSOC)) {
                                        echo "
                                                <th>P".$fila["cvePre"]."</th>
                                            ";
                                                
                                        }
                                    ?>                                                    
                                                    <th style="white-space: pre-line;">Promedio X<br> Alumno</th>
                                                    <th>Comentarios <img src="../img/imgcoment.png" alt="" style="width: 30px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    <?php 
                                    require_once "../model/connect.php";
                                    $dataEva="SELECT evaluacion.cveEva AS cveEva, evaluacion.comEva AS comEva FROM evaluacion INNER JOIN imparte ON evaluacion.cveImp=imparte.cveImp WHERE imparte.cvePro='$cvePro' AND imparte.cveMat='$cveMat'";    
                                    $consulta=consultarSQL($dataEva);
                                    $alum=1;
                                    while ($filaEva=$consulta->fetch_array(MYSQLI_ASSOC)) {
                                        $cveEva=$filaEva['cveEva'];
                                        echo "
                                                <tr>
                                                <td>".$alum."</td>
                                            ";
                                                $dataCal="SELECT evaluacionpregunta.calPre AS calPre FROM evaluacionpregunta INNER JOIN evaluacion ON evaluacionpregunta.cveEva=evaluacion.cveEva WHERE evaluacionpregunta.cveEva='$cveEva' ";
                                                $consultaCal=consultarSQL($dataCal);
                                                while ($filaCal=$consultaCal->fetch_array(MYSQLI_ASSOC)) {
                                                    echo "  <td>".$filaCal['calPre']."</td>";
                                                }

                                        echo "  <td>";
                                                $dataProm="SELECT ROUND(AVG(evaluacionpregunta.calPre),1) AS prom FROM evaluacionpregunta INNER JOIN evaluacion ON evaluacionpregunta.cveEva=evaluacion.cveEva WHERE evaluacionpregunta.cveEva='$cveEva' ";
                                                $consultaProm=consultarSQL($dataProm);
                                                while ($filaProm=$consultaProm->fetch_array(MYSQLI_ASSOC)) {
                                                    echo $filaProm['prom'];
                                                }

                                        echo " </td>";
                                        echo "  <td>".$filaEva['comEva']."</td>";

                                        echo "  </tr>";
                                            
                                             $alum++;   
                                        }
                                    ?> 
                                            <tr id="promxpre">
                                                <td></td>
                                    <?php 
                                    require_once "../model/connect.php";
                                    $dataPre="SELECT cvePre FROM pregunta";    
                                    $consulta=consultarSQL($dataPre);
                                    $datos = array();
                                    $preg=array();
                                    while ($fila=$consulta->fetch_array(MYSQLI_ASSOC)) {
                                        $cvePre=$fila["cvePre"];
                                        echo "<td id='prompre'>";  
                                        $conCalEva="SELECT ROUND(AVG(evaluacionpregunta.calPre),1) As promPre FROM evaluacion INNER JOIN imparte ON evaluacion.cveImp=imparte.cveImp INNER JOIN evaluacionpregunta ON evaluacionpregunta.cveEva=evaluacion.cveEva WHERE imparte.cvePro='$cvePro' AND imparte.cveMat='$cveMat' AND evaluacionpregunta.cvePre='$cvePre'";    
                                            $restCalEva=consultarSQL($conCalEva);
                                            while ($filaCalEva=$restCalEva->fetch_array(MYSQLI_ASSOC)) {
                                                  echo "<p>".$filaCalEva['promPre']."</p>";
                                                  $datos[]=floatval($filaCalEva['promPre']);
                                                  
                                            }
                                            $preg[]=$fila['cvePre'];                                            
                                        echo "</td>";  
                                        }
include '../ZingChart/src/zc.php';
use ZingChart\PHPWrapper\ZC;



$zc = new ZC("myChart");
$zc->setChartType("bar");
$zc->setTitle("");
$zc->setSeriesData(0,$datos);
$zc->setScaleXLabels($preg);
$zc->setChartHeight("400px");
$zc->setChartWidth("100%");
$zc->render();
                                    ?> 
                                                <td></td>
                                                <td><h4>Promedio X Pregunta</h4></td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid">
                                                <td></td>
                                            <?php 
                                                require_once "../model/connect.php";
                                                $dataPre="SELECT cvePre FROM pregunta";    
                                                $consulta=consultarSQL($dataPre);
                                                while ($fila=$consulta->fetch_array(MYSQLI_ASSOC)) {
                                                    echo "<td></td>";    
                                                    }
                                            ?>  
                                                <td>
                                                    <?php 
                                                require_once "../model/connect.php";
                                                $dataProTot="SELECT ROUND(AVG(evaluacionpregunta.calPre),1) As promPre, evaluacion.cveEva AS cveEva, evaluacion.comEva AS comEva FROM evaluacion INNER JOIN imparte ON evaluacion.cveImp=imparte.cveImp INNER JOIN evaluacionpregunta ON evaluacionpregunta.cveEva=evaluacion.cveEva WHERE imparte.cvePro='$cvePro' AND imparte.cveMat='$cveMat'";    
                                                $conProTot=consultarSQL($dataProTot);
                                                $filaProTot=$conProTot->fetch_array(MYSQLI_ASSOC);
                                                    echo "<h4 id='promtot' style='font-weight: bold;''>".$filaProTot['promPre']."</h4>";
                                                echo "<input id='total' type='hidden' name='' value=".$filaProTot['promPre'].">";  
                                            ?> 
                                                

                                                </td>
                                                <td><h4 style="font-weight: bold;">Promedio General</h4></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>                             
                    </div>
                </div>
            </div>
        </div>

    </div>

    
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script>
var ctx = document.getElementById("myChart").getContext('2d');
var jsdata=<?php echo json_encode($datos);?>;
var xlabels=<?php echo json_encode($preg);?>;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: xlabels,
        datasets: [{
            label: 'Promedio',
            data: jsdata,
            backgroundColor:'rgba(41, 128, 185,0.6)',
            borderColor:'rgba(52, 73, 94,0.7)',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
    <script>
       var promt=document.getElementById("total").value;
       document.getElementById("gtotal").innerHTML = promt; 
    </script>      
    

</body>

</html>
