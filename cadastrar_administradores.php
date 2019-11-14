<html>
<head>
	<?php  
	include "sessaoadministrador.php";
	?>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
	<?php 
	error_reporting(0);

	include "mysqlconecta.php";
	header('Content-Type: text/html; charset=ISO-8859-1');


	$Nome = $_POST['nome'];
	$Email = $_POST['email'];
	$Senha = $_POST['senha'];

	$inserir_query = "INSERT INTO usu_administrador(adm_id, usu_nome, usu_senha, usu_email) VALUES (NULL, '$Nome', '$Senha', '$Email')";
	mysql_query($inserir_query) or die(mysql_error());

	echo "<script>location.href='finalizar_cadastro_administrador.php';</script>";

/*

echo '<p><font face="Tahoma" color="##000000"><span style="font-size:11pt;"><b>Sua mensagem foi 
enviada com sucesso!</b></span></font></p>';

echo '<font face="Tahoma" color="##000000"><span style="font-size:10pt;">Em breve 
entraremos em contato com você! Obrigado! </span></font></p>';
*/
?>
</body>
</html>