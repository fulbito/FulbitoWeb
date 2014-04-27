<?php

include_once("../sesion.php");
// Clases
include_once "../clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "../clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql

include_once "../../debugger/ChromePhp.php";
ChromePhp::log('PROCESA Registracion!');

// Conexion de la BD
include_once "../conexionBD.php";
include_once "../funciones/funcionesGenerales.php";

ChromePhp::log('REGISTRAR!');
global $db;

$alias= $_POST['alias'];
$email= $_POST['email'];
$password= md5($_POST['password']);

// --------- Insertar usuario
$rs = $db->query("INSERT INTO USUARIO(MAIL, PASSWORD, ALIAS, PATH_FOTO ) VALUES ('$email', '$password', '$alias', 'default.jpg' )");
//$db->debug();

// --------- Filas insertadas ----------
if( $db->rows_affected == 1 ){

$_SESSION['id'] = $db->insert_id;
$return["error"] = FALSE;
  $return["data"] = "Se ha registrado al usuario correctamente";
}
else{
$return["error"] = TRUE;
  $return["data"] = "No se ha podido registrar al usuario";
}

if (function_exists('json_encode'))
{
  print json_encode($return);
}
else
{
  print __json_encode($return);
}

?>