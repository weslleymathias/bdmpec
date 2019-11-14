<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoadministrador.php";
  ?>
  <link rel="stylesheet" type="text/css" href="css/Area_Administração.css">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Módulo de Revisão</title>

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
          <!-- /.container -->
        </nav>


        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>Área Administrativa: Módulo de Revisão<span class="pull-right label label-default">:)</span></legend>

<?php
session_start();
error_reporting(0);

include "mysqlconecta.php";
header('Content-Type: text/html; charset=ISO-8859-1');

$busca_padrao = "SELECT DISTINCT titulo, nome_produto, data_defesa, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, situacao, cont_id FROM ((((((( pessoa JOIN esta_associado ON pessoa.id_pessoa = esta_associado.id_pessoa) JOIN produto_mpec ON esta_associado.id_produto = produto_mpec.id_produto) JOIN dissertacao ON produto_mpec.id_dissertacao = dissertacao.id_dissertacao) JOIN associado ON produto_mpec.id_produto = associado.id_produto) JOIN area_concentracao ON associado.id_areaconc = area_concentracao.id_areaconc) JOIN nivel_produto ON produto_mpec.id_produto = nivel_produto.id_produto) JOIN nivel_de_ensino ON nivel_produto.id_nivel = nivel_de_ensino.id_nivel), serie_produto, serie_de_destino WHERE serie_produto.id_serie = serie_de_destino.id_serie AND produto_mpec.situacao = 'Em Análise' ";
$busca_query = mysql_query($busca_padrao)or die(mysql_error());

if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
  echo "<div class=\"page-header\" align=\"center\">
  <p><b>Não há novos produtos para serem revisados.</b><br \>
  <a href=\"revisao.php\" class=\"btn btn-primary\">Voltar</a></p><br \>
  </div>";
}

require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'bdmpec@iceb.ufop.br'); // <-- Insira aqui o seu GMail
define('GPWD', 'wgatTpcWCpUjyQ9');    // <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
  global $error;
  $mail = new PHPMailer();
  $mail->IsSMTP();    // Ativar SMTP
  $mail->SMTPDebug = 0;   // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
  $mail->SMTPAuth = true;   // Autenticação ativada
  $mail->SMTPSecure = 'tls';  // SSL REQUERIDO pelo GMail
  $mail->Host = 'smtp.ufop.br'; // SMTP utilizado
  $mail->Port = 25;     // A porta 587 deverá estar aberta em seu servidor
  $mail->Username = GUSER;
  $mail->Password = GPWD;
  $mail->SetFrom($de, $de_nome);
  $mail->Subject = $assunto;
  $mail->Body = $corpo;
  $mail->AddAddress($para);
  if(!$mail->Send()) {
    $error = 'Mail error: '.$mail->ErrorInfo; 
    return false;
  } else {
    $error = 'Mensagem enviada!';
    return true;
  }
}

echo "<div class=\"container\">
<div class=\"row\">

<div class=\"col-lg-12\">";

