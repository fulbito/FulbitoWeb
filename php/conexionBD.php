<?php
	global $db;
    /*
    // DATOS DE LOCALHOST MAYO
    $usuario="root";
    $clave="root";
    $nombreBD="fulbito";
    $conexion="localhost";
    */

    // DATOS DE LOCALHOST ADRI
    $usuario="root";
    $clave="palermo9";
    $nombreBD="a6003835_fulbito";
    $conexion="localhost";

	$db = new ezSQL_mysql($usuario,$clave,$nombreBD,$conexion);

?>