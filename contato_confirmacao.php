<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    ?>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contato</title>

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

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                   <?php 
                   $Nome = "Nome: ".$_POST['nome']." \n";
                   $Email = "Email: ".$_POST['email']." \n";
                   $Assunto = "Assunto: ".$_POST['assunto']." \n";
                   $Mensagem = "Mensagem:". $_POST['mensagem'];


                   $Vai = "$Nome\n\n$Email\n\n$Assunto\n\n$Mensagem\n";

                   require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'bdmpec@iceb.ufop.br');	// <-- Insira aqui o seu GMail
define('GPWD', 'wgatTpcWCpUjyQ9');		// <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.ufop.br';	// SMTP utilizado
	$mail->Port = 25;  		// A porta 587 deverá estar aberta em seu servidor
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

if (smtpmailer('bdmpec@iceb.ufop.br', 'bdmpec@iceb.ufop.br', $Nome, $Assunto, $Vai)) {
	echo "<legend>Entre em contato com a BDMPEC</legend>";
	echo "<div class=\"page-header\" align=\"center\">";
	echo '<p><font face="Tahoma" color="##000000"><span style="font-size:11pt;"><b>Sua mensagem foi enviada com sucesso!</b></span></font></p>';
	echo '<font face="Tahoma" color="##000000"><span style="font-size:10pt;">Em breve entraremos em contato com você! Obrigado! </span></font></p>';
	echo "<a href=\"index.html\" class=\"btn btn-primary\">Voltar</a><br \>";
	echo "</div>";
}
//if (!empty($error)) echo $error;

/*

echo '<p><font face="Tahoma" color="##000000"><span style="font-size:11pt;"><b>Sua mensagem foi 
enviada com sucesso!</b></span></font></p>';

echo '<font face="Tahoma" color="##000000"><span style="font-size:10pt;">Em breve 
entraremos em contato com você! Obrigado! </span></font></p>';
*/
?>
</div>
</div>
</div>
</body>
</html>
