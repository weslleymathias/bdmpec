<?php
error_reporting(0);
//{
echo file_get_contents('Acesso_Acervo.html');
header('Content-Type: text/html; charset=ISO-8859-1');
//}



include "mysqlconecta.php";


$fisica = "verdadeiro";
$quimica = "verdadeiro";
$biologia = "verdadeiro";
$matematica = "verdadeiro";


$busca = "";// palavra que o usuario digitou
$busca1 = "";

$area = "Biologia";


$busca_padrao = "SELECT DISTINCT titulo, nome_produto, data_defesa, link_produto, link_dissertacao, resumo, modalidade, produto_mpec.id_produto, produto_mpec.id_dissertacao, descricao_geral, avaliacao, downloads, acessos FROM ((((((((( pessoa JOIN esta_associado ON pessoa.id_pessoa = esta_associado.id_pessoa) JOIN produto_mpec ON esta_associado.id_produto = produto_mpec.id_produto) JOIN dissertacao ON produto_mpec.id_dissertacao = dissertacao.id_dissertacao) JOIN associado ON produto_mpec.id_produto = associado.id_produto) JOIN area_concentracao ON associado.id_areaconc = area_concentracao.id_areaconc) JOIN nivel_produto ON produto_mpec.id_produto = nivel_produto.id_produto) JOIN nivel_de_ensino ON nivel_produto.id_nivel = nivel_de_ensino.id_nivel) JOIN pmpec_tipo ON produto_mpec.id_produto = pmpec_tipo.id_produto) JOIN tipo ON pmpec_tipo.id_tipo = tipo.id_tipo), serie_produto, serie_de_destino WHERE serie_produto.id_serie = serie_de_destino.id_serie AND produto_mpec.situacao = 'Aceito' ";


if($area != 'Todas'){
  $busca_padrao = $busca_padrao . "AND modalidade = '$area' ";
}

$busca_padrao = $busca_padrao . "ORDER BY modalidade DESC ";
$busca_query = mysql_query($busca_padrao)or die(mysql_error());
$busca_query1 = mysql_query($busca_padrao)or die(mysql_error());

