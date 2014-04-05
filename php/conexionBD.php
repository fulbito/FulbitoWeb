<?php
	global $db;
    $usuario="root";
    $clave="root";
    $nombreBD="fulbito";  
    $conexion="localhost";
	$db = new ezSQL_mysql($usuario,$clave,$nombreBD,$conexion);
?>