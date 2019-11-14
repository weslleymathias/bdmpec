<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoadministrador.php";
  header('Content-Type: text/html; charset=ISO-8859-1');

  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Avaliadores Cadastrados</title>

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
        session_start(); 
        error_reporting(0);

        include "mysqlconecta.php";

        $email = $_SESSION['AdmEmail'];
        $senha = $_SESSION['AdmSenha'];

        $_SESSION['idava'];

        echo "<div class=\"container\">
        <div class=\"row\">

        <div class=\"col-lg-12\">
        <legend>Área Administrativa: Avaliadores Cadastrados<span class=\"pull-right label label-default\">:)</span></legend>";

$busca_query = "SELECT usu_nome, usu_ies, usu_curso, usu_email, usu_lattes, ava_id FROM usu_avaliador";
$busca = mysql_query($busca_query) or die(mysql_error());
if (mysql_num_rows($busca) == 0) { //Se nao achar nada, lança essa mensagem
  echo "<div class=\"page-header\" align=\"center\">
  <p><b>Não há avaliadores cadastrados.</b><br \>
  </div>";
}
while ($dados = mysql_fetch_array($busca)) {  
 echo "Nome: $dados[0]<br />";
 echo "IES: $dados[1]<br />";
 echo "Curso: $dados[2]<br />";
 echo "Email: $dados[3]<br />";
 echo "Lattes: $dados[4]<br /><br />";
  // echo "ID: $dados[5]<br /><br />";
 $idava = $dados[5];
 echo "<form method=\"post\">
 <div align=\"left\">
 <button type=\"submit\" class=\"btn btn-primary\" name=\"Encaminhar\" id=\"Encaminhar\" value=\"Encaminhar Email\"><span class=\"glyphicon glyphicon-envelope\"></span> Encaminhar Email</button>
 <button type=\"submit\" class=\"btn btn-success\" name=\"Editar\" id=\"Editar\" value=\"Editar\"><span class=\"glyphicon glyphicon-pencil\"></span> Editar</button>
 <input type=\"hidden\" class=\"form-control\" name=\"idava\" id=\"idava\" value=\"$idava\"required>
 <button type=\"submit\" class=\"btn btn-danger\" name=\"Remover\" id=\"Remover\" value=\"Remover\"><span class=\"glyphicon glyphicon-trash\"></span> Remover</button>
 </form>";
 echo "<hr>";
}
if(isset($_POST['Encaminhar'])){
  $_SESSION['idava'] = $_POST['idava'];
  echo "<script>location.href='encaminhar_email_avaliador.php';</script>";
}
if(isset($_POST['Editar'])){
  $_SESSION['idava'] = $_POST['idava'];
  echo "<script>location.href='editar_avaliador.php';</script>";
}
if(isset($_POST['Remover'])){
   // $_SESSION['idava'] = $dados[5];
   // $idava = $_SESSION['idava'];
  $deletar_query = "DELETE FROM usu_avaliador WHERE $_POST[idava] = ava_id";
  mysql_query($deletar_query) or die(mysql_error());
  echo "<script>location.href='finalizar_remover_avaliador.php';</script>";
}

//echo "$_SESSION[idava]<br />";

echo " </div>
</div>
</div>";

?>
</body>
</html>