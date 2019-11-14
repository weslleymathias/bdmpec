<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<?php
	include "mysqlconecta.php";
	header('Content-Type: text/html; charset=ISO-8859-1');

	$iddis = $_GET['id'];
	$inserir_query = "UPDATE produto_mpec SET downloads = downloads + 1 WHERE id_dissertacao = $iddis";
	mysql_query($inserir_query) or die(mysql_error());
	$buscar_dissertacao = "SELECT link_dissertacao FROM dissertacao WHERE id_dissertacao = '$iddis'";
	$busca_dissertacao = mysql_query($buscar_dissertacao) or die(mysql_error());

	if ($dados = mysql_fetch_array($busca_dissertacao)) {
		$link = $dados['link_dissertacao'];
	}
	echo "<script>location.href='$link';</script> ";
	?>
	<html>