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

  <title>Produtos submetidos</title>

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
              <legend>Área do Contribuidor: Produtos Submetidos<span class="pull-right label label-default">:)</span></legend>
              


<?php
session_start(); 
error_reporting(0);

include "mysqlconecta.php";
header('Content-Type: text/html; charset=ISO-8859-1');

$tipo = $_POST['tipo'];
$area = $_POST['area'];


$id_cont = $_SESSION['ContribuidorId'];

$busca_padrao = "SELECT DISTINCT titulo, nome_produto, data_defesa, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, situacao FROM ((((((( pessoa JOIN esta_associado ON pessoa.id_pessoa = esta_associado.id_pessoa) JOIN produto_mpec ON esta_associado.id_produto = produto_mpec.id_produto) JOIN dissertacao ON produto_mpec.id_dissertacao = dissertacao.id_dissertacao) JOIN associado ON produto_mpec.id_produto = associado.id_produto) JOIN area_concentracao ON associado.id_areaconc = area_concentracao.id_areaconc) JOIN nivel_produto ON produto_mpec.id_produto = nivel_produto.id_produto) JOIN nivel_de_ensino ON nivel_produto.id_nivel = nivel_de_ensino.id_nivel), serie_produto, serie_de_destino WHERE serie_produto.id_serie = serie_de_destino.id_serie AND produto_mpec.cont_id = '$id_cont'";

//$busca_padrao = "SELECT * FROM Novo_Produto WHERE Novo_Produto.cont_id = '$id_cont' ";

if ($tipo != 'Todos') {
  if ($tipo == 'Aceito') {
    $busca_padrao = $busca_padrao . "AND situacao = '$tipo' ";
  }
  elseif ($tipo == 'Rejeitado') {
    $busca_padrao = $busca_padrao . "AND situacao = '$tipo' ";
  }
  elseif ($tipo == 'Em Análise') {
    $busca_padrao = $busca_padrao . "AND situacao = '$tipo' ";
  }
}
if($area != 'Todas'){
  if($area == 'Física'){
    $busca_padrao = $busca_padrao . "AND associado.id_areaconc = 2 ";
  }
  elseif ($area == 'Biologia'){
    $busca_padrao = $busca_padrao . "AND associado.id_areaconc = 3 ";
  }
  elseif ($area == 'Química'){
    $busca_padrao = $busca_padrao . "AND associado.id_areaconc = 4 ";
  }
}

$busca_query = mysql_query($busca_padrao)or die(mysql_error());

if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
  echo "<div class=\"page-header\" align=\"center\">
  <p><b>Não há produtos avaliados segundo os critérios de busca.</b><br \>
  <a href=\"produtos_submetidos.php\" class=\"btn btn-primary\">Voltar</a></p><br \>
  </div>";
}

while ($dados = mysql_fetch_array($busca_query)) {


  $nova_data = date("d-m-Y", strtotime($dados['data_defesa']));

  $idprod = $dados[7];
  $busca2 = mysql_query("SELECT DISTINCT categoria FROM produto_mpec, pmpec_tipo, tipo WHERE $idprod = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo")or die(mysql_error());
  
  $categ = " ";
  while ($dados2 = mysql_fetch_array($busca2)) {  
    $categ = $categ . $dados2['categoria'] . "; ";
  }
  $categ = substr($categ, 0, -2);

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

 $descricao = limitarTexto($dados['descricao_geral'], 300);

 echo "<a href=\"\" data-toggle=\"modal\" data-target=\"#$dados[8]\"><b><u> <font color=\"#0000FF\" size=\"4\">$dados[nome_produto]</font></u></b><br /></a>
 <i class=\"glyphicon glyphicon-user\"></i><b> Autor:</b> $autor <br />
 <i class=\"glyphicon glyphicon-list-alt\"></i><b> Descrição Geral:</b> $descricao  <br />
 <b>Situação: <font color=\"red\">$dados[10] </b></font><br />
 
 <tr>
 
 <td><!-- Button trigger modal -->
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
 <hr>
 <b>Situação:</b> $dados[10]<br />
 </div>

 <div class=\"modal-footer\">
 <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fechar</button>
 <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
 <input type=\"hidden\" class=\"form-control\" name=\"dprod\" id=\"dprod\" value=\"$dados[link_produto]\"required>
 <input type=\"hidden\" class=\"form-control\" name=\"ddis\" id=\"ddis\" value=\"$dados[link_dissertacao]\"required>
 <a href=\"downloadproduto.php?id=$idprod\" class=\"btn btn-primary\" name=\"downprod\" id=\"downprod\" target=\"_blank\">Acesso ao Produto</a>
 <a href=\"downloaddissertacao.php?id=$iddis\" class=\"btn btn-primary\" name=\"downdis\" id=\"downdis\" target=\"_blank\">Acesso a Dissertação</a>

 </div>
 </div>
 </div>
 </div></td>
 </tr>";

}

function limitarTexto($texto, $limite){
  if (strlen($texto) > $limite){
    $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
  }
  return $texto;
}

?>
</div>
</div>
</div>
</body>
</html>