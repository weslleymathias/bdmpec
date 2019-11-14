<?php


setlocale(LC_ALL,'pt_BR.latin1');
mb_internal_encoding('latin1'); 

$hostdb = "localhost";// Geralmente Localhost
$userdb = "weslley";//usuário do seu banco de dados
$passdb = "admin";// senha do banco de dados
$tabledb = "biblioteca";// tabela do banco de dados 

/*$hostdb = "localhost";// Geralmente Localhost
$userdb = "weslley";//usuário do seu banco de dados
$passdb = "admin";// senha do banco de dados
$tabledb = "bdmpec";// tabela do banco de dados */

/*$hostdb = "localhost";// Geralmente Localhost
$userdb = "bdmpec";//usuário do seu banco de dados
$passdb = "ajMFzVZJEMXWV6yp";// senha do banco de dados
$tabledb = "bdmpec";// tabela do banco de dados */

/*$hostdb = "mysql.hostinger.com.br";// Geralmente Localhost
$userdb = "u756949596_admin";//usuário do seu banco de dados
$passdb = "admin1";// senha do banco de dados
$tabledb = "u756949596_bibli";// tabela do banco de dados */

/* $hostdb = "localhost";// Geralmente Localhost
$userdb = "bdmpec";//usuário do seu banco de dados
$passdb = "Rzo9DYv#";// senha do banco de dados
$tabledb = "bdmpec_bdmpec";// tabela do banco de dados */

$conecta = mysql_connect($hostdb, $userdb, $passdb) or die (mysql_error());
@mysql_select_db($tabledb, $conecta) or die ("Erro ao conectar com o banco de dados");
mysql_set_charset('latin1', $conecta);


?>