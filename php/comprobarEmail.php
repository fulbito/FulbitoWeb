<?php

/*
 Se llama a este codigo en 3 situaciones:
 1 - Para registrarse y comprobar que no esta siendo usado el email.
 2 - Para recuperar el password y valida que exista el email para enviar.
 3 - Para cambiar el password, pregunta que no exista otro usuario con el email nuevo que quiere.

 Nota: no poner ni echos ni print, solo los true y false, si se muestra algo deja de funcionar.
 */
 
// Clases
include_once("sesion.php"); /*  Aca no pongo el verificar sesion por que lo uso para recuperar password y
										  ahi no esta iniciado el SESSION[id] e iria al INDEX sino.*/   
include_once "./clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "./clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql
include_once "./conexionBD.php";

$email = $_REQUEST["email"];


if(!empty($email)) {
	comprobar($email);
}


function comprobar($b) {
		
	global $db;
	
	if(!isset($_GET["cambiarEmail"])) // ACA ENTRA PARA REGISTRARSE Y PARA RECUPERAR EL PASSWORD
	{
		$db->query("SELECT  * 
						FROM USUARIO
						WHERE MAIL = '$b' ");
				
		if(isset($_GET["recu"])) // PARA RECUPERAR
		{
			//echo "RECUPERAR";
			
			if($db->num_rows  == 1)
				echo "true"; 
			else
				echo "false"; 
		}
		else // PARA REGISTRARSE
		{
			//echo "REGISTRARSE";
			
			if($db->num_rows  == 1)
				echo "false"; 
			else
				echo "true"; 
		}

		//$db->debug();
	}
	else // ACA ENTRA PARA CAMBIAR EL PASSWORD
	{
		//echo "CAMBIAR EL PASSWORD";
		
		$id = $_SESSION['id'];
		$db->query("SELECT  * 
						FROM USUARIO
						WHERE MAIL = '$b' 
						AND ID != '$id' ");
		//$db->debug();

		if($db->num_rows  == 1){	
				echo "false";
		}
		else
		{
				echo "true";
		}
	}
}
?>