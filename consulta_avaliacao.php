<?php
error_reporting(0);
session_start();
//{
echo file_get_contents('Acesso_Acervo_Avaliador.php');
//}
header('Content-Type: text/html; charset=ISO-8859-1');



include "mysqlconecta.php";


$fisica = "verdadeiro";
$quimica = "verdadeiro";
$biologia = "verdadeiro";
$matematica = "verdadeiro";



$busca = $_POST['palavra'];// palavra que o usuario digitou
$busca1 = $_POST['palavra1'];
$tipo = $_POST['tipo'];
$area = $_POST['area'];
//$categoria = $_POST['categoria'];
$nivel = $_POST['nivel'];
$anoini = $_POST['anoini'];
$anofin = $_POST['anofin'];

$todos = $_POST['Todos'];
$ensfundai = $_POST['ensfundai'];
$ensfundaf = $_POST['ensfundaf'];
$ensmedio = $_POST['ensmedio'];
$eja = $_POST['eja'];
$enssuper = $_POST['enssuper'];

$todas = $_POST['Todas'];
$apostila = $_POST['Apostila'];
$apresentacao = $_POST['Apresentação'];
$cartilha = $_POST['Cartilha'];
$curso = $_POST['Curso'];
$hipertexto = $_POST['Hipertexto'];
$jogo = $_POST['Jogo'];
$modelo = $_POST['Modelo'];
$livro = $_POST['Livro'];
$midia = $_POST['Mídia'];
$objeto = $_POST['Objeto'];
$oficina = $_POST['Oficina'];
$pagina = $_POST['Pagina'];
$palestra = $_POST['Palestra'];
$proposta = $_POST['Proposta'];
$prototipo = $_POST['Protótipo'];
$sequencia = $_POST['Sequência'];



//$busca_query = mysql_query("SELECT * FROM area_pesquisa")or die(mysql_error());//faz a busca com as palavras enviadas

//$busca_query = mysql_query("SELECT nome, titulo, nome_produto, data_defesa, papel, categoria, modalidade, serie_de_destino FROM pessoa NATURAL JOIN dissertacao NATURAL JOIN produto_mpec NATURAL JOIN esta_associado NATURAL JOIN pmpec_tipo NATURAL JOIN tipo NATURAL JOIN associado NATURAL JOIN area_concentracao NATURAL JOIN area_serie NATURAL JOIN serie_de_destino WHERE (nome LIKE'%$busca%' OR titulo LIKE '%$busca%' OR nome_produto LIKE '%$busca%') ORDER BY data_defesa DESC ")or die(mysql_error());

//$busca_query = mysql_query("SELECT nome_autor, titulo, nome_produto, data_defesa, nome_orientador, categoria, nivel_de_ensino, modalidade, link_produto, resumo FROM orientador NATURAL JOIN autor NATURAL JOIN dissertacao NATURAL JOIN esta_associado NATURAL JOIN produto_mpec NATURAL JOIN associado NATURAL JOIN area_concentracao NATURAL JOIN area_nivel NATURAL JOIN nivel_de_ensino NATURAL JOIN pmpec_tipo NATURAL JOIN tipo WHERE (nome_autor LIKE '%$busca%' OR nome_orientador LIKE '%$busca%' OR titulo LIKE '%$busca%' OR nome_produto LIKE '%$busca%') AND modalidade = '$area' AND categoria = '$categoria' AND nivel_de_ensino = '$nivel' AND autor.id_orientador = orientador.id_orientador AND esta_associado.id_produto = produto_mpec.id_produto AND dissertacao.id_dissertacao = produto_mpec.id_dissertacao ORDER BY modalidade, data_defesa DESC ")or die(mysql_error());

