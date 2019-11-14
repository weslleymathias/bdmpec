<?php

error_reporting(0);

include "mysqlconecta.php";
header('Content-Type: text/html; charset=ISO-8859-1');

$Email = $_POST['email'];

$busca_query = mysql_query("SELECT nome, email FROM pessoa WHERE pessoa.email = '$Email' AND papel = 'autor' ")or die(mysql_error()); 
if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
  echo file_get_contents('login_autor.html');
  echo "<div class=\"page-header\" align=\"center\">
  <font color=\"red\"><p><b>Email inválido. Insira um email existente!</b></font><br \>
  </div>";     
  echo "<hr>";
} 
if ($dados = mysql_fetch_array($busca_query)) {
 if($dados['email'] != NULL){
   $resultado = mysql_fetch_assoc($busca_query);
   if (!isset($_SESSION)) session_start();
	// Salva os dados encontrados na sessão
   $_SESSION['UsuarioNome'] = $dados['nome'];
   $_SESSION['UsuarioEmail'] = $dados['email'];
   // echo " $_SESSION[UsuarioEmail]";
   // echo " $_SESSION[UsuarioSenha]";
   echo "<script>location.href='area_autor.php';</script>";
  // header ("location: Area_Autor.html");
 }
}
?>