<?php
error_reporting(0);  
session_start();
unset($_SESSION['UsuarioEmail']);
unset($_SESSION['UsuarioSenha']);
header("location:index.html");
?>