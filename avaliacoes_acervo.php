<!DOCTYPE html>
<html lang="en">

<head>

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

  <link href="css/Servico_Avaliacao.css" rel="stylesheet">

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
                <li>
                  <a href="index.html">Início</a>
                </li>
                <li>
                  <a href="Acesso_Acervo.html">Acesso ao Acervo</a>
                </li>
                <li>
                  <a href="Servico_Avaliacao.html">Serviço de Avaliação</a>
                </li>
                <li>
                  <a href="Servico_Autoarquivamento.html">Autoarquivamento</a>
                </li>
                <li>
                  <a href="sobre.html">Sobre a Biblioteca</a>
                </li>
                <li>
                  <a href="Administracao.html">Administração</a>
                </li>
                <li>
                  <a href="contato.html">Contato</a>
                </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container -->
        </nav>

        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>Avaliações<span class="pull-right label label-default">:)</span></legend>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');

$idprod = $_POST['idprod'];
error_reporting(0);

include "mysqlconecta.php";


$busca_padrao = "SELECT DISTINCT nome_produto, produto_mpec.id_produto, status, usu_nome, data_gravacao, usu_avaliador.ava_id, avaliacao FROM pessoa, produto_mpec, esta_associado, avalia, resposta, usu_avaliador WHERE produto_mpec.id_produto = '$idprod' AND produto_mpec.id_produto = avalia.id_produto AND avalia.ava_id = resposta.ava_id AND avalia.id_produto = resposta.id_produto AND avalia.ava_id = usu_avaliador.ava_id AND resposta.status = 'Avaliado' ";

$busca_query = mysql_query($busca_padrao)or die(mysql_error());

if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
  echo "<div class=\"page-header\" align=\"center\">
  <p><b>Não há avaliações para este produto.</b><br \>
  </div>";
}