//$busca_padrao = "SELECT DISTINCT nome_autor, titulo, nome_produto, data_defesa, nome_orientador, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, avaliacao, downloads FROM orientador,autor,  dissertacao, produto_mpec, esta_associado, associado, area_concentracao, nivel_produto, nivel_de_ensino, pmpec_tipo, tipo, dissert_palavra, palavra_chave, serie_produto, serie_de_destino WHERE autor.id_orientador = orientador.id_orientador AND autor.id_autor = esta_associado.id_autor AND esta_associado.id_produto = produto_mpec.id_produto AND dissertacao.id_dissertacao = produto_mpec.id_dissertacao AND  produto_mpec.id_produto = associado.id_produto AND associado.id_areaconc = area_concentracao.id_areaconc AND produto_mpec.id_produto = nivel_produto.id_produto AND nivel_produto.id_nivel = nivel_de_ensino.id_nivel AND produto_mpec.id_produto = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo AND produto_mpec.id_dissertacao = dissertacao.id_dissertacao AND dissertacao.id_dissertacao = dissert_palavra.id_dissertacao AND dissert_palavra.id_palavra = palavra_chave.id_palavra AND produto_mpec.id_produto = serie_produto.id_produto AND serie_produto.id_serie = serie_de_destino.id_serie ";

$busca_padrao = "SELECT DISTINCT titulo, nome_produto, data_defesa, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, avaliacao, downloads, acessos FROM ((((((((( pessoa JOIN esta_associado ON pessoa.id_pessoa = esta_associado.id_pessoa) JOIN produto_mpec ON esta_associado.id_produto = produto_mpec.id_produto) JOIN dissertacao ON produto_mpec.id_dissertacao = dissertacao.id_dissertacao) JOIN associado ON produto_mpec.id_produto = associado.id_produto) JOIN area_concentracao ON associado.id_areaconc = area_concentracao.id_areaconc) JOIN nivel_produto ON produto_mpec.id_produto = nivel_produto.id_produto) JOIN nivel_de_ensino ON nivel_produto.id_nivel = nivel_de_ensino.id_nivel) JOIN pmpec_tipo ON produto_mpec.id_produto = pmpec_tipo.id_produto) JOIN tipo ON pmpec_tipo.id_tipo = tipo.id_tipo), serie_produto, serie_de_destino WHERE serie_produto.id_serie = serie_de_destino.id_serie AND produto_mpec.situacao = 'Aceito' ";

if($busca != NULL){
  if($tipo == 'Assunto'){
    $busca_padrao = $busca_padrao . "AND (titulo LIKE '%$busca%' OR nome_produto LIKE '%$busca%' OR resumo LIKE '%$busca%'' OR modalidade LIKE '%$busca%') ";
  } elseif ($tipo == 'Pesquisador') {
    $busca_padrao = $busca_padrao . "AND (pessoa.nome LIKE '%$busca%') ";
  /*} elseif ($tipo == 'Palavra-Chave') {
    $busca_padrao = $busca_padrao . "AND (palavra LIKE '%$busca%') ";
  */} elseif ($tipo == 'Todos') {
    $busca_padrao = $busca_padrao . "AND (titulo LIKE '%$busca%' OR nome_produto LIKE '%$busca%' OR resumo LIKE '%$busca%' OR pessoa.nome LIKE '%$busca%' OR modalidade LIKE '%$busca%') ";
  }
}elseif ($busca1 != NULL) {
  if($tipo == 'Assunto'){
    $busca_padrao = $busca_padrao . "AND (titulo LIKE '%$busca1%' OR nome_produto LIKE '%$busca1%' OR resumo LIKE '%$busca1%' OR modalidade LIKE '%$busca1%') ";
  } elseif ($tipo == 'Pesquisador') {
    $busca_padrao = $busca_padrao . "AND (pessoa.nome '%$busca1%') ";
  /*} elseif ($tipo == 'Palavra-Chave') {
    $busca_padrao = $busca_padrao . "AND (palavra LIKE '%$busca1%') ";
  */} elseif ($tipo == 'Todos') {
    $busca_padrao = $busca_padrao . "AND (titulo LIKE '%$busca1%' OR nome_produto LIKE '%$busca1%' OR resumo LIKE '%$busca1%' OR pessoa.nome LIKE '%$busca1%' OR modalidade LIKE '%$busca1%') ";
  }
}

$selecao = "falso";
$aux = "";

$ensino = "";


if($ensfundai == 'Ensino Fundamental (Anos Iniciais)'){
  $selecao = "verdadeiro";
  $ensino = $ensino . "nivel_de_ensino = '$ensfundai' ";

}
if($ensfundaf == 'Ensino Fundamental (Anos Finais)'){
  $aux = "nivel_de_ensino = '$ensfundaf' ";
  verificador($ensino, $selecao, $aux);

}
if($ensmedio == 'Ensino Médio'){
  $aux= "nivel_de_ensino = '$ensmedio' ";
  verificador($ensino, $selecao, $aux);
}

