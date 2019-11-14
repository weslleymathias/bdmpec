<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
	<?php 
	error_reporting(0);

	include "mysqlconecta.php";
    header('Content-Type: text/html; charset=ISO-8859-1');

	$Nome = $_POST['nome'];
	$Email = $_POST['email'];
	$IES = $_POST['ies'];
	$ies0 = $_POST['ies0'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$campus = $_POST['campus'];
	$Curso = $_POST['curso'];
	$Lattes = $_POST['lattes'];
	$Senha = $_POST['senha'];
    $Confsenha = $_POST['confsenha'];
    $assunto = 'Novo avaliador';
    $de = $_POST['email'];

    if ($Senha != $Confsenha) {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">

        <title>Submeter Produto</title>

        <!-- Bootstrap Core CSS -->
        <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

        <!-- Custom CSS -->
        <link href=\"css/logo-nav.css\" rel=\"stylesheet\">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->
        <link rel=\"stylesheet\" type=\"text/css\" href=\"css/Acesso_Acervo.css\">
        <script src=\"http://code.jquery.com/jquery-latest.min.js\" type=\"text/javascript\"></script>
        <!-- jQuery -->
        <script src=\"js/jquery.js\"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src=\"js/bootstrap.min.js\"></script>
        </head>
        <body>

        <!-- Navigation -->
        <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
        <div class=\"container\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        </button>
        <a class=\"navbar-brand\" href=\"#\">
        <img src=\"img/logompec.png\" alt=\"\">
        </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
        <ul class=\"nav navbar-nav\">
        <li>
        <a href=\"index.html\">Início</a>
        </li>
        <li>
        <a href=\"Acesso_Acervo.html\">Acesso ao Acervo</a>
        </li>
        <li>
        <a href=\"Servico_Avaliacao.html\">Serviço de Avaliação</a>
        </li>
        <li>
        <a href=\"Servico_Autoarquivamento.html\">Autoarquivamento</a>
        </li>
        <li>
        <a href=\"Sobre a Biblioteca.html\">Sobre a Biblioteca</a>
        </li>
        <li>
        <a href=\"Administracao.html\">Administração</a>
        </li>
        <li>
        <a href=\"Contato.html\">Contato</a>
        </li>
        </ul>
        </div>
        <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
        </nav>";
        echo "<div class=\"page-header\" align=\"center\">
        <font color=\"red\"><p><b>Insira duas senhas iguais!</b></font><br \>
        <a href=\"cadastro_avaliador.php\" class=\"btn btn-primary\">Voltar</a><br \> </div>";    
        echo "<hr></body></html>";
    }


$busca_query = mysql_query("SELECT usu_email FROM usu_avaliador WHERE usu_email = '$Email' ")or die(mysql_error());
if ($dados = mysql_fetch_array($busca_query)) {
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <title>Submeter Produto</title>

    <!-- Bootstrap Core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom CSS -->
    <link href=\"css/logo-nav.css\" rel=\"stylesheet\">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
    <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/Acesso_Acervo.css\">
    <script src=\"http://code.jquery.com/jquery-latest.min.js\" type=\"text/javascript\"></script>
    <!-- jQuery -->
    <script src=\"js/jquery.js\"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src=\"js/bootstrap.min.js\"></script>
    </head>
    <body>

    <!-- Navigation -->
    <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
    <div class=\"container\">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class=\"navbar-header\">
    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
    <span class=\"sr-only\">Toggle navigation</span>
    <span class=\"icon-bar\"></span>
    <span class=\"icon-bar\"></span>
    <span class=\"icon-bar\"></span>
    </button>
    <a class=\"navbar-brand\" href=\"#\">
    <img src=\"img/logompec.png\" alt=\"\">
    </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
    <ul class=\"nav navbar-nav\">
    <li>
    <a href=\"index.html\">Início</a>
    </li>
    <li>
    <a href=\"Acesso_Acervo.html\">Acesso ao Acervo</a>
    </li>
    <li>
    <a href=\"Servico_Avaliacao.html\">Serviço de Avaliação</a>
    </li>
    <li>
    <a href=\"Servico_Autoarquivamento.html\">Autoarquivamento</a>
    </li>
    <li>
    <a href=\"Sobre a Biblioteca.html\">Sobre a Biblioteca</a>
    </li>
    <li>
    <a href=\"Administracao.html\">Administração</a>
    </li>
    <li>
    <a href=\"Contato.html\">Contato</a>
    </li>
    </ul>
    </div>
    <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
    </nav>";
    echo "<div class=\"page-header\" align=\"center\">
    <font color=\"red\"><p><b>Email já cadastrado no sistema!</b></font><br \>
    <a href=\"cadastro_avaliador.php\" class=\"btn btn-primary\">Voltar</a><br \> </div>";    
    echo "<hr></body></html>";
}
else{
	//buscando ies
    if ($ies0 == 'outra') {

        $buscar_ies = "SELECT id_ies FROM ies WHERE ies.nome = '$IES' ";
        $busca_ies = mysql_query($buscar_ies)or die(mysql_error());

                        //inserindo ies
        if(mysql_num_rows($busca_ies) == 0){
            $inserir_ies = "INSERT INTO ies(id_ies, nome) VALUES(NULL, '$IES') ";
            mysql_query($inserir_ies) or die(mysql_error());

            $buscar_ies2 = "SELECT id_ies FROM ies WHERE ies.nome = '$IES' ";
            $busca_ies2 = mysql_query($buscar_ies2)or die(mysql_error());
                         //   echo "Teste01 <br />";

            if ($dados_ies = mysql_fetch_array($busca_ies2)) {
                $idies = $dados_ies['id_ies'];
            }
                         //   echo "ID IES: $idies<br />";

                            //inserindo localização
            $inserir_localizacao = "INSERT INTO localizacao(id_localizacao, rua, cidade, numero, uf, campus) VALUES(NULL, '$rua', '$cidade', '$numero', '$estado', '$campus') ";
            mysql_query($inserir_localizacao) or die(mysql_error());
                         //   echo "Teste02 <br />";

            $buscar_localizacao = "SELECT id_localizacao FROM localizacao WHERE rua = '$rua' AND cidade = '$cidade' AND numero = '$numero' AND uf = '$estado' AND campus = '$campus' ";
            $busca_localizacao = mysql_query($buscar_localizacao)or die(mysql_error());
                         //   echo "Teste03 <br />";

            if ($dados_localizacao = mysql_fetch_array($busca_localizacao)) {
                $idloc = $dados_localizacao['id_localizacao'];
                $inserir_ies_localizacao = "INSERT INTO ies_localizacao(id_ies, id_localizacao) VALUES('$idies', '$idloc') ";
                mysql_query($inserir_ies_localizacao) or die(mysql_error());
                              //  echo "Teste04 <br />";
            }
            $inserir_query = "INSERT INTO usu_avaliador(ava_id, usu_nome, usu_senha, usu_ies, usu_curso, usu_email, usu_lattes) VALUES (NULL, '$Nome', '$Senha', '$IES', '$Curso', '$Email', '$Lattes')";
            mysql_query($inserir_query) or die(mysql_error());

        }
        elseif ($dados_ies = mysql_fetch_array($busca_ies)){
            $inserir_query = "INSERT INTO usu_avaliador(ava_id, usu_nome, usu_senha, usu_ies, usu_curso, usu_email, usu_lattes) VALUES (NULL, '$Nome', '$Senha', '$IES', '$Curso', '$Email', '$Lattes')";
            mysql_query($inserir_query) or die(mysql_error());    
        }

    }else{
        $inserir_query = "INSERT INTO usu_avaliador(ava_id, usu_nome, usu_senha, usu_ies, usu_curso, usu_email, usu_lattes) VALUES (NULL, '$Nome', '$Senha', '$ies0', '$Curso', '$Email', '$Lattes')";
        mysql_query($inserir_query) or die(mysql_error());

    }

/*$Nome = "Nome: ".$_POST['nome']." \n";
$Email = "Email: ".$_POST['email']." \n";
$IES = "IES: ".$_POST['ies']." \n";
$Curso = "Curso ou Programa da IES:". $_POST['curso'];
$Lattes = "Lattes: ".$_POST['lattes']." \n";
$Senha = "Senha: ".$_POST['senha']." \n";
$assunto = 'Novo avaliador';
$de = $_POST['email'];*/


$Vai = "Nome: $Nome\n\nEmail: $Email\n\nIES: $IES\n\nCurso: $Curso\n\nLattes: $Lattes\n";

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

/*function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 587 deverá estar aberta em seu servidor
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
}*/

if (smtpmailer('bdmpec@iceb.ufop.br', $de, $Nome, $assunto, $Vai)) {
	echo "<script>location.href='finalizar_cadastro_avaliador.php';</script>";
//	echo '<p><font face="Tahoma" color="##000000"><span style="font-size:11pt;"><b>Sua mensagem foi enviada com sucesso!</b></span></font></p>';
//	echo '<font face="Tahoma" color="##000000"><span style="font-size:10pt;">Em breve entraremos em contato com você! Obrigado! </span></font></p>';

}
if (!empty($error)) echo $error;
}
/*

echo '<p><font face="Tahoma" color="##000000"><span style="font-size:11pt;"><b>Sua mensagem foi 
enviada com sucesso!</b></span></font></p>';

echo '<font face="Tahoma" color="##000000"><span style="font-size:10pt;">Em breve 
entraremos em contato com você! Obrigado! </span></font></p>';
*/
?>
</body>
</html>