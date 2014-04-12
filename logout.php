<?php
include_once("php/sesion.php");
include_once("php/funciones/funcionesGenerales.php");

session_unset();
session_destroy();
/*
unset($_SESSION['id']);
*/
abrirPagina("index.php",0);
?>