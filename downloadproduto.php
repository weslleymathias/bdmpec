<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<?php
	include "mysqlconecta.php";
	header('Content-Type: text/html; charset=ISO-8859-1');

	$idprod = $_GET['id'];
	$inserir_query = "UPDATE produto_mpec SET acessos = acessos + 1 WHERE id_produto = $idprod";
	mysql_query($inserir_query) or die(mysql_error());
	$buscar_produto = "SELECT link_produto FROM produto_mpec WHERE id_produto = '$idprod'";
	$busca_produto = mysql_query($buscar_produto) or die(mysql_error());

	if ($dados = mysql_fetch_array($busca_produto)) {
		$link = $dados['link_produto'];
	}
	echo "<script>location.href='$link';</script> ";
	?>
	<html>