if (empty($busca_query)) { //Se nao achar nada, lança essa mensagem
  echo "Nenhum registro encontrado.";
}


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
    $idprod = $dados[7];
    $busca2 = mysql_query("SELECT DISTINCT categoria FROM produto_mpec, pmpec_tipo, tipo WHERE $idprod = pmpec_tipo.id_produto AND pmpec_tipo.id_tipo = tipo.id_tipo")or die(mysql_error());
    
   // echo "Categoria:";
    $categ = " ";
    $catgoria1 = " ";
    while ($dados2 = mysql_fetch_array($busca2)) {  
      $catgoria1 = $catgoria1 . $dados2['categoria'] . " ";
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
      $palavra_chave = " ";
      while ($dados3 = mysql_fetch_array($busca3)) {  
        $palavra_chave = $palavra_chave . $dados3['palavra'] . " ";
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
    $var = $dados[8]*10000;
    $var2 = $dados[8]*10000+1;
    echo "<a href=\"\" data-toggle=\"modal\" data-target=\"#$dados[8]\"><b><u> <font color=\"#0000FF\" size=\"4\">$dados[nome_produto]</font></u></b><br /></a>
    <i class=\"glyphicon glyphicon-user\"></i><b> Autor:</b> $autor <br />
    <i class=\"glyphicon glyphicon-list-alt\"></i><b> Descrição Geral:</b> $descricao  <br />
    <i class=\"glyphicon glyphicon-eye-open\"></i> <span>$dados[acessos] Acessos ao Produto</span> <br />
    <i class=\"glyphicon glyphicon-download\"></i> <span>$dados[downloads] Downloads da Dissertação</span>
    <form name=\"form2\" method=\"post\" action=\"avaliacoes_acervo.php\">
    <input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
    <input type=\"submit\" name=\"avaliacoes\" class=\"btn btn-primary\" id=\"avaliacoes\" value=\"Avaliações ($dados[avaliacao])\">
    </form>";
    /*$busca6 = mysql_query($busca_padrao = "SELECT DISTINCT nome_autor, nome_produto, produto_mpec.id_produto, status, usu_nome, data_gravacao, usu_avaliador.ava_id, avaliacao FROM autor, produto_mpec, esta_associado, avalia, resposta, usu_avaliador WHERE $idprod = produto_mpec.id_produto AND autor.id_autor = esta_associado.id_autor AND esta_associado.id_produto = produto_mpec.id_produto AND produto_mpec.id_produto = avalia.id_produto AND avalia.ava_id = resposta.ava_id AND avalia.id_produto = resposta.id_produto AND avalia.ava_id = usu_avaliador.ava_id AND resposta.status = 'Avaliado' ")or die(mysql_error());
    while ($dados6 = mysql_fetch_array($busca6)) {
  $idava = $dados6[6];
  $numava = $dados6['avaliacao'];
  $busca7 = "SELECT DISTINCT Resposta01, Resposta02, Resposta03, Resposta04, Resposta05, Resposta06, Resposta07, Resposta08, Resposta09, Resposta10, Resposta11, Resposta12, Resposta13, Resposta14, Resposta15, Resposta16, Resposta17, Resposta18 FROM resposta WHERE ava_id = $idava AND id_produto = $idprod";
  $busca_query7 = mysql_query($busca7) or die(mysql_error());
  if ($dados7 = mysql_fetch_array($busca_query7)) {
    $resp1 = $dados7['Resposta01'];
    $resp2 = $dados7['Resposta02'];
    $resp3 = $dados7['Resposta03'];
    $resp4 = $dados7['Resposta04'];
    $resp5 = $dados7['Resposta05'];
    $resp6 = $dados7['Resposta06'];
    $resp7 = $dados7['Resposta07'];
    $resp8 = $dados7['Resposta08'];
    $resp9 = $dados7['Resposta09'];
    $resp10 = $dados7['Resposta10'];
    $resp11 = $dados7['Resposta11'];
    $resp12 = $dados7['Resposta12'];
    $resp13 = $dados7['Resposta13'];
    $resp14 = $dados7['Resposta14'];
    $resp15 = $dados7['Resposta15'];
    $resp16 = $dados7['Resposta16'];
    $resp17 = $dados7['Resposta17'];
    $resp18 = $dados7['Resposta18'];
  }
}*/
echo "<tr>

<td><!-- Button trigger modal -->
<hr>

<div class=\"modal fade\" id=\"$dados[8]\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" >
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
<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fechar</button>
<a data-toggle=\"modal\" href=\"#$var\" name=\"busca\" id=\"busca\" class=\"btn btn-primary\">Busca na Web</a>
<input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
<input type=\"hidden\" class=\"form-control\" name=\"dprod\" id=\"dprod\" value=\"$dados[link_produto]\"required>
<input type=\"hidden\" class=\"form-control\" name=\"ddis\" id=\"ddis\" value=\"$dados[link_dissertacao]\"required>
<input type=\"hidden\" class=\"form-control\" name=\"nprod\" id=\"nprod\" value=\"$dados[nome_produto]\"required>
<a href=\"downloadproduto.php?id=$idprod\" class=\"btn btn-primary\" name=\"downprod\" id=\"downprod\" target=\"_blank\">Acesso ao Produto</a>
<a href=\"downloaddissertacao.php?id=$iddis\" class=\"btn btn-primary\" name=\"downdis\" id=\"downdis\" target=\"_blank\">Download da Dissertação</a>
</form>
</div>
</div>
</div>
</div></td>
</tr>
";
echo "<tr>
<td>
<div class=\"modal\" id=\"$var\">
<div class=\"modal-dialog\">
<div class=\"modal-content\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
<h4 class=\"modal-title\">Busca na Web</h4>
</div><div class=\"container\"></div>
<div class=\"modal-body\">
<form class=\"form-horizontal\" method=\"post\" action=\"busca.php\" target=\"_blank\">
<fieldset>

<!-- Form Name -->
<legend>Atributos que deseja utilizar na busca:</legend>
<!-- Multiple Checkboxes -->
<div class=\"form-group\">
<label class=\"col-md-4 control-label\" for=\"checkboxes\"></label>
<div class=\"col-md-4\">
<div class=\"checkbox\">
<label for=\"palavra\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"palavra\" value=\"$palavra_chave\" checked=\"checked\">
Palavra-chave
</label>
</div>
<div class=\"checkbox\">
<label for=\"area\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"area\" value=\"$dados[modalidade]\">
Area de concentração
</label>
</div>
<div class=\"checkbox\">
<label for=\"autor\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"autor\" value=\"$autor\">
Nome do Autor
</label>
</div>
<div class=\"checkbox\">
<label for=\"orientador\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"orientador\" value=\"$orientador\">
Nome do Orientador
</label>
</div>
<div class=\"checkbox\">
<label for=\"produto\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"produto\" value=\"$dados[nome_produto]\">
Título do Produto
</label>
</div>
<div class=\"checkbox\">
<label for=\"dissertacao\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"dissertacao\" value=\"$dados[titulo]\">
Título da Dissertação
</label>
</div>
<div class=\"checkbox\">
<label for=\"descricao\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"descricao\" value=\"$dados[descricao_geral]\">
Descrição Geral
</label>
</div>
<div class=\"checkbox\">
<label for=\"categoria\">
<input type=\"checkbox\" name=\"atributo[]\" id=\"categoria\" value=\"$categ\">
Categoria
</label>
</div>
</div>
</div>

</fieldset>


</div>
<div class=\"modal-footer\">

<a href=\"#\" data-dismiss=\"modal\" class=\"btn\">Fechar</a>
<input type=\"hidden\" class=\"form-control\" name=\"idprod\" id=\"idprod\" value=\"$idprod\"required>
<input type=\"submit\" class=\"btn btn-primary\" name=\"buscar\" id=\"buscar\" value=\"Buscar\">
<input type=\"hidden\" class=\"form-control\" name=\"nprod\" id=\"nprod\" value=\"$dados[nome_produto]\"required>
</form>
</div>
</div>
</div>
</div>
</td>
</tr>";

echo "<tr>
<td>
<div class=\"modal\" id=\"$var2\">
<div class=\"modal-dialog\">
<div class=\"modal-content\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
<h4 class=\"modal-title\">Resultados da busca</h4>
</div><div class=\"container\"></div>
<div class=\"modal-body\">
Content for the dialog / modal goes here.
</div>
<div class=\"modal-footer\">
<a href=\"#\" data-dismiss=\"modal\" class=\"btn\">Fechar</a>
</div>
</div>
</div>
</div>
</td>
</tr>";
}
/*if(isset($_POST['downprod'])){
  $idprod = $_POST['idprod'];
  $inserir_query = "UPDATE produto_mpec SET acessos = acessos + 1 WHERE id_produto = $idprod";
  mysql_query($inserir_query) or die(mysql_error());
  //  echo "<script>location.href='$_POST[dprod]';</script>";
  //  echo "<script>window.open('$_POST[dprod]', '_blank');</script>";
  //  echo "$idprod ---- $_POST[dprod]";
}
if(isset($_POST['downdis'])){
  $idprod = $_POST['idprod'];
  $inserir_query = "UPDATE produto_mpec SET downloads = downloads + 1 WHERE id_produto = $idprod";
  mysql_query($inserir_query) or die(mysql_error());
  echo "<script>location.href='$_POST[ddis]';</script>";
  //  echo "$idprod ---- $_POST[ddis]";
}*/
/*  if(isset($_POST['avaliacoes'])){
    $_SESSION['IdProduto'] = $_POST['idprod'];
  echo "<script>location.href='avaliacoes_acervo.php';</script>";
} */

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
