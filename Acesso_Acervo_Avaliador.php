<!DOCTYPE html>
<html lang="en">

<head>
  <?php  
  include "sessaoavaliador.php";
  header('Content-Type: text/html; charset=ISO-8859-1');

  ?>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Acesso ao Acervo</title>

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
          <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>�rea do Avaliador: Avaliar Produtos<span class="pull-right label label-default">:)</span></legend>


              <form method="post" action="consulta_avaliacao.php">
                
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                      <div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                          <input type="text" name="palavra" id="palavra" class="form-control"  placeholder="Digite os termos de sua pesquisa..." >
                          <span class="input-group-addon">
                            <button type="submit">
                              <span class="glyphicon glyphicon-search"></span>
                            </button>  
                          </span>
                        </div>
                      </div>

                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                      Pesquisa Avan�ada
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Pesquisa Avan�ada</h4>
                          </div>
                          <div class="modal-body">
                            <p align="center"> <input type="text" name="palavra1" id="palavra1" size="50" placeholder="Digite os termos de sua pesquisa..."></p>
                            <div class="form-group">
                              <label for="filter">Filtro:</label>
                              <select class="form-control" name="tipo" id="tipo">
                                <option value="Todos" selected>Todos</option>
                                <option value="Assunto">Assunto</option>
                                <option value="Pesquisador">Pesquisador</option>
                                
                              </select>
                            </div>
                            <div class="form-group" name="nivel" id="nivel">
                              <label for="filter">N�vel de Ensino:</label><p>
                              <table width="100%" cellspacing="10" cellpadding="10">
                                <tr><td><input name="ensfundai" type="checkbox" value="Ensino Fundamental (Anos Iniciais)">Ensino Fundamental (Anos Iniciais)<p></td></tr>
                                <tr><td><input name="ensfundaf" type="checkbox" value="Ensino Fundamental (Anos Finais)">Ensino Fundamental (Anos Finais)<p></td></tr>
                                <tr><td><input name="ensmedio" type="checkbox" value="Ensino M�dio">Ensino M�dio<p></td></tr>
                                <tr><td><input name="eja" type="checkbox" value="E.J.A">E.J.A<p></td></tr>
                                <tr><td><input name="enssuper" type="checkbox" value="Ensino Superior">Ensino Superior<p></td></tr>
                              </table>

                              <div class="form-group">
                                <label for="filter">�rea de Concentra��o:</label>
                                <select class="form-control" name="area" id="area">
                                  <option value="Todas" selected>Todas</option>
                                  <option value="F�sica">F�sica</option>
                                  <option value="Qu�mica">Qu�mica</option>
                                  <option value="Biologia">Biologia</option>
                                  <option value="Matem�tica">Matem�tica</option>
                                </select>
                              </div>
                              
                              <div class="form-group" name="categoria" id="categoria">
                                <label for="filter">Categoria dos Produtos:</label><p>
                                <table width="100%" cellspacing="10" cellpadding="10">
                                  <tr>
                                    <td><input name="Apostila" type="checkbox" value="Apostila">Apostila<p></td>
                                    <td><input name="Apresenta��o" type="checkbox" value="Apresenta��o">Apresenta��o<p></td>
                                    <td> <input name="Cartilha" type="checkbox" value="Cartilha">Cartilha<p></td>
                                  </tr>
                                  <tr>
                                    <td><input name="Curso" type="checkbox" value="Curso">Curso<p></td>
                                    <td><input name="M�dia" type="checkbox" value="M�dia">Hiperm�dia<p></td>
                                    <td><input name="Hipertexto" type="checkbox" value="Hipertexto">Hipertexto<p></td>
                                  </tr>
                                  <tr>
                                    <td><input name="Jogo" type="checkbox" value="Jogo">Jogo<p></td>
                                    <td><input name="Livro" type="checkbox" value="Livro Paradid�tico">Livro Paradid�tico<p></td>
                                    <td><input name="Modelo" type="checkbox" value="Modelo Educacional">Modelo Educacional<p></td>
                                    
                                  </tr>
                                  <tr>
                                    <td><input name="Objeto" type="checkbox" value="Objeto de Ensino">Objeto de Ensino<p></td>
                                    <td><input name="Oficina" type="checkbox" value="Oficina">Oficina<p></td>
                                    <td><input name="Pagina" type="checkbox" value="P�gina Web">P�gina Web<p></td>
                                  </tr>
                                  <tr>
                                    <td><input name="Palestra" type="checkbox" value="Palestra">Palestra<p></td>
                                    <td><input name="Proposta" type="checkbox" value="Proposta de Disciplina">Proposta de Disciplina<p></td>
                                    <td><input name="Prot�tipo" type="checkbox" value="Prot�tipo">Prot�tipo<p></td>
                                  </tr>
                                  <tr>
                                    <td><input name="Sequ�ncia" type="checkbox" value="Sequ�ncia Did�tica">Sequ�ncia Did�tica<p></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>      
                                
                              </div>   
                              <div class="form-group">
                                <label for="filter">Ano:</label><p>  
                                De(AAAA):<input type="text" name="anoini" id="anoini" minlength= "4" maxlength="4" size="5">
                                At�(AAAA):<input type="text" name="anofin" id="anofin" minlength= "4" maxlength="4" size="5">
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Button trigger modal -->



                  </form>
                  

                  <p>
                    
                    <!-- /.container -->
                    
                    <!-- jQuery -->
                    <script src="js/jquery.js"></script>
                    
                    <!-- Bootstrap Core JavaScript -->
                    <script src="js/bootstrap.min.js"></script>
                    
                  </p>

                  <p>&nbsp;</p>
                </body>

                </html>