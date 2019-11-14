<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoavaliador.php";
  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Formulário 5 de 5</title>

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
                <li><a href='Acesso_Acervo_Avaliador.php'><span>Avaliar Produtos</span></a></li>
                <li><a href='produtos_avaliados.php'><span>Visualizar Produtos Avaliados</span></a></li>
                <li><a href='perfil.php'><span>Editar Perfil</span></a></li>  
                <li><a href='logoutavaliador.php'><span>Sair</span></a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
        </nav>
      </body>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <?php
            session_start(); 
            error_reporting(0);

            include "mysqlconecta.php";
            header('Content-Type: text/html; charset=ISO-8859-1');

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

$email = $_SESSION['UsuarioEmail'];
$senha = $_SESSION['UsuarioSenha'];
$avaid = $_SESSION['AvaliadorId'];
$idprod = $_SESSION['id'];
$nomeprod = $_SESSION['nomeprod'];

$busca = "SELECT DISTINCT Resposta15, Resposta16, Resposta17, Resposta18 FROM resposta WHERE ava_id = $avaid AND id_produto = $idprod";
$busca_query = mysql_query($busca) or die(mysql_error());
if ($dados = mysql_fetch_array($busca_query)) {
  $resp15 = $dados['Resposta15'];
  $resp16 = $dados['Resposta16'];
  $resp17 = $dados['Resposta17'];
  $resp18 = $dados['Resposta18'];
}

