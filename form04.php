<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoavaliador.php";
  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Formulário 4 de 5</title>

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
                <li><a href='Acesso_Acervo_Avaliador.php'><span>Avaliar Produtos</span></a></li>
                <li><a href='produtos_avaliados.php'><span>Visualizar Produtos Avaliados</span></a></li>
                <li><a href='perfil.php'><span>Editar Perfil</span></a></li>  
                <li><a href='logoutavaliador.php'><span>Sair</span></a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
        </nav>
      </body>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <?php
            session_start(); 
            error_reporting(0);

            include "mysqlconecta.php";
            header('Content-Type: text/html; charset=ISO-8859-1');

            $email = $_SESSION['UsuarioEmail'];
            $senha = $_SESSION['UsuarioSenha'];
            $avaid = $_SESSION['AvaliadorId'];
            $idprod = $_SESSION['id'];
            $nomeprod = $_SESSION['nomeprod'];

            $busca = "SELECT DISTINCT Resposta14 FROM resposta WHERE ava_id = $avaid AND id_produto = $idprod";
            $busca_query = mysql_query($busca) or die(mysql_error());
            if ($dados = mysql_fetch_array($busca_query)) {
              $resp14 = $dados['Resposta14'];
            }

            function checked( $v, $d ){
              return $v===$d ? ' checked="checked"' : '';
            }
            
          /*  echo "$resp14<br />";
            echo "$email<br />";
            echo "$senha<br />";
            echo "$idprod<br />";
            echo "$avaliar<br />"; */

            echo " <form name=\"questionario\" method=\"post\" action=\"\">
            <p class=\"lead\"><strong class=\"text-danger\">Produto: $nomeprod</strong><p>
            <h3>Ações durante a aplicação</h3>
            <hr>

            <p><p align=\"left\">Questão 14 - Durante a aplicação da atividade proposta pelo produto educacional, os participantes demonstraram interesse pelo seu desenvolvimento antes, durante e depois de sua aplicação.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest14\" value=\"Discordo fortemente\""; if($resp14 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest14\" value=\"Discordo na maior parte\""; if($resp14 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest14\" value=\"Concordo ligeiramente\""; if($resp14 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest14\" value=\"Concordo moderadamente\""; if($resp14 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest14\" value=\"Concordo na maior parte\""; if($resp14 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest14\" value=\"Concordo fortemente\""; if($resp14 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            
            <p align=\"center\">
            <input type=\"submit\" name=\"anterior\" class=\"btn btn-primary\" id=\"anterior\" value=\"<< Anterior\">
            <input type=\"submit\" name=\"salvar\" type=\"submit\" class=\"btn btn-success\" id=\"salvar\" value=\"Salvar Alterações\">
            <input type=\"submit\" name=\"proximo\" type=\"submit\" class=\"btn btn-primary\" id=\"proximo\" value=\"Próximo >>\"></p>

            </form> ";

            if(isset($_POST['anterior'])){
              $quest14 = $_POST['quest14'];
              

              $inserir_query = "UPDATE resposta SET Resposta14 = '$quest14', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form03.php';</script>";
            }

            if(isset($_POST['salvar'])){
              $quest14 = $_POST['quest14'];
              

              $inserir_query = "UPDATE resposta SET Resposta14 = '$quest14', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form04.php';</script>";
            }

            if(isset($_POST['proximo'])){
              $quest14 = $_POST['quest14'];
              

              $inserir_query = "UPDATE resposta SET Resposta14 = '$quest14', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form05.php';</script>";
            }

            ?>
          </div>

        </div>
      </div>
    </div>
  </body>
  </html>