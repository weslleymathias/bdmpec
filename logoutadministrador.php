<?php
error_reporting(0);  
session_start();
unset($_SESSION['AdmEmail']);
unset($_SESSION['AdmSenha']);
header("location:index.html");
?>