<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>�rea do Autor</title>

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
                  <li><a href="area_autor.php">�rea do Autor</a></li>
                  <li><a href='login_autor.html'><span>Sair</span></a></li>
                </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>�rea do Autor: Avalia��es Pendentes de Aprova��o<span class="pull-right label label-default">:)</span></legend>
<?php
session_start(); 
error_reporting(0);

include "mysqlconecta.php";
header('Content-Type: text/html; charset=ISO-8859-1');



$busca_padrao = "SELECT DISTINCT nome, titulo, nome_produto, data_defesa, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, nivel_de_ensino, serie_de_destino, status, usu_nome, data_gravacao, usu_avaliador.ava_id, avaliacao FROM pessoa, dissertacao, produto_mpec, esta_associado, associado, area_concentracao, nivel_produto, nivel_de_ensino, pmpec_tipo, tipo, dissert_palavra, palavra_chave, avalia, resposta, usu_avaliador, serie_produto, serie_de_destino WHERE email = '$_SESSION[UsuarioEmail]' AND pessoa.id_pessoa = esta_associado.id_pessoa AND esta_associado.id_produto = produto_mpec.id_produto AND dissertacao.id_dissertacao = produto_mpec.id_dissertacao AND  produto_mpec.id_produto = associado.id_produto AND associado.id_areaconc = area_concentracao.id_areaconc  AND produto_mpec.id_produto = nivel_produto.id_produto AND nivel_produto.id_nivel = nivel_de_ensino.id_nivel AND produto_mpec.id_produto = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo AND produto_mpec.id_dissertacao = dissertacao.id_dissertacao AND dissertacao.id_dissertacao = dissert_palavra.id_dissertacao AND dissert_palavra.id_palavra = palavra_chave.id_palavra AND produto_mpec.id_produto = avalia.id_produto AND avalia.ava_id = resposta.ava_id AND avalia.id_produto = resposta.id_produto AND avalia.ava_id = usu_avaliador.ava_id AND produto_mpec.id_produto = serie_produto.id_produto AND serie_produto.id_serie = serie_de_destino.id_serie AND resposta.status = 'Pendente' ";

$busca_query = mysql_query($busca_padrao)or die(mysql_error());

if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lan�aa essa mensagem
  echo "<div class=\"page-header\" align=\"center\">
  <p><b>N�o h� produtos avaliados pendentes de aprova��o.</b><br \>
  </div>";
}