if($eja == 'E.J.A'){
  $aux ="nivel_de_ensino = '$eja' ";
  verificador($ensino, $selecao, $aux);
}

if($enssuper == 'Ensino Superior'){
  $aux = "nivel_de_ensino = '$enssuper' ";
  verificador($ensino, $selecao, $aux);
}

if($ensino != NULL){
  $busca_padrao = $busca_padrao . "AND ( " . $ensino . ") ";
}



$selecao2 = "falso";
$categoria = "";


if($apostila == 'Apostila'){
  $selecao2 = "verdadeiro";
  $categoria = $categoria . "categoria = '$apostila' ";
}

if($apresentacao == 'Apresentação'){
  $aux ="categoria = '$apresentacao' ";
  verificador($categoria, $selecao2, $aux);
  
}
if($cartilha == 'Cartilha'){
  $aux ="categoria = '$cartilha' ";
  verificador($categoria, $selecao2, $aux);
}

if($curso == 'Curso'){
  $aux ="categoria = '$curso' ";
  verificador($categoria, $selecao2, $aux);
}

if($hipertexto == 'Hipertexto'){
  $aux ="categoria = '$hipertexto' ";
  verificador($categoria, $selecao2, $aux);
}

if($jogo == 'Jogo'){
  $aux =  "categoria = '$jogo' ";
  verificador($categoria, $selecao2, $aux);
}

if($modelo == 'Modelo Educacional'){    
  $aux =  "categoria = '$modelo' ";
  verificador($categoria, $selecao2, $aux);     
}

if($livro == 'Livro Paradidático'){
  $aux =  "categoria = '$livro' ";
  verificador($categoria, $selecao2, $aux);
}

if($midia == 'Mídia'){
  $aux =  "categoria = '$midia' ";
  verificador($categoria, $selecao, $aux); 
}

if($objeto == 'Objeto de Ensino'){
  $aux =  "categoria = '$objeto' ";
  verificador($categoria, $selecao2, $aux);  
}

if($oficina == 'Oficina'){
  $aux =  "categoria = '$oficina' ";
  verificador($categoria, $selecao2, $aux);    
}

if($pagina == 'Página Web'){    
  $aux =  "categoria = '$pagina' ";
  verificador($categoria, $selecao2, $aux);
}

if($palestra == 'Palestra'){  
  $aux =  "categoria = '$palestra' ";
  verificador($categoria, $selecao2, $aux);  
}

if($proposta == 'Proposta de Disciplina'){
  $aux =  "categoria = '$proposta' ";
  verificador($categoria, $selecao2, $aux);
}

if($prototipo == 'Protótipo'){
  $aux =  "categoria = '$prototipo' ";
  verificador($categoria, $selecao2, $aux);
}

if($sequencia == 'Sequência Didática'){
  $aux =  "categoria = '$sequencia' ";
  verificador($categoria, $selecao2, $aux); 
}


if($categoria != NULL){
  $busca_padrao = $busca_padrao . "AND ( " . $categoria . ") ";
}




if($area != 'Todas'){
  $busca_padrao = $busca_padrao . "AND modalidade = '$area' ";
}
if($anoini != NULL AND $anofin != NULL){
  $busca_padrao = $busca_padrao . "AND EXTRACT(YEAR FROM data_defesa) BETWEEN '$anoini%' AND '$anofin%' ";
}
$busca_padrao = $busca_padrao . "ORDER BY modalidade DESC ";
$busca_query = mysql_query($busca_padrao)or die(mysql_error());
$busca_query1 = mysql_query($busca_padrao)or die(mysql_error());

//$busca_query = mysql_query("SELECT DISTINCT nome_autor, titulo, nome_produto, data_defesa, nome_orientador, link_produto, resumo, categoria FROM orientador,autor,  dissertacao, produto_mpec, esta_associado, pmpec_tipo, tipo WHERE (nome_autor LIKE '%$busca%' OR nome_orientador LIKE '%$busca%' OR titulo LIKE '%$busca%' OR nome_produto LIKE '%$busca%') AND autor.id_orientador = orientador.id_orientador AND autor.id_autor = esta_associado.id_autor AND esta_associado.id_produto = produto_mpec.id_produto AND dissertacao.id_dissertacao = produto_mpec.id_dissertacao AND produto_mpec.id_produto = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo ORDER BY data_defesa DESC ")or die(mysql_error());

