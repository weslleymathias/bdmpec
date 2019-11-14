<!DOCTYPE html>
<html lang="en">

<head>

    <?php  
    include "sessaoadministrador.php";
    header('Content-Type: text/html; charset=ISO-8859-1');
    ?>

    <link rel="stylesheet" type="text/css" href="css/Area_Administracao.css">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>�rea Administrativa</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img src="img/logompec.png" alt="">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href='administradores.php'><span>Administradores</span></a></li>
                        <li><a href='avaliadores_cadastrados.php'><span>Avaliadores</span></a></li>
                        <li><a href='avaliacoes.php'><span>Avalia��es</span></a></li>
                        <li><a href='contribuidores_cadastrados.php'><span>Contribuidores</span></a></li> 
                        <li><a href='revisao.php'><span>M�dulo de Revis�o</span></a></li> 
                        <li><a href='#'><span>Dados Estat�sticos</span></a></li>
                        <li><a href='logoutadministrador.php'><span>Sair</span></a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <legend>�rea Administrativa<span class="pull-right label label-default">:)</span></legend>
                        <ul align="left">
                            <li><a href="administradores.php">Administradores</a></li><br \>
                            <li><a href="avaliadores_cadastrados.php">Avaliadores</a></li><br \>
                            <li><a href='avaliacoes.php'>Avalia��es</a></li><br \>
                            <li><a href='contribuidores_cadastrados.php'><span>Contribuidores</a></li><br \>
                            <li><a href="revisao.php">M�dulo de Revis�o</a></li><br \>
                            <li><a href="#">Dados Estat�sticos</a></li><br \>
                            <li><a href='logoutadministrador.php'><span>Sair</span></a></li>
                        </ul>
                    </div>
                    <div class="panel with-nav-tabs panel-default">
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.container -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

    </html>
