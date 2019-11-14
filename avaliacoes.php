<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoadministrador.php";
  header('Content-Type: text/html; charset=ISO-8859-1');

  ?>
  <link rel="stylesheet" type="text/css" href="css/Area_Administração.css">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Avaliações</title>

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
                <li><a href='avaliacoes.php'><span>Avaliações</span></a></li>
                <li><a href='contribuidores_cadastrados.php'><span>Contribuidores</span></a></li> 
                <li><a href='revisao.php'><span>Módulo de Revisão</span></a></li> 
                <li><a href='#'><span>Dados Estatísticos</span></a></li>
                <li><a href='logoutadministrador.php'><span>Sair</span></a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container -->
        </nav>


        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>Área Administrativa: Avaliações<span class="pull-right label label-default">:)</span></legend>
<?php
session_start(); 
error_reporting(0);

echo "<p>&nbsp;</p>
<form name=\"form2\" method=\"post\" action=\"\">
<input type=\"submit\" name=\"avaliacoes\" class=\"btn btn-primary\" id=\"avaliacoes\" value=\"Avaliações Finalizadas\">
<input type=\"submit\" class=\"btn btn-primary\" name=\"pendentes\" id=\"pendentes\" value=\"Avaliações Pendentes de Aprovação\">
</form>
<p>&nbsp;</p> ";
if(isset($_POST['avaliacoes'])){
  echo "<script>location.href='avaliacoes_finalizadas.php';</script>";
}
if(isset($_POST['pendentes'])){
  echo "<script>location.href='avaliacoes_pendentes.php';</script>";
}
?>
</div>
</div>
</div>

</body>
<html>