if (empty($busca_query)) { //Se nao achar nada, lança essa mensagem
  echo "Nenhum registro encontrado.";
}

/*
echo "1<br />";

echo "$busca<br />";
echo "$tipo<br />";
echo "$area<br />";
echo "$categoria<br />";
echo "$nivel<br />";
echo "$ano<br />";

echo "$todos<br />";
echo "$ensfundai<br />";
echo "$ensfundaf<br />";
echo "$ensmedio<br />";
echo "$eja<br />";

echo "$enssuper<br />";

echo "$todas<br />";
echo "$apostila<br />";
echo "$apresentacao<br />";
echo "$cartilha<br />";
echo "$curso<br />";
echo "$hipertexto<br />";
echo "$jogo<br />";
echo "$modelo<br />";
echo "$livro<br />";
echo "$midia<br />";
echo "$objeto<br />";
echo "$oficina<br />";
echo "$pagina<br />";
echo "$palestra<br />";
echo "$proposta<br />";
echo "$prototipo<br />";
echo "$sequencia<br />";
*/
$cont = 0;
while ($dadosm = mysql_fetch_array($busca_query1)) { 
  $cont++;
}

/*echo "<p align=\"left\"> <b>$cont resultados encontrados.</b></p>";
echo "<hr>";*/
if ($busca == NULL && $busca1 == NULL) {
  echo "<p class=\"lead\"><strong class=\"text-danger\">$cont</strong> resultados encontrados.</p>                
  <hr>";
}
elseif ($busca != NULL && $busca1 != NULL) {
  echo "<p class=\"lead\"><strong class=\"text-danger\">$cont</strong> resultados encontrados para <strong class=\"text-danger\">\"$busca\"</strong>.</p>                
  <hr>";
}
elseif($busca != NULL){
  echo "<p class=\"lead\"><strong class=\"text-danger\">$cont</strong> resultados encontrados para <strong class=\"text-danger\">\"$busca\"</strong></p>                
  <hr>";
}
elseif ($busca1 != NULL) {
  echo "<p class=\"lead\"><strong class=\"text-danger\">$cont</strong> resultados encontrados para <strong class=\"text-danger\">\"$busca1\"</strong></p>                
  <hr>";
}

/*echo "<p class=\"lead\"><strong class=\"text-danger\">$cont</strong> resultados encontrados para <strong class=\"text-danger\">\"$busca$busca1\"</strong></p>                
<hr>";*/

