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

  <title>Formulário 3 de 5</title>

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

            $busca = "SELECT DISTINCT Resposta08, Resposta09, Resposta10, Resposta11, Resposta12, Resposta13 FROM resposta WHERE ava_id = $avaid AND id_produto = $idprod";
            $busca_query = mysql_query($busca) or die(mysql_error());
            if ($dados = mysql_fetch_array($busca_query)) {
              $resp8 = $dados['Resposta08'];
              $resp9 = $dados['Resposta09'];
              $resp10 = $dados['Resposta10'];
              $resp11 = $dados['Resposta11'];
              $resp12 = $dados['Resposta12'];
              $resp13 = $dados['Resposta13'];
            }

            function checked( $v, $d ){
              return $v===$d ? ' checked="checked"' : '';
            }
            
          /*  echo "$resp8<br />";
            echo "$resp9<br />";
            echo "$resp10<br />";
            echo "$resp11<br />";
            echo "$resp12<br />";
            echo "$resp13<br />";
            echo "$email<br />";
            echo "$senha<br />";
            echo "$idprod<br />";
            echo "$avaliar<br />"; */

            echo " <form name=\"questionario\" method=\"post\" action=\"\">
            <p class=\"lead\"><strong class=\"text-danger\">Produto: $nomeprod</strong><p>
            <h3>Leitura prévia do produto educacional</h3>
            <hr>

            <p align=\"left\">Questão 08 - O autor se preocupou com a estética, o aspecto visual e a organização do conteúdo do produto educacional de modo a tornar sua apresentação e utilização agradável ao seu usuário final.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest8\" value=\"Discordo fortemente\""; if($resp8 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest8\" value=\"Discordo na maior parte\""; if($resp8 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest8\" value=\"Concordo ligeiramente\""; if($resp8 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest8\" value=\"Concordo moderadamente\""; if($resp8 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest8\" value=\"Concordo na maior parte\""; if($resp8 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest8\" value=\"Concordo fortemente\""; if($resp8 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 09 - O produto elaborado possui uma temática ou uma forma de abordagem original e relevante para a discussão e/ou aplicação em uma sala de aula.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest9\" value=\"Discordo fortemente\""; if($resp9 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest9\" value=\"Discordo na maior parte\""; if($resp9 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest9\" value=\"Concordo ligeiramente\""; if($resp9 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest9\" value=\"Concordo moderadamente\""; if($resp9 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest9\" value=\"Concordo na maior parte\""; if($resp9 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest9\" value=\"Concordo fortemente\""; if($resp9 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 10 - O produto educacional possui um texto coerente e adequado ao seu objetivo e público alvo.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest10\" value=\"Discordo fortemente\""; if($resp10 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest10\" value=\"Discordo na maior parte\""; if($resp10 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest10\" value=\"Concordo ligeiramente\""; if($resp10 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest10\" value=\"Concordo moderadamente\""; if($resp10 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest10\" value=\"Concordo na maior parte\""; if($resp10 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest10\" value=\"Concordo fortemente\""; if($resp10 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 11 - Você considera que o produto possui uma temática e/ou uma abordagem capaz de despertar o interesse de outros professores em utilizá-lo.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest11\" value=\"Discordo fortemente\""; if($resp11 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest11\" value=\"Discordo na maior parte\""; if($resp11 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest11\" value=\"Concordo ligeiramente\""; if($resp11 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest11\" value=\"Concordo moderadamente\""; if($resp11 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest11\" value=\"Concordo na maior parte\""; if($resp11 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest11\" value=\"Concordo fortemente\""; if($resp11 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 12 - As explicações e instruções (metodologia) sobre como os professores devem utilizar o produto educacional estão claras e objetivas.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest12\" value=\"Discordo fortemente\""; if($resp12 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest12\" value=\"Discordo na maior parte\""; if($resp12 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest12\" value=\"Concordo ligeiramente\""; if($resp12 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest12\" value=\"Concordo moderadamente\""; if($resp12 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest12\" value=\"Concordo na maior parte\""; if($resp12 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest12\" value=\"Concordo fortemente\""; if($resp12 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 13 - A atividade a ser desenvolvida possui uma metodologia ou uma forma de abordagem coerente, interessante e inovadora a ser trabalhada.</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest13\" value=\"Discordo fortemente\""; if($resp13 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest13\" value=\"Discordo na maior parte\""; if($resp13 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest13\" value=\"Concordo ligeiramente\""; if($resp13 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest13\" value=\"Concordo moderadamente\""; if($resp13 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest13\" value=\"Concordo na maior parte\""; if($resp13 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest13\" value=\"Concordo fortemente\""; if($resp13 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            
            <p align=\"center\">
            <input type=\"submit\" name=\"anterior\" class=\"btn btn-primary\" id=\"anterior\" value=\"<< Anterior\">
            <input type=\"submit\" name=\"salvar\" type=\"submit\" class=\"btn btn-success\" id=\"salvar\" value=\"Salvar Alterações\">
            <input type=\"submit\" name=\"proximo\" type=\"submit\" class=\"btn btn-primary\" id=\"proximo\" value=\"Próximo >>\"></p>


            </form> ";

            if(isset($_POST['anterior'])){
              $quest8 = $_POST['quest8'];
              $quest9 = $_POST['quest9'];
              $quest10 = $_POST['quest10'];
              $quest11 = $_POST['quest11'];
              $quest12 = $_POST['quest12'];
              $quest13 = $_POST['quest13'];
              

              $inserir_query = "UPDATE resposta SET Resposta08 = '$quest8', Resposta09 = '$quest9', Resposta10 = '$quest10', Resposta11 = '$quest11', Resposta12 = '$quest12', Resposta13 = '$quest13', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form02.php';</script>";
            }

            if(isset($_POST['salvar'])){
              $quest8 = $_POST['quest8'];
              $quest9 = $_POST['quest9'];
              $quest10 = $_POST['quest10'];
              $quest11 = $_POST['quest11'];
              $quest12 = $_POST['quest12'];
              $quest13 = $_POST['quest13'];
              

              $inserir_query = "UPDATE resposta SET Resposta08 = '$quest8', Resposta09 = '$quest9', Resposta10 = '$quest10', Resposta11 = '$quest11', Resposta12 = '$quest12', Resposta13 = '$quest13', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form03.php';</script>";
            }

            if(isset($_POST['proximo'])){
              $quest8 = $_POST['quest8'];
              $quest9 = $_POST['quest9'];
              $quest10 = $_POST['quest10'];
              $quest11 = $_POST['quest11'];
              $quest12 = $_POST['quest12'];
              $quest13 = $_POST['quest13'];
              

              $inserir_query = "UPDATE resposta SET Resposta08 = '$quest8', Resposta09 = '$quest9', Resposta10 = '$quest10', Resposta11 = '$quest11', Resposta12 = '$quest12', Resposta13 = '$quest13', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form04.php';</script>";
            }
            ?>

          </div>

        </div>
      </div>
    </div>
  </body>
  </html>