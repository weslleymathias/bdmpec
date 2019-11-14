<?php
error_reporting(0);  
session_start();
unset($_SESSION['ContEmail']);
unset($_SESSION['ContSenha']);
header("location:index.html");
?>