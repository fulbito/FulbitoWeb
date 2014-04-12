<?php
	global $db;

    // DATOS DE LOCALHOST MAYO
    $usuario="root";
    $clave="root";
    $nombreBD="fulbito";
    $conexion="localhost";

    /*
    // DATOS DE LOCALHOST ADRI
    $usuario="a6003835_fulbito";
    $clave="fulbito2014";
    $nombreBD="a6003835_fulbito";
    $conexion="mysql13.000webhost.com";
    */
	$db = new ezSQL_mysql($usuario,$clave,$nombreBD,$conexion);

?>