<?php

include_once("php/sesion.php");
include_once("php/verificarSesion.php");
//header('Content-type: text/PHP'); // No puedo poner echo despues de esta funcion por que me arruina el xml (averiguar)
// Clases
include_once "./php/clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "./php/clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql
// Conexion de la BD
include_once "./php/conexionBD.php";
include_once "./php/funciones/funcionesGenerales.php";
$tiempo = '0';
$locationIndex = './index.php';

if(isset($_GET['registrar'])){
	global $db;
	//  [MODIFICAR] Cambiar el POST por el GET por el webservice
	$alias= $_GET['alias'];
	$email= $_GET['email'];
	$password= md5($_GET['password']);
	// --------- Insertar usuario
	$rs = $db->query("INSERT INTO USUARIO(MAIL, PASSWORD, ALIAS, PATH_FOTO ) VALUES ('$email', '$password', '$alias', 'default.jpg' )");
	//$db->debug();
	// --------- Filas insertadas ----------
	if( $db->rows_affected == 1 ){
	  $_SESSION['ok'] = "Usuario ingresado correctamente.";
    abrirPagina($locationIndex,$tiempo);
    }
	else {
	  $_SESSION['error'] = "Error en la registracion, intente mas tarde";
      abrirPagina($locationIndex,$tiempo);
	}
	//--------- Genera el JSON ---------
	//print json_encode($db);
	
	//--------- Genera el xml ---------
	/*
	if ($rs) {		
		$xml = file_get_contents('xml/result.xml');
		$xml = str_replace("##result##","Correcto",$xml);
		echo $xml;
	}else{
		echo file_get_contents('xml/error.xml');
	}*/
}
else{
    abrirPagina($locationIndex,$tiempo);
}
?>