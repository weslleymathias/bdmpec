  <?php
  session_start(); 

  error_reporting(0);


  include "mysqlconecta.php";
  header('Content-Type: text/html; charset=ISO-8859-1');

  $Email = $_POST['email'];
  $Senha = $_POST['senha'];
  $busca_query = mysql_query("SELECT cont_email, cont_senha, cont_id FROM usu_contribuidor WHERE cont_email = '$Email' AND cont_senha = '$Senha' ")or die(mysql_error()); 
  if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
    echo file_get_contents('Servico_Autoarquivamento.html');
    echo "<div class=\"page-header\" align=\"center\">
    <font color=\"red\"><p><b>Login inválido. Insira um login existente!</b></font><br \>
    </div>";     
    echo "<hr>";
  } 
  if ($dados = mysql_fetch_array($busca_query)) {
    if(($dados['cont_email'] != NULL) && ($dados['cont_senha'] != NULL)){
     $resultado = mysql_fetch_assoc($query);
     if (!isset($_SESSION)) session_start();
	// Salva os dados encontrados na sessão
     $_SESSION['ContEmail'] = $Email;
     $_SESSION['ContSenha'] = $Senha;
     $_SESSION['ContribuidorId'] = $dados['cont_id'];
   // echo $_SESSION['UsuarioEmail'];
   // echo $_SESSION['UsuarioSenha'];
     header ("location: Area_Contribuidor.php");
   } 
 }
 ?>
</body>
</html>