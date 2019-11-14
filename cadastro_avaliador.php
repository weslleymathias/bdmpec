
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    header('Content-Type: text/html; charset=ISO-8859-1');
    ?>


    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cadastro de Avaliador</title>

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

        <script src="js/cadastrar_contribuidor.js"></script>

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
                            <a href="Sobre a Biblioteca.html">Sobre a Biblioteca</a>
                        </li>
                        <li>
                            <a href="Administracao.html">Administração</a>
                        </li>
                        <li>
                            <a href="Contato.html">Contato</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <p></p>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <legend>Perguntas Frequentes </legend>

                    <h4>01 - Como me tornar um avaliador?</h4>

                    <p>Para se tornar um avaliador basta preencher o questionário abaixo que iremos entrar em contato</p>

                    <h4>02 - Quem pode ser um avaliador?</h4>

                    <p>Professores atuantes em IES e na educação básica que utilizem os produtos de mestrado profissional em suas aulas regulares e que gostariam de realizar as suas considerações sobre esses produtos.</p>

                    <h4>03 - Vantagens e a importância de se tornar um avaliador:</h4>

                    <p>Após identificar, utilizar e realizar suas considerações sobre os produtos de mestrado profissional catalogados em nossa biblioteca, ao avaliá-los você estará fortalecendo os programas de MPEC além de contribuir para uma melhora da qualidade dos produtos elaborados nesses programas.</p>

                    <p>&nbsp;</p>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
                        Cadastro de Avaliadores</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Formulário de Cadastro</h4>
                            </div>
                            <div class="modal-body">
                                <p><font color="red">(*)</font> Campos de preenchimento obrigatório.</p>
                                <form name="form1" method="post" action="formavaliador_confirmacao.php">
                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label" required>Nome Completo:<font color="red">*</font></label>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">E-mail:<font color="red">*</font></label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <?php
                                error_reporting(0);
                                include "mysqlconecta.php";


                                $buscar_ies = "SELECT nome FROM ies ORDER BY nome ASC";
                                $busca_ies = mysql_query($buscar_ies)or die(mysql_error());
                                echo "
                                <div class=\"form-group\">
                                <label for=\"ies0\">I.E.S ou Escola da Educação Básica em que atua:<font color=\"red\">*</font>
                                <select class=\"form-control\" id=\"ies0\" name=\"ies0\" onchange=\"habilita()\" required>
                                <option value=\"\"></option>
                                <option value=\"outra\">Adicionar Nova Instituição de Ensino</option>";
                                while ($dados_ies = mysql_fetch_array($busca_ies)) {
                                    echo "<option value=\"$dados_ies[nome]\">$dados_ies[nome]</option>";
                                }

                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="ies" id="ies" style="display:none;">Instituição de Ensino:<font color="red">*</font>
                            <input type="text" class="form-control" id="ies" name="ies">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="rua" id="rua" style="display:none;">Rua:<font color="red">*</font>
                            <input type="text" class="form-control" id="rua" name="rua">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="numero" id="numero" style="display:none;">Número:<font color="red">*</font>
                            <input type="text" class="form-control" id="numero" name="numero">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="cidade" id="cidade" style="display:none;">Cidade:<font color="red">*</font>
                            <input type="text" class="form-control" id="cidade" name="cidade">
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="estado" id="estado" style="display:none;">UF:<font color="red">*</font>
                            <select class="form-control" name="estado" maxlength="2" id="estado">
                                <option value = "AC">AC</option>
                                <option value = "AL">AL</option>
                                <option value = "AP">AP</option>
                                <option value = "AM">AM</option>
                                <option value = "BA">BA</option>
                                <option value = "CE">CE</option>
                                <option value = "DF">DF</option>
                                <option value = "ES">ES</option>
                                <option value = "GO">GO</option>
                                <option value = "MA">MA</option>
                                <option value = "MT">MT</option>
                                <option value = "MS">MS</option>
                                <option value = "MG">MG</option>
                                <option value = "PA">PA</option>
                                <option value = "PB">PB</option>
                                <option value = "PR">PR</option>
                                <option value = "PE">PE</option>
                                <option value = "PI">PI</option>
                                <option value = "RJ">RJ</option>
                                <option value = "RN">RN</option>
                                <option value = "RS">RS</option>
                                <option value = "RO">RO</option>
                                <option value = "RR">RR</option>
                                <option value = "SC">SC</option>
                                <option value = "SP">SP</option>
                                <option value = "SE">SE</option>
                                <option value = "TO">TO</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="campus" id="campus" style="display:none;">Campus:<font color="red">*</font>
                            <input type="text" class="form-control" id="campus" name="campus" >
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Área de Atuação:(Programa da I.E.S, Física, Química, etc...):<font color="red">*</font></label>
                        <input type="text" class="form-control" name="curso" id="curso" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Link para o Lattes:<font color="red">*</font></label>
                        <input type="text" class="form-control" name="lattes" id="lattes" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Senha:<font color="red">*</font></label>
                        <input type="password" class="form-control" name="senha" id="senha" minlength= "4" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Confirmar Senha:<font color="red">*</font></label>
                        <input type="password" class="form-control" name="confsenha" id="confsenha" minlength= "4" required oninput="validaSenha(this)">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
                </div>
            </div>
        </div>
    </div>
</form>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>

<script type="text/javascript">
function validaSenha (input){ 
    if (input.value != document.getElementById('senha').value) {
        input.setCustomValidity('Repita a senha corretamente');
    } else {
        input.setCustomValidity('');
    }
} </script>
