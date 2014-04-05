<?php
include_once("php/sesion.php");
include_once("php/verificarSesion.php");
// Clases
include_once "./php/clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "./php/clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql
 
// Conexion de la BD
include_once "./php/conexionBD.php";
include_once "./php/funciones/funcionesGenerales.php";
$tiempo = '0';
$locationHome = './home.php';
$locationIndex = './index.php';

if(isset($_GET['ingresar']))
{
	global $db;

	$correo= $_GET['correo'];
	$clave= md5($_GET['clave']);
	
	$usuario = $db->get_row("SELECT * FROM USUARIO WHERE MAIL = '$correo' AND PASSWORD  = '$clave' "); // --------- buscar usuario ---
	//$db->debug();

	$email = $usuario->MAIL; 
	
	// --------- Filas insertadas ----------
	if($db->num_rows > 0){
		$_SESSION['id'] = $usuario->ID;
		abrirPagina($locationHome,$tiempo);
	}
	else{
		//echo "No se encontro usuario y password.";
	      $_SESSION['error'] = "No se encontro usuario y contraseña";
	      abrirPagina($locationIndex,$tiempo);
	}
	//--------- Genera el JSON ---------
	//print json_encode($usuario);
	//--------- Genera el XML --------- 
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
	echo " [MODIFICAR] NO APRETO EL BOTON INGRESAR";	
	abrirPagina($locationIndex,$tiempo);	
}
?>