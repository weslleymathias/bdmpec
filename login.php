<?php
session_start(); 

 error_reporting(0);


 include "mysqlconecta.php";
 header('Content-Type: text/html; charset=ISO-8859-1');

 $Email = $_POST['email'];
 $Senha = $_POST['senha'];
 $busca_query = mysql_query("SELECT usu_email, usu_senha, ava_id FROM usu_avaliador WHERE usu_email = '$Email' AND usu_senha = '$Senha' ")or die(mysql_error());
  if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lan�a essa mensagem
    echo file_get_contents('Servico_Avaliacao.html');
    echo "<div class=\"page-header\" align=\"center\">
    <font color=\"red\"><p><b>Login inv�lido. Insira um login existente!</b></font><br \>
    </div>";     
    echo "<hr>";
  } 
  if ($dados = mysql_fetch_array($busca_query)) {
    if(($dados['usu_email'] != NULL) && ($dados['usu_senha'] != NULL)){
     $resultado = mysql_fetch_assoc($query);
     if (!isset($_SESSION)) session_start();
	// Salva os dados encontrados na sess�o
     $_SESSION['UsuarioEmail'] = $Email;
     $_SESSION['UsuarioSenha'] = $Senha;
     $_SESSION['AvaliadorId'] = $dados['ava_id'];
   // echo $_SESSION['UsuarioEmail'];
   // echo $_SESSION['UsuarioSenha'];
     header ("location: Area_Avaliador.php");
   }
 }
 ?>