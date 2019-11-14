<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoadministrador.php";
  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administradores Cadastrados</title>

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
        <link rel="stylesheet" type="text/css" href="css/Acesso_Acervo.css">
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
        </nav>
        <?php
        header('Content-Type: text/html; charset=ISO-8859-1');

        session_start(); 
        error_reporting(0);

        include "mysqlconecta.php";

        $email = $_SESSION['AdmEmail'];
        $senha = $_SESSION['AdmSenha'];

        echo "<div class=\"container\">
        <div class=\"row\">

        <div class=\"col-lg-12\">
        <legend>Área Administrativa: Administradores Cadastrados<span class=\"pull-right label label-default\">:)</span></legend>";

$busca_query = "SELECT usu_nome, usu_email, adm_id FROM usu_administrador";
$busca = mysql_query($busca_query) or die(mysql_error());
while ($dados = mysql_fetch_array($busca)) {  
  echo "Nome: $dados[0]<br />";
  echo "Email: $dados[1]<br /><br />";
  $idadm = $dados[2];
  echo "<form method=\"post\">
  <div align=\"left\">
  <button type=\"submit\" class=\"btn btn-primary\" name=\"Encaminhar\" id=\"Encaminhar\" value=\"Encaminhar Email\"><span class=\"glyphicon glyphicon-envelope\"></span> Encaminhar Email</button>
  <button type=\"submit\" class=\"btn btn-success\" name=\"Editar\" id=\"Editar\" value=\"Editar\"><span class=\"glyphicon glyphicon-pencil\"></span> Editar</button>
  <input type=\"hidden\" class=\"form-control\" name=\"idadm\" id=\"idadm\" value=\"$idadm\"required>
  <button type=\"submit\" class=\"btn btn-danger\" name=\"Remover\" id=\"Remover\" value=\"Remover\"><span class=\"glyphicon glyphicon-trash\"></span> Remover</button>
  </form>";
  echo "<hr>";
}
if(isset($_POST['Encaminhar'])){
  $_SESSION['idadm'] = $_POST['idadm'];
  echo "<script>location.href='encaminhar_email_administrador.php';</script>";
}
if(isset($_POST['Editar'])){
  $_SESSION['idadm'] = $_POST['idadm'];
  echo "<script>location.href='editar_administrador.php';</script>";
}
if(isset($_POST['Remover'])){
   // $_SESSION['idadm'] = $dados[5];
   // $idadm = $_SESSION['idadm'];
  $deletar_query = "DELETE FROM usu_administrador WHERE $_POST[idadm] = adm_id";
  mysql_query($deletar_query) or die(mysql_error());
  echo "<script>location.href='finalizar_remover_administrador.php';</script>";
}

echo " </div>
</div>
</div>";

?>
</body>
</html>