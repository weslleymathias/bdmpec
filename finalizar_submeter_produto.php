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

    <title>Submeter Produto</title>

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
        <?php
        session_start(); 
        error_reporting(0);

        include "mysqlconecta.php";
        header('Content-Type: text/html; charset=ISO-8859-1');

        $idprod = $_POST['idprod'];
        $id_cont = $_SESSION['ContribuidorId'];

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

$busca_contribuidor = mysql_query("SELECT cont_nome FROM usu_contribuidor WHERE cont_id = '$id_cont'")or die(mysql_error());
if ($dados_contribuidor = mysql_fetch_array($busca_contribuidor)) {
    $nome_contribuidor = $dados_contribuidor['cont_nome'];
}

$busca_administrador = mysql_query("SELECT usu_nome, usu_email FROM usu_administrador")or die(mysql_error());
while ($dados_administrador = mysql_fetch_array($busca_administrador)) {
    $nome_administrador = $dados_administrador['usu_nome'];
    $email_administrador = $dados_administrador['usu_email'];
    $Vai = "Olá $nome_administrador,\n\nUm novo produto foi cadastrado na BDMPEC por $nome_contribuidor. Por favor, acesse o site da BDMPEC para poder revisá-lo.\n\nAdministração BDMPEC";
  /*  if(smtpmailer($email_administrador, 'bdmpec@iceb.ufop.br', 'BDMPEC', 'Novo Produto Cadastrado', $Vai))
    {

    }*/
}



                        //inserindo apostila
$formato = $_POST['formato_apostila'];
$paginas = $_POST['paginas'];
                        //    echo "$id_prod<br>$formato<br>$paginas<br>";
if ($formato != NULL) { 
    $inserir_categoria = "INSERT INTO apostila(id_produto, formato, paginas) VALUES('$idprod', '$formato', '$paginas') ";
    mysql_query($inserir_categoria) or die(mysql_error());
}

                        //inserindo apresentacao
$formato_apresentacao = $_POST['formato_apresentacao'];
$num_slides = $_POST['num_slides'];

if ($formato_apresentacao != NULL) {
    $inserir_apresentacao = "INSERT INTO apresentacao_digital(id_produto, formato, numero_slides) VALUES('$idprod', '$formato_apresentacao', '$num_slides') ";
    mysql_query($inserir_apresentacao) or die(mysql_error());
}

        //inserindo cartilha
$assuntos = $_POST['assuntos'];
$num_paginas = $_POST['num_paginas'];
if($assuntos != NULL){
    $inserir_cartilha = "INSERT INTO cartilha(id_produto, assuntos_abordados, numero_paginas) VALUES ('$idprod', '$assuntos', '$num_paginas') ";
    mysql_query($inserir_cartilha) or die(mysql_error());
}

                        //inserindo possui e pré-requisitos do curso
$descricao = $_POST['pre_requisito'];

foreach ($descricao as &$value) {
    $buscar_descricao = "SELECT id_requisitos FROM pre_requisito WHERE descricao = '$value' ";
    $busca_descricao = mysql_query($buscar_descricao)or die(mysql_error());

    if(mysql_num_rows($busca_descricao) == 0){
        $inserir_descricao = "INSERT INTO pre_requisito(id_requisitos, descricao) VALUES(NULL, '$value') ";
        mysql_query($inserir_descricao) or die(mysql_error());

        $buscar_descricao2 = "SELECT id_requisitos FROM pre_requisito WHERE descricao = '$value' ";
        $busca_descricao2 = mysql_query($buscar_descricao2)or die(mysql_error());

        if ($dados_descricao = mysql_fetch_array($busca_descricao2)) {
            $idreq = $dados_descricao['id_requisitos'];
            $inserir_possui = mysql_query("INSERT INTO possui(id_produto, id_requisitos) VALUES('$idprod', '$idreq') ") or die(mysql_error());
        }

    }
    elseif ($dados_descricao = mysql_fetch_array($busca_descricao)) {
        $idreq = $dados_descricao['id_requisitos'];
        $$inserir_possui = mysql_query("INSERT INTO possui(id_produto, id_requisitos) VALUES('$idprod', '$idreq') ") or die(mysql_error());
    }
    
                    //    echo "Descrição: $value <br />";
}

                        //inserindo hipertexto
$formato_hipertexto = $_POST['formato_hipertexto'];
if ($formato_hipertexto != NULL) {
    $inserir_hipertexto = "INSERT INTO hipertexto(id_produto, formato) VALUES('$idprod', '$formato_hipertexto') ";
    mysql_query($inserir_hipertexto) or die(mysql_error());
}

                        //inserindo jogo
$tipo_jogo = $_POST['tipo_jogo'];
$genero_jogo = $_POST['genero_jogo'];
$numero_jogadores = $_POST['numero_jogadores'];
$categoria_jogo = $_POST['categoria_jogo'];
$plataforma = $_POST['plataforma'];
if ($tipo_jogo != NULL) {
    $inserir_jogo = "INSERT INTO jogo(id_produto, tipo, genero, numero_jogadores) VALUES('$idprod', '$genero_jogo', '$categoria_jogo', '$numero_jogadores') ";
    mysql_query($inserir_jogo) or die(mysql_error());
                        //    echo "$categoria_jogo<br>";
                        //    echo "$idprod<br>";
                        //    echo "$plataforma<br>";
    if ($categoria_jogo == 'Jogo Digital') {
                            //    echo "teste<br>";
        $insesir_categ_jogo = mysql_query("INSERT INTO jogo_digital(id_produto, plataforma) VALUES('$idprod', '$plataforma') ") or die(mysql_error());
    }
    elseif ($categoria_jogo == 'Jogo de Tabuleiro') {
                            //    echo "teste2<br>";
        $insesir_categ_jogo = mysql_query("INSERT INTO jogo_tabuleiro(id_produto) VALUES('$idprod') ") or die(mysql_error());
    }
}

                        //inserindo livro
