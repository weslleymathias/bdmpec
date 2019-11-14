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

  <title>Produtos Avaliados</title>

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
                <li><a href='Acesso_Acervo_Avaliador.php'><span>Avaliar Produtos</span></a></li>
                <li><a href='produtos_avaliados.php'><span>Visualizar Produtos Avaliados</span></a></li>
                <li><a href='perfil.php'><span>Editar Perfil</span></a></li>  
                <li><a href='logoutavaliador.php'><span>Sair</span></a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
        </nav>
        <div class="container">
          <div class="row">

            <div class="col-lg-12">
              <legend>Área do Avaliador: Visualizar Produtos Avaliados<span class="pull-right label label-default">:)</span></legend>
              <form method="post" action="produtosavaliados.php">
                <div class="col-md-4">
                 <div class="col-lg-12">
                  <div class="form-group">
                    <label for="filter">Filtro:</label>
                    <select class="form-control" name="tipo" id="tipo">
                      <option value="Todos" selected>Todos</option>
                      <option value="Em Avaliação">Produtos em Avaliação</option>
                      <option value="Avaliado">Avaliações Aceitas</option>
                      <option value="Pendente">Avaliações Pendentes de Aprovação</option>
                      <option value="Recusada">Avaliações Recusadas</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="filter">Área de Concentração:</label>
                    <select class="form-control" name="area" id="area">
                      <option value="Todas" selected>Todas</option>
                      <option value="Física">Física</option>
                      <option value="Química">Química</option>
                      <option value="Biologia">Biologia</option>
                      <option value="Matemática">Matemática</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="filter">Ano:</label><p>  
                    De(AAAA):<input type="text" name="anoini" id="anoini" minlength= "4" maxlength="4" size="5">
                    Até(AAAA):<input type="text" name="anofin" id="anofin" minlength= "4" maxlength="4" size="5">
                    
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
              </div>
            </div>
            

          </div>
        </div>
      </div>
    </form>
  </body>
  </html>