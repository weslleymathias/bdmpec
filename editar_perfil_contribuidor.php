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

  <title>Editar Perfil</title>

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
              <legend>�rea do Contribuidor: Editar Perfil<span class="pull-right label label-default">:)</span></legend>
              
<?php
session_start(); 
error_reporting(0);

include "mysqlconecta.php";
header('Content-Type: text/html; charset=ISO-8859-1');

$email = $_SESSION['ContEmail'];
$senha = $_SESSION['ContSenha'];

$busca_query = "SELECT cont_nome, cont_senha, cont_ies, cont_curso, cont_email, cont_lattes, cont_id FROM usu_contribuidor WHERE '$email' = cont_email AND '$senha' = cont_senha";
$busca = mysql_query($busca_query) or die(mysql_error());
while ($dados = mysql_fetch_array($busca)) {  
  echo "<form name=\"form1\" method=\"post\">
  <div class=\"col-md-4\">
  <div class=\"col-lg-12\">
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\" required>Nome Completo:</label>
  <input type=\"text\" class=\"form-control\" name=\"nome\" id=\"nome\" value=\"$dados[0]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">E-mail:</label>
  <input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" value=\"$dados[4]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">I.E.S ou Escola da Educa��o B�sica em que atua:</label>
  <input type=\"text\" class=\"form-control\" name=\"ies\" id=\"ies\" value=\"$dados[2]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">�rea de Atua��o:(Programa da I.E.S, F�sica, Qu�mica, etc...)</label>
  <input type=\"text\" class=\"form-control\" name=\"curso\" id=\"curso\" value=\"$dados[3]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">Link para o Lattes:</label>
  <input type=\"text\" class=\"form-control\" name=\"lattes\" id=\"lattes\" value=\"$dados[5]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">Senha:</label>
  <input type=\"password\" class=\"form-control\" name=\"senha\" id=\"senha\" minlength= \"4\" value=\"$dados[1]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">Confirmar Senha:</label>
  <input type=\"password\" class=\"form-control\" name=\"confsenha\" id=\"confsenha\" minlength= \"4\" value=\"$dados[1]\"required oninput=\"validaSenha(this)\">
  </div>
  <br />
  
  <input type=\"hidden\" class=\"form-control\" name=\"idusu\" id=\"idusu\" value=\"$dados[6]\"required>
  
  <button type=\"button\" class=\"btn btn-default\" onclick=\"window.location.href='perfil_contribuidor.php'\">Cancelar</button>
  <input type=\"submit\" class=\"btn btn-primary\" name=\"Confirmar\" id=\"Confirmar\" value=\"Confirmar Altera��es\">
  </div>
  </div>
  </form>";

  if(isset($_POST['Confirmar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $ies = $_POST['ies'];
    $curso = $_POST['curso'];
    $lattes = $_POST['lattes'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    $idusu = $_POST['idusu'];
    if($senha == $confsenha){
      $_SESSION['ContSenha'] = $senha;
      $inserir_query = "UPDATE usu_contribuidor SET cont_nome = '$nome', cont_senha = '$senha', cont_ies = '$ies', cont_curso = '$curso', cont_email = '$email', cont_lattes = '$lattes' WHERE cont_id = $dados[6] ";
      mysql_query($inserir_query) or die(mysql_error());
      echo "<script>location.href='perfil_contribuidor.php';</script>";
      echo $idusu;
    }
  }
}
?>

</div>
</div>
</div>

</body>
</html>

<script type="text/javascript">
function validaSenha (input){ 
  if (input.value != document.getElementById('senha').value) {
    input.setCustomValidity('Repita a senha corretamente');
  } else {
    input.setCustomValidity('');
  }
} </script>