while ($dados = mysql_fetch_array($busca_query)) {
  $idprod = $dados[8];
  $idava = $dados[16];
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
/*echo "$resp1<br />";
echo "$resp2<br />";
echo "$resp3<br />";
echo "$resp4<br />";
echo "$resp5<br />";
echo "$resp6<br />";
echo "$resp7<br />";
echo "$resp8<br />";
echo "$resp9<br />";
echo "$resp10<br />";
echo "$resp11<br />";
echo "$resp12<br />";
echo "$resp13<br />";
echo "$resp14<br />";
echo "$resp15<br />";
echo "$resp16<br />";
echo "$resp17<br />";
echo "$resp18<br />";*/

$var = $dados[8] + $dados[16] *10000;

echo "<b>Nome do Produto: $dados[nome_produto]</b><br />
<b>Avaliador:</b> $dados[14] <br />
<b>Data da Avalia��o:</b> $dados[data_gravacao] <br />
<b>Situa��o:</b> $dados[status] <br />
<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#$var\">
Visualizar Avalia��o
</button><br /><br />";
echo "<div class=\"modal fade\" id=\"$var\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
<div class=\"modal-dialog\" role=\"document\">
<div class=\"modal-content\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
<h4 class=\"modal-title\" id=\"myModalLabel\">$dados[nome_produto]</h4>
</div>
<div class=\"modal-body\">
<p align=\"left\">Quest�o 01 - Qual a modalidade administrativa da institui��o onde  foi aplicado o produto educacional?</p>
<p><b>$resp1</b></p><br />
<p> Quest�o 02 - Nome completo da(s) institui��o(�es) onde foi(ram) aplicado(s) o produto de mestrado profissional?</p>
<p><b>$resp2</b></p><br />
<p>Quest�o 03 - Em quantas turmas foram aplicadas o produto educacional avaliado?</p>
<p><b>$resp3</b></p><br />
<p>Quest�o 04 - Quantas atividades foram realizadas baseadas no produto educacional?</p>
<p><b>$resp4</b></p><br />
<p>Quest�o 05 - Voc� considera que o material apresentado no produto pode provocar uma reflex�o relevante na pr�tica docente dos sujeitos envolvidos na atividade?</p>
<p><b>$resp5</b></p><br />
<p align=\"left\">Quest�o 06 - O T�tulo do Produto Educacional est� coerente com a proposta nele desenvolvida.</p>
<p><b>$resp6</b></p><br />
<p align=\"left\">Quest�o 07 - A descri��o geral do produto est� clara e objetiva de modo a esclarecer o professor acerca das informa��es b�sicas de suas propostas de aplica��o e objetivos educacionais.</p>
<p><b>$resp7</b></p><br />
<p align=\"left\">Quest�o 08 - O autor se preocupou com a est�tica, o aspecto visual e a organiza��o do conte�do do produto educacional de modo a tornar sua apresenta��o e utiliza��o agrad�vel ao seu usu�rio final.</p>
<p><b>$resp8</b></p><br />
<p align=\"left\">Quest�o 09 - O produto elaborado possui uma tem�tica ou uma forma de abordagem original e relevante para a discuss�o e/ou aplica��o em uma sala de aula.</p>
<p><b>$resp9</b></p><br />
<p align=\"left\">Quest�o 10 - O produto educacional possui um texto coerente e adequado ao seu objetivo e p�blico alvo.</p>
<p><b>$resp10</b></p><br />
<p align=\"left\">Quest�o 11 - Voc� considera que o produto possui uma tem�tica e/ou uma abordagem capaz de despertar o interesse de outros professores em utiliz�-lo.</p>
<p><b>$resp11</b></p><br />
<p align=\"left\">Quest�o 12 - As explica��es e instru��es (metodologia) sobre como os professores devem utilizar o produto educacional est�o claras e objetivas.</p>
<p><b>$resp12</b></p><br />
<p align=\"left\">Quest�o 13 - A atividade a ser desenvolvida possui uma metodologia ou uma forma de abordagem coerente, interessante e inovadora a ser trabalhada.</p>
<p><b>$resp13</b></p><br />
<p><p align=\"left\">Quest�o 14 - Durante a aplica��o da atividade proposta pelo produto educacional, os participantes demonstraram interesse pelo seu desenvolvimento antes, durante e depois de sua aplica��o.</p>
<p><b>$resp14</b></p><br />
<p><p align=\"left\">Quest�o 15 - Ap�s a conclus�o da atividade foi poss�vel identificar alguma altera��o dos participantes sobre a tem�tica apresentada. </p><br />
<p><b>$resp15</b></p><br />
<p align=\"left\">Quest�o 16 - Ap�s utilizar o produto educacional foi poss�vel atingir o(s) objetivo(s) proposto(s) por ele. </p>
<p><b>$resp16</b></p><br />
<p align=\"left\">Quest�o 17 - Ap�s a conclus�o da atividade foi poss�vel identificar ou verificar alguma altera��o conceitual, procedimental ou atitudinal nos participantes (estudantes ou docentes) sobre a tem�tica apresentada.  </p>
<p><b>$resp17</b></p><br />
<p align=\"left\">Quest�o 18 - Voc� recomendaria alguma mudan�aa ou altera��o no produto educacional com a finalidade de melhor�-lo? </p>
<p><b>$resp18</b></p><br />
</div>
<div class=\"modal-footer\">
<form method=post>
<input type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\" value=\"Fechar\">
<input type=\"submit\" class=\"btn btn-primary\" name=\"Recusar\" id=\"Recusar\" value=\"Recusar\">
<input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
<input type=\"hidden\" class=\"form-control\" name=\"idava\" id=\"idava\" value=\"$idava\"required>
<input type=\"hidden\" class=\"form-control\" name=\"numava\" id=\"numava\" value=\"$numava\"required>
<input type=\"submit\" class=\"btn btn-primary\" name=\"Aceitar\" id=\"Aceitar\" value=\"Aceitar\">
</form>
</div>
</div>
</div>
</div></td>
</tr>";
}
if(isset($_POST['Recusar'])){
  $idprod = $_POST['idprod'];
  $idava = $_POST['idava'];
  $inserir_query = "UPDATE resposta SET status = 'Recusada' WHERE ava_id = $idava AND id_produto = $idprod";
  mysql_query($inserir_query) or die(mysql_error());
  echo "<script>location.href='finalizar_recusar_avaliacao_autor.php';</script>";
  //  echo "$idprod ---- $idava";
  

} elseif (isset($_POST['Aceitar'])) {
  $idprod = $_POST['idprod'];
  $idava = $_POST['idava'];
  $numava = $_POST['numava'] + 1;
  $inserir_query = "UPDATE resposta SET status = 'Avaliado' WHERE ava_id = $idava AND id_produto = $idprod";
  mysql_query($inserir_query) or die(mysql_error());
  $inserir_query2 = "UPDATE produto_mpec SET avaliacao = $numava WHERE id_produto = $idprod";
  mysql_query($inserir_query2) or die(mysql_error());
  echo "<script>location.href='finalizar_aceitar_avaliacao_autor.php';</script>";
    //  echo "$idprod ---- $idava";
  
} 

      /*echo "
      <form name=\"form1\" method=\"post\" action=\"\">
      <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
      <input type=\"hidden\" class=\"form-control\" name=\"idava\" id=\"idava\" value=\"$idava\"required>
      <input type=\"submit\" class=\"btn btn-primary\" name=\"visualizar\" id=\"visualizar\" value=\"Visualizar Avalia��o\">
      <br />
      </form>
      <hr>";*/


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
