<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Profesor</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/jquery-3.2.1.js"></script>
    <script src="../controller/loginprofesor.js"></script>

</head>

<body>
    <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        UTNG
                    </a>
                </div>
                <!--
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#">
                            
                        </a>
                    </li>
                </ul>
                -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../index.php">
                            <span class="glyphicon glyphicon-bookmark"></span>
                            inicio
                        </a>
                    </li>
                    <li>
                        <a href="loginalumno.php">
                            <span class="glyphicon glyphicon-user">
                            </span>
                            Alumno
                        </a>
                    </li>
                    <li>
                        <a href="loginprofesor.php">
                            <span class="glyphicon glyphicon-log-in">
                            </span>
                            Profesor
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingrese los datos</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="loginProfesor" name="loginProfesor" action="" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Numero de Control" id="cvePro" name="cvePro" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" id="pasPro" name="pasPro" type="password" value="">
                                </div>
                                <input type="submit" id="ingresar" name="ingresar" value="Ingresar" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
