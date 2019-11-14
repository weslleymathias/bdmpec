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

  <title>Produtos Avaliados</title>

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
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
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
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>Área do Avaliador: Visualizar Produtos Avaliados<span class="pull-right label label-default">:)</span></legend>
              


<?php
session_start(); 
error_reporting(0);

include "mysqlconecta.php";
header('Content-Type: text/html; charset=ISO-8859-1');

$tipo = $_POST['tipo'];
$area = $_POST['area'];
$anoini = $_POST['anoini'];
$anofin = $_POST['anofin'];

$avaliado = "verdadeiro";
$emavaliacao = "verdadeiro";
$pendente = "verdadeiro";
$recusada = "verdadeiro";

/*echo "$tipo<br />";
echo "$area<br />";
echo "$anoini<br />";
echo "$anofin<br />"; */

$email = $_SESSION['UsuarioEmail'];

$busca_padrao = "SELECT DISTINCT titulo, nome_produto, data_defesa, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, nivel_de_ensino, serie_de_destino, status FROM (((((((((((( pessoa JOIN esta_associado ON pessoa.id_pessoa = esta_associado.id_pessoa) JOIN produto_mpec ON esta_associado.id_produto = produto_mpec.id_produto) JOIN dissertacao ON produto_mpec.id_dissertacao = dissertacao.id_dissertacao) JOIN associado ON produto_mpec.id_produto = associado.id_produto) JOIN area_concentracao ON associado.id_areaconc = area_concentracao.id_areaconc) JOIN nivel_produto ON produto_mpec.id_produto = nivel_produto.id_produto) JOIN nivel_de_ensino ON nivel_produto.id_nivel = nivel_de_ensino.id_nivel) JOIN avalia ON produto_mpec.id_produto = avalia.id_produto) JOIN resposta ON (avalia.ava_id = resposta.ava_id AND avalia.id_produto = resposta.id_produto)) JOIN usu_avaliador ON avalia.ava_id = usu_avaliador.ava_id) JOIN serie_produto ON produto_mpec.id_produto = serie_produto.id_produto) JOIN serie_de_destino ON serie_produto.id_serie = serie_de_destino.id_serie) WHERE usu_avaliador.usu_email = '$email' ";

if ($tipo != 'Todos') {
  $busca_padrao = $busca_padrao . "AND status = '$tipo' ";
}
if($area != 'Todas'){
  $busca_padrao = $busca_padrao . "AND modalidade = '$area' ";
}
if($anoini != NULL AND $anofin != NULL){
  $busca_padrao = $busca_padrao . "AND EXTRACT(YEAR FROM data_gravacao) BETWEEN '$anoini%' AND '$anofin%' ";
}

$busca_padrao = $busca_padrao . "ORDER BY status ASC ";
$busca_query = mysql_query($busca_padrao)or die(mysql_error());