while ($dados = mysql_fetch_array($busca_query)) {
//  $idprod = $dados[2];
  $idava = $dados[5];
  $numava = $dados['avaliacao'];
  $busca = "SELECT DISTINCT Resposta01, Resposta02, Resposta03, Resposta04, Resposta05, Resposta06, Resposta07, Resposta08, Resposta09, Resposta10, Resposta11, Resposta12, Resposta13, Resposta14, Resposta15, Resposta16, Resposta17, Resposta18 FROM resposta WHERE ava_id = $idava AND id_produto = $idprod";
  $busca_query2 = mysql_query($busca) or die(mysql_error());
  if ($dados2 = mysql_fetch_array($busca_query2)) {
    $resp1 = $dados2['Resposta01'];
    $resp2 = $dados2['Resposta02'];
    $resp3 = $dados2['Resposta03'];
    $resp4 = $dados2['Resposta04'];
    $resp5 = $dados2['Resposta05'];
    $resp6 = $dados2['Resposta06'];
    $resp7 = $dados2['Resposta07'];
    $resp8 = $dados2['Resposta08'];
    $resp9 = $dados2['Resposta09'];
    $resp10 = $dados2['Resposta10'];
    $resp11 = $dados2['Resposta11'];
    $resp12 = $dados2['Resposta12'];
    $resp13 = $dados2['Resposta13'];
    $resp14 = $dados2['Resposta14'];
    $resp15 = $dados2['Resposta15'];
    $resp16 = $dados2['Resposta16'];
    $resp17 = $dados2['Resposta17'];
    $resp18 = $dados2['Resposta18'];
  }

  $var = $dados[1] + $dados[5] *10000;

  echo "<b>Nome do Produto: $dados[nome_produto]</b><br />
  <b>Avaliador:</b> $dados[usu_nome] <br />
  <b>Data da Avaliação:</b> $dados[data_gravacao] <br /><br />
  <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#$var\">
  Visualizar Avaliação
  </button><br /><br />
  <hr>";
  echo "<div class=\"modal fade\" id=\"$var\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
  <div class=\"modal-dialog\" role=\"document\">
  <div class=\"modal-content\">
  <div class=\"modal-header\">
  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  <h4 class=\"modal-title\" id=\"myModalLabel\">$dados[nome_produto]</h4>
  </div>
  <div class=\"modal-body\">
  <p align=\"left\">Questão 01 - Qual a modalidade administrativa da instituição onde  foi aplicado o produto educacional:</p>
  <p><b>$resp1</b></p><br />
  <p> Questão 02 - Nome completo da(s) instituição(ões) onde foi(ram) aplicado(s) o produto de mestrado profissional:</p>
  <p><b>$resp2</b></p><br />
  <p>Questão 03 - Em quantas turmas foram aplicadas o produto educacional avaliado:</p>
  <p><b>$resp3</b></p><br />
  <p>Questão 04 - Quantas atividades foram realizadas baseadas no produto educacional:</p>
  <p><b>$resp4</b></p><br />
  <p>Questão 05 - Você considera que o material apresentado no produto pode provocar uma reflexão relevante na prática docente dos sujeitos envolvidos na atividade?</p>
  <p><b>$resp5</b></p><br />
  <p align=\"left\">Questão 06 - O Título do Produto Educacional está coerente com a proposta nele desenvolvida?</p>
  <p><b>$resp6</b></p><br />
  <p align=\"left\">Questão 07 - A descrição geral do produto está clara e objetiva de modo a esclarecer o professor acerca das informações básicas de suas propostas de aplicação e objetivos educacionais?</p>
  <p><b>$resp7</b></p><br />
  <p align=\"left\">Questão 08 - O autor se preocupou com a estética, o aspecto visual e a organização do conteúdo do produto educacional de modo a tornar sua apresentação e utilização agradável ao seu usuário final?</p>
  <p><b>$resp8</b></p><br />
  <p align=\"left\">Questão 09 - O produto elaborado possui uma temática ou uma forma de abordagem original e relevante para a discussão e/ou aplicação em uma sala de aula?</p>
  <p><b>$resp9</b></p><br />
  <p align=\"left\">Questão 10 - O produto educacional possui um texto coerente e adequado ao seu objetivo e público alvo?</p>
  <p><b>$resp10</b></p><br />
  <p align=\"left\">Questão 11 - Você considera que o produto possui uma temática e/ou uma abordagem capaz de despertar o interesse de outros professores em utilizá-lo?</p>
  <p><b>$resp11</b></p><br />
  <p align=\"left\">Questão 12 - As explicações e instruções (metodologia) sobre como os professores devem utilizar o produto educacional estão claras e objetivas?</p>
  <p><b>$resp12</b></p><br />
  <p align=\"left\">Questão 13 - A atividade a ser desenvolvida possui uma metodologia ou uma forma de abordagem coerente, interessante e inovadora a ser trabalhada?</p>
  <p><b>$resp13</b></p><br />
  <p><p align=\"left\">Questão 14 - Durante a aplicação da atividade proposta pelo produto educacional, os participantes demonstraram interesse pelo seu desenvolvimento antes, durante e depois de sua aplicação?</p>
  <p><b>$resp14</b></p><br />
  <p><p align=\"left\">Questão 15 - Após a conclusão da atividade foi possível identificar alguma alteração dos participantes sobre a temática apresentada? </p><br />
  <p><b>$resp15</b></p><br />
  <p align=\"left\">Questão 16 - Após utilizar o produto educacional foi possível atingir o(s) objetivo(s) proposto(s) por ele? </p>
  <p><b>$resp16</b></p><br />
  <p align=\"left\">Questão 17 - Após a conclusão da atividade foi possível identificar ou verificar alguma alteração conceitual, procedimental ou atitudinal nos participantes (estudantes ou docentes) sobre a temática apresentada?  </p>
  <p><b>$resp17</b></p><br />
  <p align=\"left\">Questão 18 - Você recomendaria alguma mudança ou alteração no produto educacional com a finalidade de melhora-lo? </p>
  <p><b>$resp18</b></p><br />
  </div>
  <div class=\"modal-footer\">
  <form method=post>
  <input type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\" value=\"Fechar\">
  </form>
  </div>
  </div>
  </div>
  </div></td>
  </tr>";
}

?>


</div>
</div>
</div>

<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