// quando existir algo em '$busca_query' ele realizará o script abaixo.
while ($dados = mysql_fetch_array($busca_query)) { 
  /*$result = count($dados)/13;
  echo $result;
  $tamanho = array();
  for($i=0;$i<$result;$i++){
    $tamanho[$i] = $i;
    echo $tamanho[$i];
  }*/
//  echo "1<br />";
  if ($fisica == 'verdadeiro' && $dados['modalidade'] == 'Física'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h2 class=\"text-danger\">Física</h2></p>";
    echo "<hr>";
    $fisica = 'falso';
  }
  if ($quimica == 'verdadeiro' && $dados['modalidade'] == 'Química'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h2 class=\"text-danger\">Química</h2></p>";
    echo "<hr>";
    $quimica = 'falso';
  }
  if ($biologia == 'verdadeiro' && $dados['modalidade'] == 'Biologia'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h2 class=\"text-danger\">Biologia</h2></p>";
    echo "<hr>";
    $biologia = 'falso';
  }
  if ($matematica == 'verdadeiro' && $dados['modalidade'] == 'Matemática'){
      //  echo "<hr>";
    echo "<p class=\"lead\"><h2 class=\"text-danger\">Matemática</h2></p>";
    echo "<hr>";
    $matematica = 'falso';
  }
  
    /*
    echo "Nome do Autor: $dados[nome_autor] <br />"; 
    echo "Título da Dissertação: $dados[titulo]<br />";
    echo "Título do Produto Educacional: $dados[nome_produto]<br />"; */
    $nova_data = date("d-m-Y", strtotime($dados['data_defesa']));
    /*
    echo "Data da defesa: $nova_data<br />";
    echo "Orientador: $dados[nome_orientador]<br />";
*/
    $nomeprod = $dados['nome_produto'];
    $idprod = $dados[7];
    $busca2 = mysql_query("SELECT DISTINCT categoria FROM produto_mpec, pmpec_tipo, tipo WHERE $idprod = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo")or die(mysql_error());
    
   // echo "Categoria:";
    $categ = " ";
    while ($dados2 = mysql_fetch_array($busca2)) {  
      $categ = $categ . $dados2['categoria'] . "; ";
    }
    $categ = substr($categ, 0, -2);
    // echo "Categoria: $categ<br />"; 

    /* $niv = " ";
     $busca4 = mysql_query("SELECT DISTINCT nivel_de_ensino FROM produto_mpec, associado, area_concentracao, area_nivel, nivel_de_ensino WHERE $idprod=associado.id_produto AND associado.id_areaconc=area_concentracao.id_areaconc AND area_concentracao.id_areaconc=area_nivel.id_areaconc AND area_nivel.id_nivel=nivel_de_ensino.id_nivel")or die(mysql_error());
     while ($dados4 = mysql_fetch_array($busca4)) {  
        $niv = $niv . $dados4['nivel_de_ensino'] . "; ";
      } */


      $iddis = $dados[8];
      $busca3 = mysql_query("SELECT DISTINCT palavra FROM produto_mpec, dissertacao, dissert_palavra, palavra_chave WHERE $iddis = dissertacao.id_dissertacao AND dissertacao.id_dissertacao = dissert_palavra.id_dissertacao AND  dissert_palavra.id_palavra = palavra_chave.id_palavra")or die(mysql_error());
      
      $palavra = " ";
      while ($dados3 = mysql_fetch_array($busca3)) {  
        $palavra = $palavra . $dados3['palavra'] . "; ";
      }
      $palavra = substr($palavra, 0, -2);

      $busca4 = mysql_query("SELECT DISTINCT serie_de_destino FROM produto_mpec, serie_produto, serie_de_destino WHERE $idprod = produto_mpec.id_produto AND $idprod = serie_produto.id_produto AND serie_produto.id_serie = serie_de_destino.id_serie")or die(mysql_error());
      $serie = " ";
      while ($dados4 = mysql_fetch_array($busca4)) {
       $serie = $serie . $dados4['serie_de_destino'] . "; ";
     }
     $serie = substr($serie, 0, -2);

     $busca5 = mysql_query("SELECT DISTINCT nivel_de_ensino FROM produto_mpec, nivel_produto, nivel_de_ensino WHERE $idprod = produto_mpec.id_produto AND $idprod = nivel_produto.id_produto AND nivel_produto.id_nivel = nivel_de_ensino.id_nivel")or die(mysql_error());
     $nivel = " ";
     while ($dados5 = mysql_fetch_array($busca5)) {
       $nivel = $nivel . $dados5['nivel_de_ensino'] . "; ";
     }
     $nivel = substr($nivel, 0, -2);

     $busca6 = mysql_query("SELECT DISTINCT nome FROM pessoa, esta_associado, produto_mpec WHERE $idprod = produto_mpec.id_produto AND produto_mpec.id_produto = esta_associado.id_produto AND esta_associado.id_pessoa = pessoa.id_pessoa AND papel = 'autor' ")or die(mysql_error());
     while ($dados6 = mysql_fetch_array($busca6)) {
       $autor = $dados6['nome'];
     }

     $busca7 = mysql_query("SELECT DISTINCT nome FROM pessoa, esta_associado, produto_mpec WHERE $idprod = produto_mpec.id_produto AND produto_mpec.id_produto = esta_associado.id_produto AND esta_associado.id_pessoa = pessoa.id_pessoa AND papel = 'orientador' ")or die(mysql_error());
     while ($dados7 = mysql_fetch_array($busca7)) {
       $orientador = $dados7['nome'];
     }

     $_SESSION['IdProd'] = $idprod;
     
     $busca_avaliacao = mysql_query("SELECT id_produto, ava_id, status FROM resposta WHERE id_produto = '$idprod' AND ava_id = '$_SESSION[AvaliadorId]'");
     $aux_ava_id;
     $aux_id_produto;
     $aux_status;

     while ($dados_avaliacao = mysql_fetch_array($busca_avaliacao)) {
      $aux_id_produto = $dados_avaliacao[0];
      $aux_ava_id = $dados_avaliacao[1];
      $aux_status = $dados_avaliacao[2];
     // echo "$aux_id_produto $aux_ava_id";
    }
     /*
     echo "Palavra-Chave: $palavra<br />";
   // echo "Categoria: $dados[10]<br />";
    echo "Nível de Ensino: $dados[nivel_de_ensino]<br />";
    echo "Área de Concentração: $dados[modalidade]<br />";
   // echo "<a href= ./arquivos/MarianaC.M.Souza(Produto).pdf>Link do produto</a> <br />";
    //echo "$dados[link_produto]<br />";
    echo "<form action= $dados[link_dissertacao] method=get >
              <input type=submit value='Texto da Dissertação' />
          </form>";
    echo "<form action= $dados[link_produto] method=get >
              <input type=submit value='Produto Educacional' />
          </form>";
    //echo "<a href= $dados[link_produto]>Link do produto</a> <br />";
    //echo "Resumo: $dados[resumo]<br />";
   // echo "Palavra-Chave: $dados[palavra]<br />";
   // echo "<a href= $dados[resumo]>Resumo</a> <br />";
    echo "<hr>";
*/
    $descricao = limitarTexto($dados['descricao_geral'], 300);

    
    echo "<a href=\"\" data-toggle=\"modal\" data-target=\"#$dados[8]\"><b><u> <font color=\"#0000FF\" size=\"4\">$dados[nome_produto]</font></u></b><br /></a>";
    if($idprod == $aux_id_produto && $aux_ava_id == $_SESSION['AvaliadorId'] && $aux_status == "Avaliado"){
      echo "<b><font color = \"green\">(Esse produto já foi avaliado por você!)</font></b><br />";
    }
    elseif ($idprod == $aux_id_produto && $aux_ava_id == $_SESSION['AvaliadorId'] && $aux_status == "Em Avaliação") {
      echo "<b><font color = \"orange\">(Esse produto já foi parcialmente avaliado por você!)</font></b><br />";
    }
    elseif ($idprod == $aux_id_produto && $aux_ava_id == $_SESSION['AvaliadorId'] && $aux_status == "Pendente") {
      echo "<b><font color = \"brown\">(Avaliação pendente de aceitação pelo autor!)</font></b><br />";
    }
    elseif ($idprod == $aux_id_produto && $aux_ava_id == $_SESSION['AvaliadorId'] && $aux_status == "Recusada") {
      echo "<b><font color = \"red\">(Avaliação recusada!)</font></b><br />";
    }
    
    echo "<i class=\"glyphicon glyphicon-user\"></i><b> Autor:</b> $autor <br />
    <i class=\"glyphicon glyphicon-list-alt\"></i><b> Descrição Geral:</b> $descricao <br />
    <i class=\"glyphicon glyphicon-eye-open\"></i> <span>$dados[acessos] Acessos ao Produto</span> <br />
    <i class=\"glyphicon glyphicon-download\"></i> <span>$dados[downloads] Downloads da Dissertação</span>";

    if($idprod == $aux_id_produto && $aux_ava_id == $_SESSION['AvaliadorId'] && (($aux_status == "Avaliado") || ($aux_status == "Recusada") || ($aux_status == "Pendente"))){

      echo "<td><!-- Button trigger modal -->
      <form name=\"form1\" method=\"post\" action=\"form01pa.php\">
      <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
      <input type=\"hidden\" class=\"form-control\" name=\"nomeprod\" id=\"nomeprod\" value=\"$nomeprod\"required>
      <input type=\"submit\" class=\"btn btn-primary\" name=\"avaliar\" id=\"avaliar\" value=\"Reavaliar Produto\">
      <br />
      </form>
      <hr>";
    }
    elseif($idprod == $aux_id_produto && $aux_ava_id == $_SESSION['AvaliadorId'] && ($aux_status == "Em Avaliação")){

      echo "<td><!-- Button trigger modal -->
      <form name=\"form1\" method=\"post\" action=\"form01pa.php\">
      <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
      <input type=\"hidden\" class=\"form-control\" name=\"nomeprod\" id=\"nomeprod\" value=\"$nomeprod\"required>
      <input type=\"submit\" class=\"btn btn-primary\" name=\"avaliar\" id=\"avaliar\" value=\"Continuar Avaliação\">
      <br />
      </form>
      <hr>";
    }
    else{
      echo "<td><!-- Button trigger modal -->
      <form name=\"form1\" method=\"post\" action=\"form01.php\">
      <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
      <input type=\"hidden\" class=\"form-control\" name=\"nomeprod\" id=\"nomeprod\" value=\"$nomeprod\"required>
      <input type=\"submit\" class=\"btn btn-primary\" name=\"avaliar\" id=\"avaliar\" value=\"Avaliar Produto\">
      <br />
      </form>
      <hr>";
    }

    echo "<div class=\"modal fade\" id=\"$dados[8]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
    <div class=\"modal-dialog\" role=\"document\">
    <div class=\"modal-content\">
    <div class=\"modal-header\">
    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
    <h4 class=\"modal-title\" id=\"myModalLabel\">$dados[nome_produto]</h4>
    </div>
    <div class=\"modal-body\">
    <b>Área de Concentração:</b> $dados[modalidade]<br />
    <hr>
    <b>Série de Destino:</b> $serie<br />
    <hr>
    <b>Nome do Autor:</b> $autor<br />
    <hr>
    <b>Título da Dissertação:</b> $dados[titulo]<br />
    <hr>
    <b>Título do Produto Educacional:</b> $dados[nome_produto]<br />
    <hr>
    <b>Descrição Geral:</b> $dados[descricao_geral] <br />
    <hr>
    <b>Data da defesa:</b> $nova_data<br />
    <hr>
    <b>Orientador:</b> $orientador<br />
    <hr>
    <b>Categoria:</b> $categ<br />
    <hr>
    <b>Palavra-Chave:</b> $palavra<br />
    <hr>
    <b>Nível de Ensino:</b> $nivel<br />
    </div>
    <div class=\"modal-footer\">
    <form method=post>
    <input type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\" value=\"Fechar\">
    <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
    <input type=\"hidden\" class=\"form-control\" name=\"dprod\" id=\"dprod\" value=\"$dados[link_produto]\"required>
    <input type=\"hidden\" class=\"form-control\" name=\"ddis\" id=\"ddis\" value=\"$dados[link_dissertacao]\"required>
    <a href=\"downloadproduto.php?id=$idprod\" class=\"btn btn-primary\" name=\"downprod\" id=\"downprod\" target=\"_blank\">Acesso ao Produto</a>
    <a href=\"downloaddissertacao.php?id=$iddis\" class=\"btn btn-primary\" name=\"downdis\" id=\"downdis\" target=\"_blank\">Download da Dissertação</a>

    </form>
    </div>
    </div>
    </div>
    </div></td>
    </tr>";

 // echo $_SESSION['UsuarioEmail'];
 // echo $_SESSION['UsuarioSenha'];
 // echo $_SESSION['IdProd'];
 // echo $_SESSION['AvaliadorId'];
 // echo "<hr>";
  }

 /* if(isset($_POST['downprod'])){
    $idprod = $_POST['idprod'];
    $inserir_query = "UPDATE produto_mpec SET acessos = acessos + 1 WHERE id_produto = $idprod";
    mysql_query($inserir_query) or die(mysql_error());
    echo "<script>location.href='$_POST[dprod]';</script>";
  //  echo "$idprod ---- $_POST[dprod]";
    }
    if(isset($_POST['downdis'])){
    $idprod = $_POST['idprod'];
    $inserir_query = "UPDATE produto_mpec SET downloads = downloads + 1 WHERE id_produto = $idprod";
    mysql_query($inserir_query) or die(mysql_error());
    echo "<script>location.href='$_POST[ddis]';</script>";
  //  echo "$idprod ---- $_POST[ddis]";
  }*/

  function verificador(&$busca_padrao, &$selecao, $comp)
  {
    if($selecao == 'falso'){
      $selecao = "verdadeiro";
      $busca_padrao = $busca_padrao . "$comp ";
    }else{
      $busca_padrao = $busca_padrao . "OR $comp ";
    }
    
  }

  function limitarTexto($texto, $limite){
    if (strlen($texto) > $limite){
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
    }
    return $texto;
  }

  ?>
  
  