if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
  echo "<div class=\"page-header\" align=\"center\">
  <p><b>Não há produtos avaliados segundo os critérios de busca.</b><br \>
  <a href=\"produtos_avaliados.php\" class=\"btn btn-primary\">Voltar</a></p><br \>
  </div>";
}
while ($dados = mysql_fetch_array($busca_query)) {

  if ($avaliado == 'verdadeiro' && $dados['status'] == 'Avaliado'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h3 class=\"text-danger\">Avaliações Aceitas</h3></p>";
    echo "<hr>";
    $avaliado = 'falso';
  }
  if ($emavaliacao == 'verdadeiro' && $dados['status'] == 'Em Avaliação'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h3 class=\"text-danger\">Produtos em Avaliação</h3></p>";
    echo "<hr>";
    $emavaliacao = 'falso';
  }
  if ($pendente == 'verdadeiro' && $dados['status'] == 'Pendente'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h3 class=\"text-danger\">Avaliações Pendentes de Aprovação</h3></p>";
    echo "<hr>";
    $pendente = 'falso';
  }
  if ($recusada == 'verdadeiro' && $dados['status'] == 'Recusada'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h3 class=\"text-danger\">Avaliações Recusadas</h3></p>";
    echo "<hr>";
    $recusada = 'falso';
  }

  $nova_data = date("d-m-Y", strtotime($dados['data_defesa']));
  
  $nomeprod = $dados['nome_produto'];
  $idprod = $dados[7];
  $busca2 = mysql_query("SELECT DISTINCT categoria FROM produto_mpec, pmpec_tipo, tipo WHERE $idprod = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo")or die(mysql_error());
  
  
  $categ = " ";
  while ($dados2 = mysql_fetch_array($busca2)) {  
    $categ = $categ . $dados2['categoria'] . "; ";
  }
  $categ = substr($categ, 0, -2);
  

    /* $niv = " ";
     $busca4 = mysql_query("SELECT DISTINCT nivel_de_ensino FROM produto_mpec, associado, area_concentracao, area_nivel, nivel_de_ensino WHERE $idprod=associado.id_produto AND associado.id_areaconc=area_concentracao.id_areaconc AND area_concentracao.id_areaconc=area_nivel.id_areaconc AND area_nivel.id_nivel=nivel_de_ensino.id_nivel")or die(mysql_error());
     while ($dados4 = mysql_fetch_array($busca4)) {  
        $niv = $niv . $dados4['nivel_de_ensino'] . "; ";
      } */

      $iddis = $dados[8];
      $busca3 = mysql_query("SELECT DISTINCT palavra FROM produto_mpec, dissertacao, dissert_palavra, palavra_chave WHERE $iddis = dissertacao.id_dissertacao AND dissertacao.id_dissertacao = dissert_palavra.id_dissertacao AND  dissert_palavra.id_palavra = palavra_chave.id_palavra")or die(mysql_error());
      
      $palavra = " ";
      while ($dados3 = mysql_fetch_array($busca3)) {  
        $palavra = $palavra . $dados3['palavra'] . "; ";
      }
      $palavra = substr($palavra, 0, -2);

      $busca4 = mysql_query("SELECT DISTINCT serie_de_destino FROM produto_mpec, serie_produto, serie_de_destino WHERE $idprod = produto_mpec.id_produto AND $idprod = serie_produto.id_produto AND serie_produto.id_serie = serie_de_destino.id_serie")or die(mysql_error());
      $serie = " ";
      while ($dados4 = mysql_fetch_array($busca4)) {
       $serie = $serie . $dados4['serie_de_destino'] . "; ";
     }
     $serie = substr($serie, 0, -2);

     $busca5 = mysql_query("SELECT DISTINCT nivel_de_ensino FROM produto_mpec, nivel_produto, nivel_de_ensino WHERE $idprod = produto_mpec.id_produto AND $idprod = nivel_produto.id_produto AND nivel_produto.id_nivel = nivel_de_ensino.id_nivel")or die(mysql_error());
     $nivel = " ";
     while ($dados5 = mysql_fetch_array($busca5)) {
       $nivel = $nivel . $dados5['nivel_de_ensino'] . "; ";
     }
     $nivel = substr($nivel, 0, -2);

     $busca6 = mysql_query("SELECT DISTINCT nome FROM pessoa, esta_associado, produto_mpec WHERE $idprod = produto_mpec.id_produto AND produto_mpec.id_produto = esta_associado.id_produto AND esta_associado.id_pessoa = pessoa.id_pessoa AND papel = 'autor' ")or die(mysql_error());
     while ($dados6 = mysql_fetch_array($busca6)) {
       $autor = $dados6['nome'];
     }

     $busca7 = mysql_query("SELECT DISTINCT nome FROM pessoa, esta_associado, produto_mpec WHERE $idprod = produto_mpec.id_produto AND produto_mpec.id_produto = esta_associado.id_produto AND esta_associado.id_pessoa = pessoa.id_pessoa AND papel = 'orientador' ")or die(mysql_error());
     while ($dados7 = mysql_fetch_array($busca7)) {
       $orientador = $dados7['nome'];
     }

     echo "<a href=\"\" data-toggle=\"modal\" data-target=\"#$dados[8]\"><b><u> <font color=\"#0000FF\" size=\"4\">$dados[nome_produto]</font></u></b><br /></a>
     <i class=\"glyphicon glyphicon-user\"></i><b> Autor:</b> $autor <br />
     <i class=\"glyphicon glyphicon-list-alt\"></i><b> Descrição Geral:</b> $dados[descricao_geral] <br />";
     
     if (($dados[12] == "Avaliado") || ($dados[12] == "Pendente") || ($dados[12] == "Recusada")) {

      echo "<form name=\"form1\" method=\"post\" action=\"visualizar_avaliacao.php\">

      <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
      <input type=\"hidden\" class=\"form-control\" name=\"nomeprod\" id=\"nomeprod\" value=\"$nomeprod\"required>
      <input type=\"submit\" class=\"btn btn-primary\" name=\"visualizar\" id=\"visualizar\" value=\"Visualizar Avaliação\">
      <br />
      </form>";
    }
    elseif ($dados[12] == "Em Avaliação") {
      
      echo "<form name=\"form1\" method=\"post\" action=\"form01pa.php\">

      <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
      <input type=\"hidden\" class=\"form-control\" name=\"nomeprod\" id=\"nomeprod\" value=\"$nomeprod\"required>
      <input type=\"submit\" class=\"btn btn-primary\" name=\"avaliar\" id=\"avaliar\" value=\"Continuar Avaliação\">
      <br />
      </form>";
    }
    
    echo "<td><!-- Button trigger modal -->
    <hr>

    <div class=\"modal fade\" id=\"$dados[8]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
    <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
    <div class=\"modal-header\">
    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
    <h4 class=\"modal-title\" id=\"myModalLabel\">$dados[nome_produto]</h4>
    </div>
    <div class=\"modal-body\">
    <b>Área de Concentração:</b> $dados[modalidade]<br />
    <hr>
    <b>Série de Destino:</b> $serie<br />
    <hr>
    <b>Nome do Autor:</b> $autor<br />
    <hr>
    <b>Título da Dissertação:</b> $dados[titulo]<br />
    <hr>
    <b>Título do Produto Educacional:</b> $dados[nome_produto]<br />
    <hr>
    <b>Descrição Geral:</b> $dados[descricao_geral] <br />
    <hr>
    <b>Data da defesa:</b> $nova_data<br />
    <hr>
    <b>Orientador:</b> $orientador<br />
    <hr>
    <b>Categoria:</b> $categ<br />
    <hr>
    <b>Palavra-Chave:</b> $palavra<br />
    <hr>
    <b>Nível de Ensino:</b> $nivel<br />
    </div>
    <div class=\"modal-footer\">
    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fechar</button>
    <button type=\"button\" class=\"btn btn-primary\" onclick=\" window.location='$dados[link_produto]'\" >Acesso ao Produto</button>
    <button type=\"button\" class=\"btn btn-primary\" onclick=\" window.location='$dados[link_dissertacao]'\" >Download da Dissertação</button>
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
</body>
</html>