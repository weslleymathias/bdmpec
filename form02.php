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

  <title>Formulário 2 de 5</title>

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

            $busca = "SELECT DISTINCT Resposta06, Resposta07 FROM resposta WHERE ava_id = $avaid AND id_produto = $idprod";
            $busca_query = mysql_query($busca) or die(mysql_error());
            if ($dados = mysql_fetch_array($busca_query)) {
              $resp6 = $dados['Resposta06'];
              $resp7 = $dados['Resposta07'];
            }

            function checked( $v, $d ){
              return $v===$d ? ' checked="checked"' : '';
            }
            
          /*  echo "$resp6<br />";
            echo "$resp7<br />";
            echo "$email<br />";
            echo "$senha<br />";
            echo "$idprod<br />";
            echo "$avaliar<br />"; */
            
            echo " <form name=\"questionario\" method=\"post\" action=\"\">
            <p class=\"lead\"><strong class=\"text-danger\">Produto: $nomeprod</strong><p>
            <h3>Título e expectativas gerais</h3>
            <hr>


            <p><table width=\"90%\" cellspacing=\"10\" cellpadding=\"10\">
            <tr>
            <td><h4 align=\"left\">As questões a seguir devem ser respondidas para todas as modalidades de produto educacional e respectivas propostas
            de aplicação.
            </h4></td>
            </tr>
            </table>
            <hr>  
            <p align=\"left\">Questão 06 - O título do Produto Educacional está coerente com a proposta nele desenvolvida.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest6\" value=\"Discordo fortemente\""; if($resp6 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest6\" value=\"Discordo na maior parte\""; if($resp6 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest6\" value=\"Concordo ligeiramente\""; if($resp6 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest6\" value=\"Concordo moderadamente\""; if($resp6 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest6\" value=\"Concordo na maior parte\""; if($resp6 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest6\" value=\"Concordo fortemente\""; if($resp6 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 07 - A descrição geral do produto está clara e objetiva de modo a esclarecer o professor acerca das informações básicas de suas propostas de aplicação e objetivos educacionais.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest7\" value=\"Discordo fortemente\""; if($resp7 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest7\" value=\"Discordo na maior parte\""; if($resp7 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest7\" value=\"Concordo ligeiramente\""; if($resp7 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest7\" value=\"Concordo moderadamente\""; if($resp7 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest7\" value=\"Concordo na maior parte\""; if($resp7 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest7\" value=\"Concordo fortemente\""; if($resp7 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            
            <p align=\"center\">
            <input type=\"submit\" name=\"anterior\" class=\"btn btn-primary\" id=\"anterior\" value=\"<< Anterior\">
            <input type=\"submit\" name=\"salvar\" type=\"submit\" class=\"btn btn-success\" id=\"salvar\" value=\"Salvar Alterações\">
            <input type=\"submit\" name=\"proximo\" type=\"submit\" class=\"btn btn-primary\" id=\"proximo\" value=\"Próximo >>\"></p>

            </form> ";

            if(isset($_POST['anterior'])){
              $quest6 = $_POST['quest6'];
              $quest7 = $_POST['quest7'];
              

              $inserir_query = "UPDATE resposta SET Resposta06 = '$quest6', Resposta07 = '$quest7', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query(@$inserir_query) or die(mysql_error());
              echo "<script>location.href='form01v.php';</script>";
            }

            if(isset($_POST['salvar'])){
              $quest6 = $_POST['quest6'];
              $quest7 = $_POST['quest7'];
              

              $inserir_query = "UPDATE resposta SET Resposta06 = '$quest6', Resposta07 = '$quest7', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query(@$inserir_query) or die(mysql_error());
              echo "<script>location.href='form02.php';</script>";
            }

            if(isset($_POST['proximo'])){
              $quest6 = $_POST['quest6'];
              $quest7 = $_POST['quest7'];
              

              $inserir_query = "UPDATE resposta SET Resposta06 = '$quest6', Resposta07 = '$quest7', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query(@$inserir_query) or die(mysql_error());
              echo "<script>location.href='form03.php';</script>";
            }

            ?>
          </div>

        </div>
      </div>
    </div>
  </body>
  </html>