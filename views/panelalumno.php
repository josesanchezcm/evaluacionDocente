<?php 
    session_start();
    $cveAlu=$_SESSION['cveAlu'];
    require_once "../model/connect.php";
    $query="SELECT CONCAT(nomAlu,' ',aPaAlu,' ',aMaAlu) as nombre, grupo.nomGru as grupo , cveAlu, alumno.cveGru as cveGru, grupo.cvePer as cvePer FROM alumno INNER JOIN grupo ON alumno.cveGru=grupo.cveGru WHERE cveAlu='$cveAlu'";
    $alumnos=consultarSQL($query);
    $alumno=$alumnos->fetch_array(MYSQLI_ASSOC);    
 ?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel Alumno</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../controller/enviarformulario.js"></script>
    

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
                <a class="navbar-brand" href=""><?php echo $alumno['nombre']; ?></a>
            </div>            

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group">
                                <h4>No Control: <?php echo $alumno['cveAlu']; ?></h4>
                                <hr>
                                <h4>Grupo: <?php echo $alumno['grupo']; ?></h4>
                            </div>
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
                        <h1 class="page-header">Formulario de preguntas</h1>
                        <form action="" name="enviarformulario" id="enviarformulario" method="POST">
                        <div class="form-group">
                            <label>Seleccione profesor:</label>
                            <select class="form-control" id="cveImp" name="cveImp">
                                <?php 
                                $gruAlu=$alumno['cveGru'];
                                $perAlu=$alumno['cvePer'];
                                require_once "../model/connect.php";
                                $profesores="SELECT CONCAT(nomPro,' ',aPaPro,' ',aMaPro) as nomPro, nomMat, cveImp FROM profesor INNER JOIN imparte ON profesor.cvePro=imparte.cvePro INNER JOIN materia ON imparte.cveMat=materia.cveMat WHERE imparte.cveGru='$gruAlu' AND imparte.cvePer='$perAlu'";  
                                $result=consultarSQL($profesores);
                                while ($prof=$result->fetch_array(MYSQLI_ASSOC)) {
                                    echo '                             
                                            <option value="'.$prof['cveImp'].'">'.$prof['nomPro'].'--'.$prof['nomMat'].'</option>
                                         ';
                                }    
                                ?>
                            </select>
                        </div>
                        <h1 class="page-header"></h1>
                        <div class="panel panel-primary">
                            <div class="panel-heading">  

                            </div>
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="80%">Enunciado</th>
                                                    <th width="15%">Puntuación</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                require_once "../model/connect.php";
                                                $preguntas="SELECT * FROM pregunta";    
                                                $result=consultarSQL($preguntas);
                                                while ($preg=$result->fetch_array(MYSQLI_ASSOC)) {
                                                echo '
                                                <tr>
                                                    <td><input type="hidden" id="cvePre'.$preg['cvePre'].'" name="cvePre'.$preg['cvePre'].'" value="'.$preg['cvePre'].'">'.$preg['cvePre'].'</td>
                                                    <td>'.$preg['desPre'].'</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" id="calPre'.$preg['cvePre'].'" name="calPre'.$preg['cvePre'].'">
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                ';
                                                }            
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                            <div class="panel-footer">
                                <input type="hidden" id="cveAlu" name="cveAlu" value="<?php echo $alumno['cveAlu']; ?>">
                                <label>Comentario:</label>
                                <input type="text" name="coment" id="coment" style="height: 100px; width: 300px">
                                <input id="btnEnviarForm" name="btnEnviarForm" type="submit" class="btn btn-primary pull-rigth" value="Enviar Formulario">
                            </div>
                        </div>
                        </form>                        
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