$formato_livro = $_POST['formato_livro'];
$paginas_livro = $_POST['paginas_livro'];
if ($formato_livro != NULL) {
    $inserir_livro = "INSERT INTO livro_paradidatico(id_produto, formato, paginas) VALUES('$idprod', '$formato_livro', '$paginas_livro') ";
    mysql_query($inserir_livro) or die(mysql_error());
}

                        //inserindo hipermídia
$tipo_midia = $_POST['tipo_midia'];
$tamanho_midia = $_POST['tamanho_midia'];
$formato_midia = $_POST['formato_midia'];
if ($tipo_midia != NULL) {
    $inserir_midia = "INSERT INTO hipermidia(id_produto, tipo, tamanho, formato) VALUES('$idprod', '$tipo_midia', '$tamanho_midia', '$formato_midia') ";
    mysql_query($inserir_midia) or die(mysql_error());
}

        //inserindo modelo
$modelo_descricao = $_POST['modelo_descricao'];
$modelo_especificidades = $_POST['modelo_especificidades'];
if ($modelo_descricao != NULL) {
    $inserir_modelo = "INSERT INTO modelo_educacional(id_produto, descricao, especificidades) VALUES ('$idprod', '$modelo_descricao', '$modelo_especificidades') ";
    mysql_query($inserir_modelo) or die(mysql_error());
}


        //inserindo objeto
$objeto_descricao = $_POST['objeto_descricao'];
$objeto_especificidades = $_POST['objeto_especificidades'];
if ($objeto_descricao != NULL) {
    $inserir_objeto = "INSERT INTO objeto_ensino(id_produto, descricao, especificidades) VALUES ('$idprod', '$objeto_descricao', '$objeto_especificidades') ";
    mysql_query($inserir_objeto) or die(mysql_error());
}


                        //inserindo oficina
$numero_encontros = $_POST['numero_encontros'];
$publico_alvo = $_POST['publico_alvo'];
if ($numero_encontros != NULL) {
    $inserir_oficina = "INSERT INTO oficina(id_produto, numero_encontros, publico_alvo) VALUES('$idprod', '$numero_encontros', '$publico_alvo') ";
    mysql_query($inserir_oficina) or die(mysql_error());
}

                        //inserindo página web
$tipo_pagina = $_POST['tipo_pagina'];
if ($tipo_pagina != NULL) {
    $inserir_pagina = "INSERT INTO pagina_web(id_produto, tipo) VALUES('$idprod', '$tipo_pagina') ";
    mysql_query($inserir_pagina) or die(mysql_error());
}

                        //inserindo palestra
$numero_encontros_palestra = $_POST['numero_encontros_palestra'];
$publico_alvo_palestra = $_POST['publico_alvo_palestra'];
if ($numero_encontros_palestra != NULL) {
    $inserir_palestra = "INSERT INTO palestra(id_produto, numero_encontros, publico_alvo) VALUES('$idprod', '$numero_encontros_palestra', '$publico_alvo_palestra') ";
    mysql_query($inserir_palestra) or die(mysql_error());
}

                        //inserindo proposta de disciplina
$periodo = $_POST['periodo'];
$descricao_ementa = $_POST['descricao_ementa'];
if ($periodo != NULL && $descricao_ementa != NULL) {
    $inserir_proposta = "INSERT INTO proposta_disciplina(id_produto, periodo) VALUES('$idprod', '$periodo') ";
    mysql_query($inserir_proposta) or die(mysql_error());
    $inserir_ementa = "INSERT INTO ementa(id_produto, descricao) VALUES('$idprod', '$descricao_ementa') ";
    mysql_query($inserir_ementa) or die(mysql_error());
}

        //inserindo prototipo
$prototipo_descricao = $_POST['prototipo_descricao'];
$prototipo_especificidades = $_POST['prototipo_especificidades'];
if ($prototipo_descricao != NULL) {
    $inserir_prototipo = "INSERT INTO prototipo(id_produto, descricao, especificidades) VALUES ('$idprod', '$prototipo_descricao', '$prototipo_especificidades') ";
    mysql_query($inserir_prototipo) or die(mysql_error());
}


                        //inserindo sequência didática
$numero_aulas = $_POST['numero_aulas'];
if ($numero_aulas != NULL) {
    $inserir_sequencia = "INSERT INTO sequencia_didatica(id_produto, numero_aulas) VALUES('$idprod', '$numero_aulas') ";
    mysql_query($inserir_sequencia) or die(mysql_error());
}



?>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <legend>Área do Contribuidor: Submeter Produto<span class="pull-right label label-default">:)</span></legend>
            <div class="page-header" align="center">
                <p>Submissão finalizada com sucesso!</p>
                <a href="submeter_produto.php" class="btn btn-primary">Submeter um novo produto</a><br \>
            </div>
        </div>
    </div>
</div>

</body>

</html>