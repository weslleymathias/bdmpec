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

  <title>Formulário 1 de 5</title>

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

            $_SESSION['id'] = $_POST['idprod'];
            $idprod = $_SESSION['id'];

            $_SESSION['nomeprod'] = $_POST['nomeprod'];
            $nomeprod = $_SESSION['nomeprod'];

            $avaliar = $_POST['avaliar'];

          /*  echo "$email<br />";
            echo "$senha<br />";
            echo "$idprod<br />";
            echo "$avaliar<br />"; */

            echo " <form name=\"questionario\" method=\"post\" action=\"\">
            <p class=\"lead\"><strong class=\"text-danger\">Produto: $nomeprod</strong><p>
            <h3>Informações gerais</h3>
            <hr>

            <table width=\"90%\" cellspacing=\"10\" cellpadding=\"10\">
            <tr>
            <td><h4 align=\"left\">As questões a seguir só devem ser respondidas se o produto educacional, a ser avaliado, foi utilizado por uma turma regular da educação básica ou de ensino superior.</h4></td>
            </tr>
            </table>
            <hr>


            <p align=\"left\">Questão 01 - Qual a modalidade administrativa da instituição onde  foi aplicado o produto educacional?</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest1\" value=\"Estadual\" checked=\"\">Estadual</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest1\" value=\"Federal\">Federal</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest1\" value=\"Privada\">Privada</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest1\" value=\"Militar\">Militar de qualquer natureza</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest1\" value=\"Outra\">Outra</label>
            </div>
            <hr>
            <p>Questão 02 - Nome completo da(s) instituição(ões) onde foi aplicado o produto de mestrado profissional.</p>
            <div class=\"control-group\">
            <label class=\"control-label\" for=\"textarea\"></label>
            <div class=\"controls\">                     
            <textarea name=\"quest2\" cols=\"50\" rows=\"5\" id=\"quest2\"></textarea>
            </div>
            </div>
            <hr>
            <p>Questão 03 - Em quantas turmas foram aplicadas o produto educacional avaliado?
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest3\" value=\"1 Turma\" checked=\"\">1 Turma</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest3\" value=\"2 Turmas\">2 Turmas</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest3\" value=\"3 Turmas\">3 Turmas</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest3\" value=\"4 Turmas\">4 Turmas</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest3\" value=\"5 Turmas ou mais\">5 Turmas ou mais</label>
            </div>
            <hr>
            <table width=\"90%\" cellspacing=\"10\" cellpadding=\"10\">
            <tr>
            <td><h4 align=\"left\">As questões a seguir só devem ser respondidas se o produto educacional possuir, em sua proposta de elaboração, o
            desenvolvimento de alguma atividade que não envolva diretamente os estudantes. Ademais, devem ser respondidas para os produtos
            avaliados que possuem, como proposta, a construção de atividades direcionadas somente aos professores.</h4></td>

            </tr>
            </table>
            <hr>
            <p>Questão 04 - Quantas atividades foram realizadas baseadas no produto educacional?</p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest4\" value=\"1 Atividade\" checked=\"\">1 Atividade</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest4\" value=\"2 Atividades\">2 Atividades</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest4\" value=\"3 Atividades\">3 Atividades</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest4\" value=\"4 Atividades\">4 Atividades</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest4\" value=\"5 Atividades ou mais\">5 Atividades ou mais</label>
            </div>
            <hr>
            <p>Questão 05 - Você considera que o material apresentado no produto pode provocar uma reflexão relevante na prática docente dos sujeitos envolvidos na atividade.
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest5\" value=\"Discordo fortemente\" checked=\"\">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest5\" value=\"Discordo na maior parte\">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest5\" value=\"Concordo ligeiramente\">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest5\" value=\"Concordo moderadamente\">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest5\" value=\"Concordo na maior parte\">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest5\" value=\"Concordo fortemente\">Concordo fortemente</label>
            </div>
            <hr>

            <p align=\"center\">
            <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
            <input type=\"hidden\" class=\"form-control\" name=\"nomeprod\" id=\"nomeprod\" value=\"$nomeprod\"required>
            <input type=\"submit\" name=\"salvar\" type=\"submit\" class=\"btn btn-success\" id=\"salvar\" value=\"Salvar Alterações\">
            <input type=\"submit\" name=\"proximo\" type=\"submit\" class=\"btn btn-primary\" id=\"proximo\" value=\"Próximo >>\"></p>
            </form>";

            if(isset($_POST['salvar'])){
              $quest1 = $_POST['quest1'];
              $quest2 = $_POST['quest2'];
              $quest3 = $_POST['quest3'];
              $quest4 = $_POST['quest4'];
              $quest5 = $_POST['quest5'];

              $inserir_query = "INSERT INTO resposta(Resposta01, Resposta02, Resposta03,Resposta04,Resposta05, Id_Produto, data_gravacao, ava_id, status) VALUES ('$quest1', '$quest2', '$quest3','$quest4','$quest5','$idprod', now(), '$avaid', 'Em Avaliação')";
              mysql_query($inserir_query) or die(mysql_error());
              $inserir_query2 = "INSERT INTO avalia(Id_Produto, ava_id) VALUES ('$idprod', '$avaid')";
              mysql_query($inserir_query2) or die(mysql_error());
              echo "<script>location.href='form01v.php';</script>";
            }
            if(isset($_POST['proximo'])){
              $quest1 = $_POST['quest1'];
              $quest2 = $_POST['quest2'];
              $quest3 = $_POST['quest3'];
              $quest4 = $_POST['quest4'];
              $quest5 = $_POST['quest5'];

              $inserir_query = "INSERT INTO resposta(Resposta01, Resposta02, Resposta03,Resposta04,Resposta05, Id_Produto, data_gravacao, ava_id, status) VALUES ('$quest1', '$quest2', '$quest3','$quest4','$quest5','$idprod', now(), '$avaid', 'Em Avaliação')";
              mysql_query($inserir_query) or die(mysql_error());
              $inserir_query2 = "INSERT INTO avalia(Id_Produto, ava_id) VALUES ('$idprod', '$avaid')";
              mysql_query($inserir_query2) or die(mysql_error());
              echo "<script>location.href='form02.php';</script>";
            }
            ?>
          </div>

        </div>
      </div>
    </div>
  </body>
  </html>
