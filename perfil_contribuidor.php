<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaocontribuidor.php";
  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Acesso ao Acervo</title>

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
                <li><a href='submeter.php'><span>Submeter Produto</span></a></li>
                <li><a href='produtos_submetidos.php'><span>Produtos Submetidos</span></a></li>
                <li><a href='perfil_contribuidor.php'><span>Editar Perfil</span></a></li>  
                <li><a href='logoutcontribuidor.php'><span>Sair</span></a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
        </nav>
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>Área do Contribuidor: Editar Perfil<span class="pull-right label label-default">:)</span></legend>
            </div>
          </div>
        </div>
        <?php
        session_start(); 
        error_reporting(0);

        include "mysqlconecta.php";
        header('Content-Type: text/html; charset=ISO-8859-1');

        $email = $_SESSION['ContEmail'];
        $senha = $_SESSION['ContSenha'];

        $busca_query = "SELECT cont_nome, cont_senha, cont_ies, cont_curso, cont_email, cont_lattes FROM usu_contribuidor WHERE '$email' = cont_email AND '$senha' = cont_senha";
        $busca = mysql_query($busca_query) or die(mysql_error());
        while ($dados = mysql_fetch_array($busca)) {  
   /*echo "Nome: $dados[0]<br />";
   echo "Senha: $dados[1]<br />";
   echo "IES: $dados[2]<br />";
   echo "Curso: $dados[3]<br />";
   echo "Email: $dados[4]<br />";
   echo "Lattes: $dados[5]<br /><br />";
   echo "<a href='editar_perfil.php'>Editar Perfil</a> <br />"; */


   echo "<div class=\"container\">
   <div class=\"row\">
   <div class=\"col-lg-12\">
   <div class=\"container\"> 
   <table class=\"table table-user-information\">
   <tbody>
   <tr>
   <td>Nome:</td>
   <td>$dados[0]</td>
   </tr>
   <tr>
   <td>IES:</td>
   <td>$dados[2]</td>
   </tr>
   <tr>
   <td>Curso:</td>
   <td>$dados[3]</td>
   </tr>
   <tr>
   <td>Lattes:</td>
   <td><a href=\"$dados[5]\">$dados[5]</a></td>
   </tr>
   <tr>
   <td>Email:</td>
   <td><a href=\"mailto:$dados[4]\">$dados[4]</a></td>
   </tr>
   
   
   </tbody>
   </table>
   <a href=\"editar_perfil_contribuidor.php\" data-original-title=\"Edit this user\" data-toggle=\"tooltip\" type=\"button\" class=\"btn btn-primary\"><i class=\"glyphicon glyphicon-edit\"></i> Editar Perfil  </a>
   </div>
   </div>
   </div>            
   
   
   </div>
   </div>
   </div>";
 }

 ?>
</body>
</html>