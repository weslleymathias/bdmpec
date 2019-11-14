 <?php
 error_reporting(0);


 include "mysqlconecta.php";
 header('Content-Type: text/html; charset=ISO-8859-1');

 $Email = $_POST['email'];
 $busca_query = mysql_query("SELECT usu_email, usu_senha FROM usu_administrador WHERE usu_email = '$Email' ")or die(mysql_error()); 
  if (mysql_num_rows($busca_query) == 0) { //Se nao achar nada, lança essa mensagem
    echo file_get_contents('esquecisenhaadministrador.html');
    echo "<div class=\"page-header\" align=\"center\">
    <font color=\"red\"><p><b>Email inválido. Insira um email existente!</b></font><br \>
    </div>";     
    echo "<hr>";
  } 
  if ($dados = mysql_fetch_array($busca_query)) {
    if(($dados['usu_email'] != NULL)){
     $Vai = "Sua senha de email para a BDMPEC é: $dados[usu_senha].";

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
      if (smtpmailer($Email, 'bdmpec@iceb.ufop.br', 'BDMPEC', 'Senha de acesso BDMPEC', $Vai)) {
        echo "<script>location.href='enviarsenha.html';</script>";

      }
      if (!empty($error)) echo $error;
    }

  }
  ?>