while ($dados = mysql_fetch_array($busca_query)) {
  $nova_data = date("d-m-Y", strtotime($dados['data_defesa']));

  $id_cont = $dados['cont_id'];
  $idprod = $dados[7];
  $busca2 = mysql_query("SELECT DISTINCT categoria FROM produto_mpec, pmpec_tipo, tipo WHERE $idprod = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo")or die(mysql_error());
  
  $categ = " ";
  while ($dados2 = mysql_fetch_array($busca2)) {  
    $categ = $categ . $dados2['categoria'] . "; ";
  }

  $iddis = $dados[8];
  $busca3 = mysql_query("SELECT DISTINCT palavra FROM produto_mpec, dissertacao, dissert_palavra, palavra_chave WHERE $iddis = dissertacao.id_dissertacao AND dissertacao.id_dissertacao = dissert_palavra.id_dissertacao AND  dissert_palavra.id_palavra = palavra_chave.id_palavra")or die(mysql_error());
  
  $palavra = " ";
  while ($dados3 = mysql_fetch_array($busca3)) {  
    $palavra = $palavra . $dados3['palavra'] . "; ";
  }

  $busca4 = mysql_query("SELECT DISTINCT serie_de_destino FROM produto_mpec, serie_produto, serie_de_destino WHERE $idprod = produto_mpec.id_produto AND $idprod = serie_produto.id_produto AND serie_produto.id_serie = serie_de_destino.id_serie")or die(mysql_error());
  $serie = " ";
  while ($dados4 = mysql_fetch_array($busca4)) {
   $serie = $serie . $dados4['serie_de_destino'] . "; ";
 }

 $busca5 = mysql_query("SELECT DISTINCT nivel_de_ensino FROM produto_mpec, nivel_produto, nivel_de_ensino WHERE $idprod = produto_mpec.id_produto AND $idprod = nivel_produto.id_produto AND nivel_produto.id_nivel = nivel_de_ensino.id_nivel")or die(mysql_error());
 $nivel = " ";
 while ($dados5 = mysql_fetch_array($busca5)) {
   $nivel = $nivel . $dados5['nivel_de_ensino'] . "; ";
 }

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
 <input type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\" value=\"Fechar\">
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

 echo "<form method=post>
 <button type=\"submit\" class=\"btn btn-danger\" name=\"Recusar\" id=\"Recusar\" value=\"Recusar\"><span class=\"glyphicon glyphicon-remove\"></span> Recusar</button>
 <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
 <input type=\"hidden\" class=\"form-control\" name=\"id_cont\" id=\"id_cont\" value=\"$id_cont\"required>
 <input type=\"hidden\" class=\"form-control\" name=\"nprod\" id=\"nprod\" value=\"$dados[nome_produto]\"required>
 <button type=\"submit\" class=\"btn btn-success\" name=\"Aceitar\" id=\"Aceitar\" value=\"Aceitar\"><span class=\"glyphicon glyphicon-ok\"></span> Aceitar</button>
 </form>

 <br>";
}


if(isset($_POST['Recusar'])){
  $id_produto = $_POST['idprod'];
  $idcont = $_POST['id_cont'];
  $nome_produto = $_POST['nprod'];

  $inserir_query = "UPDATE produto_mpec SET situacao = 'Rejeitado' WHERE id_produto = '$id_produto' ";
  mysql_query($inserir_query) or die(mysql_error());

  $busca_contribuidor = mysql_query("SELECT cont_nome, cont_email FROM usu_contribuidor WHERE cont_id = '$idcont'")or die(mysql_error());
  if ($dados_contribuidor = mysql_fetch_array($busca_contribuidor)) {
    $nome_contribuidor = $dados_contribuidor['cont_nome'];
    $email_contribuidor = $dados_contribuidor['cont_email'];
  }
  $Vai = "Olá $nome_contribuidor,\n\nO produto \"$nome_produto\" cadastrado por você na BDMPEC foi rejeitado. Acesse o site da BDMPEC para verificar a situação do seu produto e fazer novas submissões.\n\nAdministração BDMPEC";
  if(smtpmailer($email_contribuidor, 'bdmpec@iceb.ufop.br', 'BDMPEC', 'Produto Rejeitado', $Vai)){
    echo "<script>location.href='finalizar_recusar_produto.php';</script>";
  }
  

} elseif (isset($_POST['Aceitar'])) {
  $id_produto = $_POST['idprod'];
  $idcont = $_POST['id_cont'];
  $nome_produto = $_POST['nprod'];

  $inserir_query = "UPDATE produto_mpec SET situacao = 'Aceito' WHERE id_produto = '$id_produto' ";
  mysql_query($inserir_query) or die(mysql_error());

  $busca_contribuidor = mysql_query("SELECT cont_nome, cont_email FROM usu_contribuidor WHERE cont_id = '$idcont'")or die(mysql_error());
  if ($dados_contribuidor = mysql_fetch_array($busca_contribuidor)) {
    $nome_contribuidor = $dados_contribuidor['cont_nome'];
    $email_contribuidor = $dados_contribuidor['cont_email'];
  }
  $Vai = "Olá $nome_contribuidor,\n\nO produto \"$nome_produto\" cadastrado por você na BDMPEC foi aceito. Acesse o site da BDMPEC para verificar a situação do seu produto e o mesmo já está disponível para consulta pelos demais usuários da BDMPEC.\n\nAdministração BDMPEC";
  if(smtpmailer($email_contribuidor, 'bdmpec@iceb.ufop.br', 'BDMPEC', 'Produto Aceito', $Vai)){
    echo "<script>location.href='finalizar_aceitar_produto.php';</script>"; 
  }

}


function limitarTexto($texto, $limite){
  if (strlen($texto) > $limite){
    $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
  }
  return $texto;
}

?>