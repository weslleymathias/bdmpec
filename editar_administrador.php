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

  <title>Editar Administrador</title>

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
        header('Content-Type: text/html; charset=ISO-8859-1');

        $idadm = $_SESSION['idadm'];

        echo "<div class=\"container\">
        <div class=\"row\">

        <div class=\"col-lg-12\">
        <legend>Área Administrativa - Administradores Cadastrados: Editar Administrador<span class=\"pull-right label label-default\">:)</span></legend>";

$busca_query = "SELECT usu_nome, usu_senha, usu_email, adm_id FROM usu_administrador WHERE $idadm = adm_id";
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
  <input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" value=\"$dados[2]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">Senha:</label>
  <input type=\"password\" class=\"form-control\" name=\"senha\" id=\"senha\" value=\"$dados[1]\" required>
  </div>
  <div class=\"form-group\">
  <label for=\"recipient-name\" class=\"control-label\">Confirmar Senha:</label>
  <input type=\"password\" class=\"form-control\" name=\"confsenha\" id=\"confsenha\" value=\"$dados[1]\"required>
  </div>
  <br />
  
  <input type=\"hidden\" class=\"form-control\" name=\"idusu\" id=\"idusu\" value=\"$dados[3]\"required>
  
  <button type=\"button\" class=\"btn btn-default\" onclick=\"window.location.href='administradores_cadastrados.php'\">Cancelar</button>
  <input type=\"submit\" class=\"btn btn-primary\" name=\"Confirmar\" id=\"Confirmar\" value=\"Confirmar Alterações\">
  </div>
  </div>
  </form>";
  if(isset($_POST['Confirmar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    $idusu = $_POST['idusu'];
    if($senha == $confsenha){
      $_SESSION['UsuarioSenha'] = $senha;
      $inserir_query = "UPDATE usu_administrador SET usu_nome = '$nome', usu_senha = '$senha', usu_email = '$email' WHERE adm_id = $dados[3] ";
      mysql_query($inserir_query) or die(mysql_error());
      echo "<script>location.href='administradores_cadastrados.php';</script>";
      echo $idusu;
    }
  }
}

echo " </div>
</div>
</div>";

?>
</body>
</html>