<?php 
    session_start();
    $cvePro=$_SESSION['cvePro'];
    require_once "../model/connect.php";
    $query="SELECT imparte.cveImp as cveImp, imparte.cvePro as cvePro, CONCAT(nomPro,' ',aPaPro,' ',aMaPro) as nombre, periodo.nomPer as periodo, periodo.year as year  FROM  profesor INNER JOIN imparte ON profesor.cvePro=imparte.cvePro INNER JOIN periodo ON imparte.cvePer=periodo.cvePer WHERE imparte.cvePro='$cvePro'";
    $profes=consultarSQL($query);
    $prof=$profes->fetch_array(MYSQLI_ASSOC);    
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

    <style>
        #asend {
            width: 100%;
            border:none;
            display: block;
            color: #16a085;
            height: 3em;
            background-color: #FFFFF7;
            border-bottom: 1px solid #bdc3c7;
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
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> General</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Grupos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <?php 
                                $cveImp=$prof['cveImp'];
                                require_once "../model/connect.php";
                                $grupos="SELECT imparte.cveGru AS cveGru, grupo.nomgru as grupo FROM imparte INNER JOIN grupo ON imparte.cveGru=grupo.cveGru WHERE imparte.cvePro='$cvePro'";  
                                $result=consultarSQL($grupos);
                                while ($gru=$result->fetch_array(MYSQLI_ASSOC)) {
                                    echo '
                                    <li>
                                        <a href="#">'.$gru['grupo'].' <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            '; 
                                                $cveGru=$gru['cveGru'];
                                               $materias="SELECT  imparte.cveMat AS cveMat, materia.nommat as materia FROM materia INNER JOIN imparte ON materia.cveMat=imparte.cveMat WHERE imparte.cvePro='$cvePro' AND imparte.cveGru='$cveGru'";  
                                                $rmat=consultarSQL($materias);
                                                while ($mat=$rmat->fetch_array(MYSQLI_ASSOC)) {
                                                    echo '<li>
                                                    <form action="reporteprofesor.php" method="POST" accept-charset="utf-8">
                                                    <input type="hidden" id="cveGru" name="cveGru" value="'.$gru['cveGru'].'">
                                                    <input type="hidden" id="cveMat" name="cveMat" value="'.$mat['cveMat'].'">
                                                    <input type="hidden" id="cveImp" name="cveImp" value="'.$prof['cveImp'].'">
                                                    <input type="hidden" id="cvePro" name="cvePro" value="'.$prof['cvePro'].'">
                                                    <input id="asend" type="submit" name="" value="'.$mat['materia'].'">
                                                    </form>
                                                    </li>
                                                    ';
                                                } 
                                            
                                echo '  </ul> ';
                            echo '  </li> ';
                                    
                                }    
                            ?>                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>                            
                            <a href="#"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </nav>

        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Reportes de Evaluación Docente</h1>
                            <div class="panel panel-primary">
                                <div class=" panel-heading ">
                                                                        
                                </div>
                                <div class="panel-body ">
                                    
                                </div>
                            </div>                        
                    </div><!--col-lg-12-->
                </div><!--row-->
            </div><!--container-fluid-->
        </div><!--page-wrapper-->

    </div>

    
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>    
    <script>
    $(document).ready(function(){
        $('#loadForm').click(function(){
            $('#div1').load('../');
            });
        });
    </script>

</body>

</html>