function checked( $v, $d ){
  return $v===$d ? ' checked="checked"' : '';
}

          /*  echo "$resp15<br />";
            echo "$resp16<br />";
            echo "$resp17<br />";
            echo "$resp18<br />";
            echo "$email<br />";
            echo "$senha<br />";
            echo "$idprod<br />";
            echo "$avaliar<br />"; */

            echo " <form name=\"questionario\" method=\"post\" action=\"\">
            <p class=\"lead\"><strong class=\"text-danger\">Produto: $nomeprod</strong><p>
            <h3>Conclusões após a aplicação dos produtos</h3>
            <hr>

            <p><p align=\"left\">Questão 15 - Após a conclusão da atividade, foi possível identificar alguma alteração dos participantes sobre a temática apresentada. </p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest15\" value=\"Discordo fortemente\""; if($resp15 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest15\" value=\"Discordo na maior parte\""; if($resp15 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest15\" value=\"Concordo ligeiramente\""; if($resp15 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest15\" value=\"Concordo moderadamente\""; if($resp15 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest15\" value=\"Concordo na maior parte\""; if($resp15 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest15\" value=\"Concordo fortemente\""; if($resp15 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 16 - Após utilizar o produto educacional, foi possível atingir o(s) objetivo(s) proposto(s) por ele. </p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest16\" value=\"Discordo fortemente\""; if($resp16 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest16\" value=\"Discordo na maior parte\""; if($resp16 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest16\" value=\"Concordo ligeiramente\""; if($resp16 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest16\" value=\"Concordo moderadamente\""; if($resp16 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest16\" value=\"Concordo na maior parte\""; if($resp16 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest16\" value=\"Concordo fortemente\""; if($resp16 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 17 - Após a conclusão da atividade, foi possível identificar ou verificar alguma alteração conceitual, procedimental ou atitudinal nos participantes (estudantes ou docentes) sobre a temática apresentada.  </p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest17\" value=\"Discordo fortemente\""; if($resp17 == "Discordo fortemente"){echo "checked=\"\"";} echo ">Discordo fortemente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest17\" value=\"Discordo na maior parte\""; if($resp17 == "Discordo na maior parte"){echo "checked=\"\"";} echo ">Discordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest17\" value=\"Concordo ligeiramente\""; if($resp17 == "Concordo ligeiramente"){echo "checked=\"\"";} echo ">Concordo ligeiramente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest17\" value=\"Concordo moderadamente\""; if($resp17 == "Concordo moderadamente"){echo "checked=\"\"";} echo ">Concordo moderadamente</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest17\" value=\"Concordo na maior parte\""; if($resp17 == "Concordo na maior parte"){echo "checked=\"\"";} echo ">Concordo na maior parte</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest17\" value=\"Concordo fortemente\""; if($resp17 == "Concordo fortemente"){echo "checked=\"\"";} echo ">Concordo fortemente</label>
            </div>
            <hr>
            <p align=\"left\">Questão 18 - Você recomendaria alguma mudança ou alteração no produto educacional com a finalidade de melhorá-lo. </p>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest18\" value=\"Não\""; if($resp18 == "Não. "){echo "checked=\"\"";} echo ">Não</label>
            </div>
            <div class=\"radio\">
            <label><input type=\"radio\" name=\"quest18\" value=\"Sim\""; if($resp18 == "Sim. "){echo "checked=\"\"";} echo ">Sim</label>
            </div>
            <div class=\"control-group\">
            <label class=\"control-label\" for=\"textinput\">Qual?
            <input name=\"quest18a\" type=\"text\" class=\"input-xlarge\" id=\"textinput\" placeholder=\"Sugestão\" size=\"90\">
            </label>
            </div>

            <p align=\"center\">
            <input type=\"submit\" name=\"anterior\" class=\"btn btn-primary\" id=\"anterior\" value=\"<< Anterior\">
            <input type=\"submit\" name=\"salvar\" type=\"submit\" class=\"btn btn-success\" id=\"salvar\" value=\"Salvar Alterações\">
            <input type=\"submit\" name=\"concluir\" type=\"submit\" class=\"btn btn-primary\" id=\"proximo\" value=\"Concluir\"></p>

            </form> ";

            if(isset($_POST['anterior'])){
              $quest15 = $_POST['quest15'];
              $quest16 = $_POST['quest16'];
              $quest17 = $_POST['quest17'];
              $quest18 = $_POST['quest18'];
              $quest18a = $_POST['quest18a'];

              $quest18f = $quest18 . '. ' . $quest18a;

              $inserir_query = "UPDATE resposta SET Resposta15 = '$quest15', Resposta16 = '$quest16', Resposta17 = '$quest17', Resposta18 = '$quest18f', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form04.php';</script>";
            }

            if(isset($_POST['salvar'])){
              $quest15 = $_POST['quest15'];
              $quest16 = $_POST['quest16'];
              $quest17 = $_POST['quest17'];
              $quest18 = $_POST['quest18'];
              $quest18a = $_POST['quest18a'];

              $quest18f = $quest18 . '. ' . $quest18a;

              $inserir_query = "UPDATE resposta SET Resposta15 = '$quest15', Resposta16 = '$quest16', Resposta17 = '$quest17', Resposta18 = '$quest18f', data_gravacao = now() WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());
              echo "<script>location.href='form05.php';</script>";
            }

            if(isset($_POST['concluir'])){
              $quest15 = $_POST['quest15'];
              $quest16 = $_POST['quest16'];
              $quest17 = $_POST['quest17'];
              $quest18 = $_POST['quest18'];
              $quest18a = $_POST['quest18a'];

              $quest18f = $quest18 . $quest18a;

              $inserir_query = "UPDATE resposta SET Resposta15 = '$quest15', Resposta16 = '$quest16', Resposta17 = '$quest17', Resposta18 = '$quest18f', data_gravacao = now(), status = 'Pendente' WHERE ava_id = $avaid AND id_produto = $idprod";
              mysql_query($inserir_query) or die(mysql_error());

              $busca2 = "SELECT nome, email FROM pessoa, esta_associado, produto_mpec, avalia WHERE avalia.ava_id = '$avaid' AND avalia.id_produto = '$idprod' AND produto_mpec.id_produto = avalia.id_produto AND produto_mpec.id_produto = esta_associado.id_produto AND esta_associado.id_pessoa = pessoa.id_pessoa AND pessoa.papel = 'autor' ";
              $busca_query2 = mysql_query($busca2) or die(mysql_error());

              if ($dados2 = mysql_fetch_array($busca_query2)) {
                $emaila = $dados2['email'];
                $nomea = $dados2['nome'];
              }
              $Vai = "Olá $nomea,\n\nSeu produto cadastrado na BDMPEC recebeu uma avaliação. Para que a mesma seja aprovada, é necessária sua aprovação por meio do link abaixo. Acesse o link e obtenha acesso as avaliações referentes aos seus produtos cadastrados.\nhttp://www.mpec.ufop.br/bdmpec/login_autor.html\n\nAtt,\nAdministração BDMPEC.";
              if (smtpmailer($emaila, 'bdmpec@iceb.ufop.br', 'BDMPEC', 'Nova Avaliação', $Vai)) {
                echo "<script>location.href='finalizar_avaliacao.php';</script>";
              }
             /* echo "$nomea<br />";
              echo "$avaid<br />";
              echo "$emaila<br />";
              echo "$idprod<br />"; */
             // echo "<script>location.href='finalizar_avaliacao.php';</script>";
            }

            ?>

          </div>

        </div>
      </div>
    </div>
  </body>
  </html>