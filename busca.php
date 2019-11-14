<?php

//require_once 'funcoes.php';
//phpinfo();
require_once 'filtro.php';
header('Content-Type: text/html; charset=ISO-8859-1');


//error_reporting(0);



//$palavra = $_POST['palavra'];
$titulo_produto = $_POST['nprod'];
$atributo = $_POST['atributo'];
$busca = array();
foreach ($atributo as &$value){
    $busca2 = explode(" ", $value);
    $busca = array_merge($busca, $busca2);
//    echo "Atributo: $value<br/>";
}

$titulo_produto = strtolower($titulo_produto);
$resultadoSites = filtro($busca, $titulo_produto, array(false,true,false,false), 2, 1, 0);
 //   echo '<br><br><br><br>';
echo "<div class=\"container\">
<div class=\"row\">
<div class=\"col-lg-12\">";
$i = 1;
foreach($resultadoSites as $item) {
    echo '<b>Título: </b>' . $item['title'] . '<br>';
    echo "<b>URL: </b> <a href=\"$item[urlEncode]\"><u> <font color=\"#0000FF\">$item[urlEncode]" . "</font></u><br /></a>";
    echo '<b>Descrição: </b>' . $item['content'] . '<br>' . '<hr>';
      //  echo $item['cosine'] . '<br>' . '<br>';
    $i++;
}
echo "</div>
</div>
</div>";

?>