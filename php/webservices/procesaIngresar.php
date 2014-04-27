<?php
include_once("../sesion.php");
// Clases
include_once "../clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "../clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql

include_once "../../debugger/ChromePhp.php";
ChromePhp::log('PROCESA INGRESAR!');

// Conexion de la BD
include_once "../conexionBD.php";
include_once "../funciones/funcionesGenerales.php";
$tiempo = '0';
$locationHome = './home.php';
$locationIndex = './index.php';


	global $db;

	$correo= $_POST['correo'];
	$clave= md5($_POST['clave']);
	
	$usuario = $db->get_row("SELECT * FROM USUARIO WHERE MAIL = '$correo' AND PASSWORD  = '$clave' "); // --------- buscar usuario ---
	//$db->debug();

	$email = $usuario->MAIL;

    $TextoEmail = "Email: ".$usuario->MAIL;
    $TextoClave= "Clave: ".md5($_POST['clave']);

    ChromePhp::log($TextoEmail);
    ChromePhp::log($TextoClave);

	// --------- Filas insertadas ----------
	if($db->num_rows > 0){
         ChromePhp::log('num_rows!');
	    $_SESSION['id'] = $usuario->ID;
	    $aux['id'] = $usuario->ID;
        $aux['alias'] = $usuario->ALIAS;
        $aux['mail'] = $usuario->MAIL;
		$return["error"] = FALSE;
        $return["data"] = $aux;
	}
	else{
		$return["error"] = TRUE;
        $return["data"] = "Usuario invalido";
	}


if (function_exists('json_encode'))
{
    print json_encode($return);
    // ChromePhp::log(json_encode($return));
}
else
{
    print __json_encode($return);
    //  ChromePhp::log(__json_encode($return));
}

?>