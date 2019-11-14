<!DOCTYPE html>
<html lang="en">

<head>
    <?php  
    include "sessaoadministrador.php";
    ?>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Encaminhar Email Avaliador</title>

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
        </nav>
        <?php
        session_start(); 
        error_reporting(0);

        include "mysqlconecta.php";
        header('Content-Type: text/html; charset=ISO-8859-1');


        $idava = $_SESSION['idava'];
        $email = $_SESSION['AdmEmail'];
        $de = $email;
//echo "$email<br \>";

        echo "<div class=\"container\">
        <div class=\"row\">

        <div class=\"col-lg-12\">
        <legend>Área Administrativa - Avaliadores Cadastrados: Encaminhar Email<span class=\"pull-right label label-default\">:)</span></legend>";


$busca_query = "SELECT usu_email FROM usu_avaliador WHERE $idava = ava_id";
$busca = mysql_query($busca_query) or die(mysql_error());
while ($dados = mysql_fetch_array($busca)) { 
    $emailava = $dados[0];
    echo "<form name=\"form1\" method=\"post\">
    <div class=\"col-md-4\">
    <div class=\"col-lg-12\">
    <div class=\"form-group\">
    <label for=\"recipient-name\" class=\"control-label\">Para:</label>
    <input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\" value=\"$dados[0]\" required>
    </div>
    <div class=\"control-group\">
    <label class=\"control-label\" for=\"textarea\">Mensagem:</label>
    <div class=\"controls\">                     
    <textarea name=\"mensagem\" cols=\"50\" rows=\"5\" id=\"mensagem\" required></textarea>
    </div>
    </div>
    <br />
    <button type=\"button\" class=\"btn btn-default\" onclick=\"window.location.href='avaliadores_cadastrados.php'\">Cancelar</button>
    <input type=\"submit\" class=\"btn btn-primary\" name=\"Confirmar\" id=\"Confirmar\" value=\"Enviar\">
    </div>
    </div>
    </form>";
}
if (isset($_POST['Confirmar'])) {
    $Vai = "\nEmail encaminhado por $email :\n\n$_POST[mensagem]\n";

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

if (smtpmailer($emailava, 'bdmpec@iceb.ufop.br', 'BDMPEC', 'Email da Administração', $Vai)) {

   echo "<script>location.href='finalizar_encaminhar_email_avaliador.php';</script>";
 // echo '<p><font face="Tahoma" color="##000000"><span style="font-size:11pt;"><b>Sua mensagem foi enviada com sucesso!</b></span></font></p>';
//  echo '<font face="Tahoma" color="##000000"><span style="font-size:10pt;">Em breve entraremos em contato com você! Obrigado! </span></font></p>';

}
if (!empty($error)) echo $error;
} 

echo " </div>
</div>
</div>";

?>
</body>
</html>